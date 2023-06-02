<?php

$cakeDescription = 'Control Tareas';
?>
<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?= $cakeDescription ?>:
		<?= $this->fetch('title') ?>
	</title>
	<?= $this->Html->meta('icon') ?>

	<link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

	<?= $this->Html->css(['normalize.min', 'milligram.min', 'cake']) ?>
	
	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
	<?= $this->fetch('script') ?>
	<?php $this->loadHelper('Authentication.Identity');  ?>
</head>
<body>
	<nav class="top-nav">
		<div class="row">  
			 <div class="column-responsive column-80">
				<a class='button2 float-left' target="_blank" rel="noopener" href="/adminer/?server=dbtareas&username=cakeuser&db=basetareas&schema=delegaciones%3A24.0278x12.1528_proyectos%3A35.4166x40.1389_avances%3A14.2361x47.9166_tecnicos%3A15.5555x21.4583_tareas%3A35.9722x2.8472_asignados%3A27.0139x1.1111_acciones%3A5.2778x58.4027_implicados%3A10.1389x36.8055_empresas%3A41.5972x20.8333_contactos%3A46.25x27.6389_parametros%3A27.8472x61.875_valores%3A30.625x53.9583_confavances%3A47.0833x2.9167_rojos%3A46.5277x-4.6528_notas%3A-7.4306x70.4166_users%3A0.9028x26.5972">BD</a>
				<?= $this->Html->link('Proyectos', ['controller'=>'Proyectos','action' => 'index'], ['class' => 'button2 float-left']) ?>
				<?= $this->Html->link('Actividades', ['controller'=>'Acciones','action' => 'index'], ['class' => 'button2 float-left']) ?>
				<?= $this->Html->link('Configuración', ['controller'=>'Delegaciones','action' => 'index'], ['class' => 'button2 float-left']) ?>
			</div>
			<div class="column-responsive column-20">
				<div><?php
					$user = $this->request->getAttribute('identity');
					if( !is_null($user)){
						echo $user->usuario." ".$this->Html->link('[Cerrar sesion]', ['controller'=>'Users', 'action' => 'logout'])."<br />".$user->email;
						echo $this->Html->link('Panel', ['controller'=>'Users', 'action' => 'panel'], ['class' => 'button2 float-right']);
					}else{
						echo $this->Html->link('[Login]', ['controller'=>'Users', 'action' => 'login']);
					}
				?>
				</div>
			</div>
		</div>
	</nav>
	<main class="main">
		<div class="container">
			<?= $this->Flash->render() ?>
			<?= $this->fetch('content') ?>
		</div>
	</main>
	<footer>
	</footer>
</body>
</html>
