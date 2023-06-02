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
			<a class='button2 float-right' target="_blank" rel="noopener" href="/adminer/?server=dbtareas&username=cakeuser&db=basetareas&schema=delegaciones%3A38.75x23.6806_proyectos%3A23.8889x52.9861_avances%3A10.1389x28.75_tecnicos%3A29.5833x14.0972_tareas%3A2.1528x4.3056_asignados%3A23.8195x3.5417_acciones%3A0.625x44.2361_implicados%3A10x13.9583_empresas%3A30.2778x33.75_contactos%3A37.3611x37.8472_parametros%3A20.4861x72.5694_valores%3A11.3194x65.1389_confavances%3A14.0972x4.4444_rojos%3A34.5833x1.875">BD</a>
	 <?= $this->Html->link('Proyectos', ['controller'=>'Proyectos','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Configuración', ['controller'=>'Delegaciones','action' => 'index'], ['class' => 'button2 float-right']) ?>
			<div><?php
				$user = $this->request->getAttribute('identity');
				if( !is_null($user)){
					echo $user->usuario." ".$this->Html->link('[Cerrar sesion]', ['controller'=>'Users', 'action' => 'logout'])."<br />".$user->email;
				}else{
					echo $this->Html->link('[Login]', ['controller'=>'Users', 'action' => 'login']);
				}
			?></div>
	
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
