<style>
	.verde{
		color: darkgreen;
	}
</style>
<div class="row">
	<?= $this->Html->link('Tareas', ['controller'=>'Tareas','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Delegaciones', ['controller'=>'Delegaciones','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Tecnicos', ['controller'=>'Tecnicos','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Conf. Avances', ['controller'=>'Confavances','action' => 'index'], ['class' => 'button2 float-right']) ?>
</div>
<br />

<h3>Configuración de las tareas asignadas a <b><?= '"'.$cavance->cavance.'"' ?></b></h3>
<div class="row">
	
	<div class="column-responsive column-40">
		<div class="confavances index content">
			<h4>Tareas Asignadas a avance <b><?= '"'.$cavance->cavance.'"' ?></b></h4>
			<span class='verde'>Pulse sobre la tarea para liberarla.</span><br />
			<?php
				foreach($cavance->tareas as $tt){
					echo $this->Html->link($tt->codigo." - ".$tt->tarea, ['action' => 'asigna', $cavance->id, $tt->id], ['class' => 'button2']);
					echo "<br />";
				}
			?>
			
		</div>
	</div> <!--col -->
	
	<div class="column-responsive column-60">
		<div class="confavances index content">
			<h4>Tareas Asignables</h4>
			<span class='verde'>Si no encuentra la tarea, puede que esté asignada a otro avance.</span><br />
			<span class='verde'>Pulse sobre la tarea para asignarla al avance.</span><br />
			<?php
				foreach($libres as $lb){
					echo $this->Html->link($lb->codigo." - ".$lb->tarea, ['action' => 'asigna', $cavance->id, $lb->id], ['class' => 'button2']);
					echo "<br />";
				}
			?>
			
		</div>
	</div> <!--col -->


</div> <!--row -->
			
