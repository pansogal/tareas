<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Avance[]|\Cake\Collection\CollectionInterface $avances
 */
?>
<div class="avances index content">
    <?= $this->Html->link(__('New Avance'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Avances') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('parent_id') ?></th>
                    <th><?= $this->Paginator->sort('proyecto_id') ?></th>
                    <th><?= $this->Paginator->sort('avance') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('completado') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($avances as $avance): ?>
                <tr>
                    <td><?= $this->Number->format($avance->id) ?></td>
                    <td><?= $avance->has('parent_avance') ? $this->Html->link($avance->parent_avance->avance, ['controller' => 'Avances', 'action' => 'view', $avance->parent_avance->id]) : '' ?></td>
                    <td><?= $avance->has('proyecto') ? $this->Html->link($avance->proyecto->id, ['controller' => 'Proyectos', 'action' => 'view', $avance->proyecto->id]) : '' ?></td>
                    <td><?= h($avance->avance) ?></td>
                    <td><?= h($avance->created) ?></td>
                    <td><?= h($avance->modified) ?></td>
                    <td><?= h($avance->completado) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $avance->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $avance->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $avance->id], ['confirm' => __('Are you sure you want to delete # {0}?', $avance->id)]) ?>
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
