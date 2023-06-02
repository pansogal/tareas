<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tarea[]|\Cake\Collection\CollectionInterface $tareas
 */
?>
<style>
	span.code{
		background-color: grey;
		color: yellow;
		padding: 5px 6px 4px 6px;
	}
	.verde{
		color: darkgreen;
	}
	.rojo{
		color: red;
	}
</style>
<h3 class='rojo'>Configuración: Tareas</h3>
<div class="row">
	<?= $this->Html->link('Técnicos', ['controller'=>'Tecnicos','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Delegaciones', ['controller'=>'Delegaciones','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Conf. Avances', ['controller'=>'Confavances','action' => 'index'], ['class' => 'button2 float-right']) ?>
</div>

<div class="tareas index content">
	<?php 
		if($tecnico->user == 1) echo $this->Html->link(__('New Tarea'), ['action' => 'add'], ['class' => 'button2 float-right']);
	?>
	<h3><?= __('Tareas') ?></h3>
	<span class='verde'>Configura las tareas que se realizarán en todos los proyectos.</span><br />
	<span class='verde'>Se asignan técnicos y se crean las dependencias entre tareas ("semáforos").</span>
	
	<div class="table-responsive">
		<table>
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('tarea') ?></th>
					<th> Asignables</th>
					<th>No antes de..</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($tareas as $tarea): ?>
				<tr>
					<td><?= "<span class='code'>".$tarea->codigo. "</span> ".$this->Html->link( $tarea->tarea, ['action' => 'edit', $tarea->id]) ?></td>
					<td><?php
				foreach($tarea->tecnicos as $tec){
					if(isset($primero)) echo "<br />";
					else $primero=1;
					echo "<b title='".$tec->cargo."'>".$tec->delegacione->delegacion."</b> - ".$tec->nombre;
				}
				unset($primero);
					?></td>
					<td><?php
				if (array_key_exists($tarea->id, $semaforos)) {
					foreach($semaforos[$tarea->id] as $sema){
						if(!isset($primero) ) $primero=1;
						else echo "<br />";
						echo $sema->codigo." ".$sema->tarea;
					}
					unset($primero);
				}
				  
					?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="paginator">
		<ul class="pagination">
			<?= $this->Paginator->first('<< ' . __('first')) ?>
			<?= $this->Paginator->prev('< ' . __('previous')) ?>
			<?= $this->Paginator->numbers() ?>
			<?= $this->Paginator->next(__('next') . ' >') ?>
			<?= $this->Paginator->last(__('last') . ' >>') ?>
		</ul>
		<p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
	</div>
</div>
