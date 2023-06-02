<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asignado[]|\Cake\Collection\CollectionInterface $asignados
 */
?>
<div class="asignados index content">
    <?= $this->Html->link(__('New Asignado'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Asignados') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('tarea_id') ?></th>
                    <th><?= $this->Paginator->sort('tecnico_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($asignados as $asignado): ?>
                <tr>
                    <td><?= $this->Number->format($asignado->id) ?></td>
                    <td><?= $asignado->has('tarea') ? $this->Html->link($asignado->tarea->id, ['controller' => 'Tareas', 'action' => 'view', $asignado->tarea->id]) : '' ?></td>
                    <td><?= $asignado->has('tecnico') ? $this->Html->link($asignado->tecnico->id, ['controller' => 'Tecnicos', 'action' => 'view', $asignado->tecnico->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $asignado->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $asignado->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $asignado->id], ['confirm' => __('Are you sure you want to delete # {0}?', $asignado->id)]) ?>
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
