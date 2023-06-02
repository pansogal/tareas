<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Nota> $notas
 */
?>
<div class="notas index content">
    <?= $this->Html->link(__('New Nota'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Notas') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('parent_id') ?></th>
                    <th><?= $this->Paginator->sort('left') ?></th>
                    <th><?= $this->Paginator->sort('right') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('accione_id') ?></th>
                    <th><?= $this->Paginator->sort('titulo') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notas as $nota): ?>
                <tr>
                    <td><?= $this->Number->format($nota->id) ?></td>
                    <td><?= $nota->has('parent_nota') ? $this->Html->link($nota->parent_nota->titulo, ['controller' => 'Notas', 'action' => 'view', $nota->parent_nota->id]) : '' ?></td>
                    <td><?= $nota->left === null ? '' : $this->Number->format($nota->left) ?></td>
                    <td><?= $nota->right === null ? '' : $this->Number->format($nota->right) ?></td>
                    <td><?= $nota->has('user') ? $this->Html->link($nota->user->usuario, ['controller' => 'Users', 'action' => 'view', $nota->user->id]) : '' ?></td>
                    <td><?= $nota->has('accione') ? $this->Html->link($nota->accione->accion, ['controller' => 'Acciones', 'action' => 'view', $nota->accione->id]) : '' ?></td>
                    <td><?= h($nota->titulo) ?></td>
                    <td><?= h($nota->created) ?></td>
                    <td><?= h($nota->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $nota->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $nota->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $nota->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nota->id)]) ?>
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
