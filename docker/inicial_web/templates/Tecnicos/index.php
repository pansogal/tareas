<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tecnico[]|\Cake\Collection\CollectionInterface $tecnicos
 */
?>

<h3 style='color:red'>Configuración: Técnicos</h3>
<div class="row">
	<?= $this->Html->link('Tareas', ['controller'=>'Tareas','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Delegaciones', ['controller'=>'Delegaciones','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Conf. Avances', ['controller'=>'Confavances','action' => 'index'], ['class' => 'button2 float-right']) ?>
</div>

<div class="tecnicos index content">
	<?php
			if($tecnico->user == 1)	echo $this->Html->link('Nuevo Técnico', ['action' => 'add'], ['class' => 'button2 float-right']); 
	?>
	<?php 
		$leyenda = 'Tecnicos';
		if(isset($dele) ){
			$leyenda.= ' en '.$dele->delegacion;
		}
	?>
	<h3><?= $leyenda ?></h3>
	<span class='verde'>Lista las delegaciones, sus técnicos y las tareas de los técnicos si el proyecto es de su delegación.</span><br />
	<span class='verde'>Pulsando en el nombre, se pueden editar los datos del técnico.</span>
	<div class="table-responsive">
		<table>
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('delegacione_id') ?></th>
					<th><?= $this->Paginator->sort('nombre') ?></th>
					<th>Tareas</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($tecnicos as $tecnico): ?>
				<tr>
					<td>
				  <?= $tecnico->has('delegacione') ? 
					$this->Html->link($tecnico->delegacione->delegacion, ['controller' => 'Delegaciones', 'action' => 'view', $tecnico->delegacione->id]) : '' ?>
				  <?php 
					if( $tecnico->central ) echo "<br /> En todas";
				  ?>
			</td>
					<td><?= $this->Html->link($tecnico->nombre, ['action' => 'edit', $tecnico->id]) ?><br /> 
				<span class='peque'><?= $tecnico->cargo ?></span>
			</td>
					<td><?php
				foreach($tecnico->tareas as $tare){
					if( isset($primero) ) echo "<br />";
					else $primero=1;
					echo $tare->codigo . " - " . $tare->tarea;
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
