<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Implicado[]|\Cake\Collection\CollectionInterface $implicados
 */
?>
<div class="implicados index content">
    <?= $this->Html->link(__('New Implicado'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Implicados') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('accione_id') ?></th>
                    <th><?= $this->Paginator->sort('tecnico_id') ?></th>
                    <th><?= $this->Paginator->sort('fecha_limite') ?></th>
                    <th><?= $this->Paginator->sort('fecha_inicio') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($implicados as $implicado): ?>
                <tr>
                    <td><?= $this->Number->format($implicado->id) ?></td>
                    <td><?= $implicado->has('accione') ? $this->Html->link($implicado->accione->accion, ['controller' => 'Acciones', 'action' => 'view', $implicado->accione->id]) : '' ?></td>
                    <td><?= $implicado->has('tecnico') ? $this->Html->link($implicado->tecnico->id, ['controller' => 'Tecnicos', 'action' => 'view', $implicado->tecnico->id]) : '' ?></td>
                    <td><?= h($implicado->fecha_limite) ?></td>
                    <td><?= h($implicado->fecha_inicio) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $implicado->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $implicado->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $implicado->id], ['confirm' => __('Are you sure you want to delete # {0}?', $implicado->id)]) ?>
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
