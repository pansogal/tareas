<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Parametro[]|\Cake\Collection\CollectionInterface $parametros
 */
?>
<div class="parametros index content">
    <?= $this->Html->link(__('New Parametro'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Parametros') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('familia') ?></th>
                    <th><?= $this->Paginator->sort('indice') ?></th>
                    <th><?= $this->Paginator->sort('parametro') ?></th>
                    <th><?= $this->Paginator->sort('requiere_doc') ?></th>
                    <th><?= $this->Paginator->sort('puede_otro') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($parametros as $parametro): ?>
                <tr>
                    <td><?= $this->Number->format($parametro->id) ?></td>
                    <td><?= h($parametro->familia) ?></td>
                    <td><?= $this->Number->format($parametro->indice) ?></td>
                    <td><?= h($parametro->parametro) ?></td>
                    <td><?= h($parametro->requiere_doc) ?></td>
                    <td><?= h($parametro->puede_otro) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $parametro->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $parametro->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $parametro->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parametro->id)]) ?>
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
