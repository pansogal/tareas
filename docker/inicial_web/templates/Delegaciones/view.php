<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Delegacione $delegacione
 */
?>
<div class="row">
	<div class="column-responsive column-100">
<div class="row">
	<?= $this->Html->link('Técnicos: '. $delegacione->corto, ['controller'=>'Tecnicos','action' => 'index', $delegacione->id], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Tareas: '. $delegacione->corto, ['controller'=>'Tareas','action' => 'index', $delegacione->id], ['class' => 'button2 float-right']) ?>
</div>
		<div class="delegaciones view content">
			<h3>
			 <?php
				if($tecnico->user == 1)	echo  $this->Html->link('Modificar', ['action' => 'edit', $delegacione->id], ['class' => 'button2 float-right']);
			?>
			 <?= h($delegacione->delegacion) ?></h3>
			
			<table>
				<tr>
					<th><?= __('Delegacion') ?></th>
					<td><?= h($delegacione->delegacion) ?></td>
				</tr>
				<tr>
					<th><?= __('Corto') ?></th>
					<td><?= h($delegacione->corto) ?></td>
				</tr>
			</table>
			<div class="related">
				<h4><?= 'Proyectos en '.$delegacione->corto ?></h4>
				<?php if (!empty($delegacione->proyectos)) : ?>
				<div class="table-responsive">
					<table>
						<tr>
							<th><?= 'Proyecto' ?></th>
							<th><?= 'Tipo' ?></th>
							<th><?= 'Cliente' ?></th>
							<th><?= __('Created') ?><br />
							<?= __('Modified') ?></th>
						</tr>
						<?php foreach ($delegacione->proyectos as $proyecto) : ?>
						<tr>
							<td><?= $this->Html->link($proyecto->proyecto, ['controller' => 'Proyectos', 'action' => 'view', $proyecto->id], ['class' => 'button2']) ?><br />
					<?= $proyecto->corto ?></td>
							<td><?php
					if($proyecto->es_fv) echo "FV ";
					if($proyecto->es_clima) echo "CLIMA ";
					if($proyecto->es_industrial) echo "INDUSTRIAL ";
					if($proyecto->es_residencial) echo "RESIDENCIAL ";
							?></td>
							<td> <?=  $this->Html->link($proyecto->empresa->empresa, ['controller' => 'Empresas', 'action' => 'view', $proyecto->empresa->id]) ?><br />
						<?= $proyecto->empresa->provincia ?> </td>
							<td><?= h($proyecto->created) ?><br />
							<?= h($proyecto->modified) ?></td>
						</tr>
						<?php endforeach; ?>
					</table>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
