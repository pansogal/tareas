<?php
declare(strict_types=1);

namespace App;

use Cake\Core\Configure;
use Cake\Core\ContainerInterface;
use Cake\Datasource\FactoryLocator;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\ORM\Locator\TableLocator;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;

use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Authentication\Middleware\AuthenticationMiddleware;
use Authentication\Identifier\IdentifierInterface;
use Cake\Routing\Router;
use Psr\Http\Message\ServerRequestInterface;

use Authorization\AuthorizationService;
use Authorization\AuthorizationServiceInterface;
use Authorization\AuthorizationServiceProviderInterface;
use Authorization\Middleware\AuthorizationMiddleware;
use Authorization\Policy\OrmResolver;

class Application extends BaseApplication implements AuthenticationServiceProviderInterface, AuthorizationServiceProviderInterface
{
	public function bootstrap(): void
	{
		// Call parent to load bootstrap from files.
		parent::bootstrap();

		if (PHP_SAPI === 'cli') {
			$this->bootstrapCli();
		} else {
			FactoryLocator::add(
				'Table',
				(new TableLocator())->allowFallbackClass(false)
			);
		}
		
		 $this->addPlugin('Authentication');
		 $this->addPlugin('Authorization');

		/*
		 * Only try to load DebugKit in development mode
		 * Debug Kit should not be installed on a production system
		 */
		if (Configure::read('debug')) {
			Configure::write('DebugKit.ignoreAuthorization', true);
			$this->addPlugin('DebugKit');
		}

		// Load more plugins here
	}

	/**
	 * Setup the middleware queue your application will use.
	 *
	 * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
	 * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
	 */
	public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
	{
		$middlewareQueue
			// Catch any exceptions in the lower layers,
			// and make an error page/response
			->add(new ErrorHandlerMiddleware(Configure::read('Error')))

			// Handle plugin/theme assets like CakePHP normally does.
			->add(new AssetMiddleware([
				'cacheTime' => Configure::read('Asset.cacheTime'),
			]))

			->add(new RoutingMiddleware($this))
			->add(new BodyParserMiddleware())
			// Add the AuthenticationMiddleware. It should be after routing and body parser.
			->add(new AuthenticationMiddleware($this))
			->add(new AuthorizationMiddleware($this))
			
			->add(new CsrfProtectionMiddleware([
				'httponly' => true,
			]));

		return $middlewareQueue;
	}
	
	public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface
	{
		$authenticationService = new AuthenticationService([
				'unauthenticatedRedirect' => Router::url('/users/login'),
				'queryParam' => 'redirect',
		]);

		// Load identifiers, ensure we check email and password fields
		$authenticationService->loadIdentifier('Authentication.Password', [
				'fields' => [
						'username' => 'email',
						'password' => 'password',
				]
		]);

		// Load the authenticators, you want session first
		$authenticationService->loadAuthenticator('Authentication.Session');
		// Configure form data check to pick email and password
		$authenticationService->loadAuthenticator('Authentication.Form', [
				'fields' => [
						'username' => 'email',
						'password' => 'password',
				],
				'loginUrl' => Router::url('/users/login'),
		]);

		return $authenticationService;
	}
	
	public function getAuthorizationService(ServerRequestInterface $request): AuthorizationServiceInterface
	{
		$resolver = new OrmResolver();

		return new AuthorizationService($resolver);
	}

	/**
	 * Register application container services.
	 *
	 * @param \Cake\Core\ContainerInterface $container The Container to update.
	 * @return void
	 * @link https://book.cakephp.org/4/en/development/dependency-injection.html#dependency-injection
	 */
	public function services(ContainerInterface $container): void
	{
	}

	/**
	 * Bootstrapping for CLI application.
	 *
	 * That is when running commands.
	 *
	 * @return void
	 */
	protected function bootstrapCli(): void
	{
		$this->addOptionalPlugin('Cake/Repl');
		$this->addOptionalPlugin('Bake');

		$this->addPlugin('Migrations');

		// Load more plugins here
	}
}
