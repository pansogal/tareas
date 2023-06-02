<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Valore[]|\Cake\Collection\CollectionInterface $valores
 */
?>
<div class="valores index content">
    <?= $this->Html->link(__('New Valore'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Valores') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('parametro_id') ?></th>
                    <th><?= $this->Paginator->sort('proyecto_id') ?></th>
                    <th><?= $this->Paginator->sort('valor') ?></th>
                    <th><?= $this->Paginator->sort('siguiente') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($valores as $valore): ?>
                <tr>
                    <td><?= $this->Number->format($valore->id) ?></td>
                    <td><?= $valore->has('parametro') ? $this->Html->link($valore->parametro->parametro, ['controller' => 'Parametros', 'action' => 'view', $valore->parametro->id]) : '' ?></td>
                    <td><?= $valore->has('proyecto') ? $this->Html->link($valore->proyecto->corto, ['controller' => 'Proyectos', 'action' => 'view', $valore->proyecto->id]) : '' ?></td>
                    <td><?= h($valore->valor) ?></td>
                    <td><?= h($valore->siguiente) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $valore->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $valore->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $valore->id], ['confirm' => __('Are you sure you want to delete # {0}?', $valore->id)]) ?>
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
