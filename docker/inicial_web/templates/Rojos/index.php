<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rojo[]|\Cake\Collection\CollectionInterface $rojos
 */
?>
<div class="rojos index content">
    <?= $this->Html->link(__('New Rojo'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Rojos') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('propio') ?></th>
                    <th><?= $this->Paginator->sort('noantesde') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rojos as $rojo): ?>
                <tr>
                    <td><?= $this->Number->format($rojo->id) ?></td>
                    <td><?= $this->Number->format($rojo->propio) ?></td>
                    <td><?= $this->Number->format($rojo->noantesde) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $rojo->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rojo->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rojo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rojo->id)]) ?>
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
