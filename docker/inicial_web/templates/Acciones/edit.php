<?php

?>

<div class="row">
	 <div class="column-responsive column-50">
	  <h4> <?= $accione->accion." (<b>Avance:</b> ".$accione->avance->avance.")" ?></h4>
		<div class="acciones form content">
			<?= $this->Form->create($accione) ?>
			<fieldset>
		   
				<legend><?= __('Edit Acción') ?></legend>
				<?php
					echo $this->Form->control('accion');
					/*if( is_null($accione->iniciada) || is_null($accione->finalizada) ){
				echo "<span class='red'>Sin especificar ambas fechas de inicio y de finalización de acción no se puede dar por realizada.</span>";
				echo $this->Form->control('realizada', ['disabled' => true]);	
			}else{
				echo $this->Form->control('realizada');	
			}*/
					echo $this->Form->control('iniciada', ['empty' => true]);
					echo $this->Form->control('finalizada', ['empty' => true]);
					echo $this->Form->control('descripcion');
					echo $this->Form->control('documentar');
				?>
			</fieldset>
			<?= $this->Form->button(__('Submit')) ?>
			<?= $this->Form->end() ?>
		</div>
	</div>

	 <div class="column-responsive column-50">
		 <h4>Notas en accion: <?= $accione->accion ?></h4>
		<div class="acciones form content">
			<?php 
				echo $this->Html->link("Nueva Nota ", ['controller'=>'Notas','action' => 'add',$accione->id], ['class' => 'button2 float-right']) 
			?>
	 </div>

</div>
<br /><br />
