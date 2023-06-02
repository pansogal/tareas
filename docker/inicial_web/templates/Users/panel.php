<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Implicado[]|\Cake\Collection\CollectionInterface $implicas
 */
?>
<div class="row">
	<div class="column-responsive column-100">
		<div class='leyenda'>Leyenda: 
			<span class='rojo' title='La acción necesita otras para empezar.'>
				<?php
					if( isset($proy) ) echo $this->Html->link('Esperando',['action'=>'panel','proy',$proy, 'luzverde', 0], ['class' => 'button3 rojo']);
 					else echo $this->Html->link('Esperando',['action'=>'panel', 'luzverde', 0], ['class' => 'button3 rojo']);
				 ?>
			</span>
			<span class='naranja' title='La acción puede empezar, pero no ha empezado aún.'>
				<?php
					if( isset($proy) ) echo $this->Html->link('Lista para empezar',['action'=>'panel','proy',$proy, 'luzverde', 1], ['class' => 'button3 naranja']);
 					else echo $this->Html->link('Lista para empezar',['action'=>'panel', 'luzverde', 1], ['class' => 'button3 naranja']);
				 ?>
			</span>
			<span class='ama' title='La acción ya está en marcha, se le asignó fecha de inicio.'>
				<?php
					if( isset($proy) ) echo $this->Html->link('En marcha',['action'=>'panel','proy',$proy, 'iniciada', 1], ['class' => 'button3 ama']);
 					else echo $this->Html->link('En marcha',['action'=>'panel', 'iniciada', 1], ['class' => 'button3 ama']);
				 ?>
			</span>
			<span class='verde' title='La acción fue completada.'>
				<?php
					if( isset($proy) ) echo $this->Html->link('Completada',['action'=>'panel','proy',$proy, 'finalizada', 1], ['class' => 'button3 verde']);
 					else echo $this->Html->link('Completada',['action'=>'panel', 'finalizada', 1], ['class' => 'button3 verde']);
				 ?>
			</span>
			Pulse para filtrar los datos en base a status
		</div> 
	</div> 
</div> <br />


<div class="implicados index content">

	<h3><?= 'Panel de usuario '.$usr->usuario. ' <b>Técnico:</b> '.$usr->tech->nombre ?></h3>
			<?php
				if( isset($proy) ) {
					echo "<h4>Estás filtrando por proyecto: <b>".$pr->corto." ".$pr->proyecto. "</b></h4>";
				}
			?>

	<div class="table-responsive">
		<table>
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('accione_id', ['label'=> 'Acción: Modificar']) ?></th>
					<th>Proyecto: Filtrar - Avance<br></th>
					<th><?= $this->Paginator->sort('fecha_limite') ?></th>
					<th><?= $this->Paginator->sort('fecha_inicio') ?></th>
					<th class="actions"><?= __('Actions') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($implicas as $impli): ?>
				<tr>
					<td>
				  <?php 
					$acc =  $impli->accione; // accion
					$proyecto = $acc->avance->proyecto;
					$comp2 = $acc->color;  // color según estado
				  ?>
				  <?= "<b>".$acc->code."</b> ".$this->Html->link($acc->accion, ['controller' => 'Acciones', 'action' => 'edit', $acc->id, $proyecto->id], [
									'class' => 'button3 '.$comp2,
									'title' =>$acc->descripcion,
								]); ?>
					</td>
					<td>
				   <?= $this->Html->link($proyecto->corto,['action'=>'panel','proy',$proyecto->id], ['class'=>'button3']) ?> - <?= $impli->accione->avance->avance ?>
					</td>
					<td><?= h($impli->fecha_limite) ?></td>
					<td><?= h($impli->fecha_inicio) ?></td>
					<td>
						<?= $this->Html->link('Proyecto', ['controller'=>'Proyectos','action' => 'view', $proyecto->id], ['class'=>'button3', 'title'=>'ver proyecto']) ?>
						<?= $this->Html->link('Plan', ['controller'=>'Implicados', 'action' => 'edit', $impli->id], ['class'=>'button3', 'title'=>'Planificar fechas posibles']) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $impli->id], ['confirm' => __('Are you sure you want to delete # {0}?', $impli->id)]) ?>
					</td>
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
