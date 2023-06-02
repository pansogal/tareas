<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Accione[]|\Cake\Collection\CollectionInterface $acciones
 */
?>
<div class="acciones index content">
	<h3><?= 'Acciones en curso' ?></h3>
	<div class='leyenda'>Leyenda: 
		<span class='rojo' title='La acción necesita otras para empezar.'>Esperando</span>
		<span class='naranja' title='La acción puede empezar, pero no ha empezado aún.'>Lista para empezar</span>
		<span class='ama' title='La acción ya está en marcha.'>En marcha</span>
		<span class='verde' title='La acción fue compoletada.'>Completada</span>
	</div>
	<div class="table-responsive">
		<table>
			<thead>
				<tr>
					<th> <?= $this->Paginator->sort('proyectos') ?> </th>
					<th>En curso</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($actis as $acti): ?>
				<tr>
					<td>
				  <?= $this->Html->link( $acti->corto, ['controller'=>'Proyectos', 'action' => 'view', $acti->id], ['title'=> $acti->proyecto." - ".$acti->lugar, 'class' => 'button3']) ?>
					</td>
					<td>
				  <?php foreach ($acti->avances as $av): ?>
					<?php foreach ($av->acciones as $acc): ?>
						<?php 
							if($acc->luzverde && !$acc->realizada){
								echo "<b>".$acc->code."</b> ".$this->Html->link($acc->accion, ['controller' => 'Acciones', 'action' => 'edit', $acc->id, $acti->id], [
									'class' => 'button3 '.$acc->color,
									'title' =>$acc->descripcion,
								]);
								foreach($acc->tecnicos as $tt){
									echo  $tt->nombre.' ';
								}
								echo '<br />';
							} 
						?> 
					<?php endforeach; ?>
				  <?php endforeach; ?>
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
