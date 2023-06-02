<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tarea $tarea
 * @var string[]|\Cake\Collection\CollectionInterface $tecnicos
 */
?>
<style>
	span.verde{
		background-color: green;
		color: white;
		padding: 4px 6px 3px 6px;
	}
	span.rojo{
		background-color: red;
		color: white;
		padding: 4px 6px 3px 6px;
	}
	.peque{
		font-size: smaller;
	}
</style>

<div class="row">
    <div class="column-responsive column-100">

        <div class="tareas form content">
            <?= $this->Form->create($tarea) ?>
            <fieldset>
                <legend><?= __('Configurar Tarea') ?></legend>
                <?= $this->Html->link('Volver a lista de tareas', ['action' => 'index'], ['class' => 'button2 float-right']) ?>
                <?php
                    echo $this->Form->control('codigo');
                    echo $this->Form->control('tarea');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
</div> </div> <br />

<div class="row">
    <!--  Responsables  -->
    <div class="column-responsive column-50">
	<div  class="tareas  content">
		<h4>Responsables</h4>
		<table>
			<thead>
			<tr> <th>Técnico</th><th>Deleg.</th><th>¿Asignado a <br /> <?= '"'.$tarea->tarea.'"?' ?></th> </tr>
			</thead>
			<tbody>		
		<?php foreach ($tecnicos as $tec): ?>
			  <tr>
				<td><?= $tec->nombre ?> <br />
					<span class='peque'><?= $tec->cargo ?> </span>
				</td>
				<td><?= $tec->delegacione->delegacion ?> </td>
				<td> <?php  
					if( $tec->hay  ){
						echo '<span class="verde">Sí</span> '.$this->Html->link('Liberar este Técnico', ['action' => 'libera', $tarea->id, $tec->id], ['class' => 'button2']);
					}else{
						echo  '<span class="rojo">No</span> '.$this->Html->link('Asignar este Técnico', ['action' => 'asigna', $tarea->id, $tec->id], ['class' => 'button2']);
					}
				?></td>
			</tr>
		<?php endforeach; ?>
		 </tbody>
		</table>
	</div>
    </div>

    <!--  Semáforos  -->
    <div class="column-responsive column-50">
	<div  class="tareas  content">
		<h4>Dependencias de otras tareas</h4>
		<table>
			<thead>
			<tr> <th>Tarea</th><th>¿Es requisito para <br /> <?= '"'.$tarea->tarea.'"?' ?></th> </tr>
			</thead>
			<tbody>		
		<?php foreach ($ttareas as $ta): ?>
			  <tr>
				<td><?= "<b>".$ta->codigo."</b> ".$this->Html->link($ta->tarea, ['action' => 'edit', $ta->id]) ?> </td>
				<td> <?php
					if($ta->salto == false){
						if( $ta->hay  ){
							echo '<span class="verde">Sí</span> '.$this->Html->link('Liberar semáforo', ['action' => 'semaforoOff', $tarea->id, $ta->id], ['class' => 'button2']);
						}else{
							echo  '<span class="rojo">No</span> '.$this->Html->link('Asignar semáforo', ['action' => 'semaforoOn', $tarea->id, $ta->id], ['class' => 'button2']);
						}
					}
				?></td>
			</tr>
		<?php endforeach; ?>
		 </tbody>
		</table>
	</div>
    </div>



    
</div>
<br /><br />
