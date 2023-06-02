<?php

?>

<style>
	.red{
		color: red;
		float: right;
	}

</style>

<div class="row">
     <div class="column-responsive column-100">
	  <h4>Avance: <?= $accione->avance->avance ?></h4>
        <div class="acciones form content">
            <?= $this->Form->create($accione) ?>
            <fieldset>
		   
                <legend><?= __('Edit Accione') ?></legend>
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
</div>
