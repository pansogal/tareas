<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>
<div class="users index content">
	<?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'button float-right']) ?>
	<h3><?= __('Users') ?></h3>
	<div class="table-responsive">
		<table>
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('usuario') ?></th>
					<th>Técnico / Delegación</th>
					<th><?= $this->Paginator->sort('email') ?></th>
					<th><?= $this->Paginator->sort('created') ?><br />
					<?= $this->Paginator->sort('modified') ?></th>
					<th class="actions"><?= __('Actions') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $user): ?>
				<tr>
					<td><?= $user->usuario ?></td>
					<td><?= $user->has('tecnico') ? $user->tecnico->nombre : '' ?><br />
						<?= $user->has('tecnico') ?  "<span class='peque'>".$user->tecnico->delegacione->delegacion."</span>" : '' ?>
					</td>
					<td><?= h($user->email) ?></td>
					<td><?= h($user->created) ?><br />
					<?= h($user->modified) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
