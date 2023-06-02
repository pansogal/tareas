<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Delegacione[]|\Cake\Collection\CollectionInterface $delegaciones
 */
?>

<h3 style='color:red'>Configuración: Delegaciones</h3>

<div class="row">
	<?= $this->Html->link('Técnicos', ['controller'=>'Tecnicos','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Tareas', ['controller'=>'Tareas','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Conf. Avances', ['controller'=>'Confavances','action' => 'index'], ['class' => 'button2 float-right']) ?>
</div>
<div class="row">
 <div class="column-responsive column-80">
<div class="delegaciones index content">
		<?php
			if($tecnico->user == 1)	echo $this->Html->link('Nueva Delegación', ['action' => 'add'], ['class' => 'button2 float-right']); 
		?>
		<h3><?= 'Configuración de Delegaciones' ?></h3>
		<span class='verde'>Crear delegaciones o listar obras y técnicos por delegación.</span>
		<div class="table-responsive">
				<table>
						<thead>
								<tr>
										<th><?= $this->Paginator->sort('delegacion') ?></th>
										<th><?= $this->Paginator->sort('corto') ?></th>
								</tr>
						</thead>
						<tbody>
								<?php foreach ($delegaciones as $delegacione): ?>
								<tr>
										<td><?= $this->Html->link($delegacione->delegacion,['action' => 'view', $delegacione->id]) ?></td>
										<td><?= h($delegacione->corto) ?></td>
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
</div>
</div>
