<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empresa[]|\Cake\Collection\CollectionInterface $empresas
 */
?>
<div class="row">
	<?= $this->Html->link('Contactos', ['controller'=>'Contactos','action' => 'index'], ['class' => 'button2 float-right']) ?>
</div>
<div class="empresas index content">
    <?= $this->Html->link('Nueva Empresa', ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Empresas') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('empresa') ?></th>
                    <th><?= $this->Paginator->sort('provincia') ?></th>
                    <th><?= $this->Paginator->sort('direccion') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empresas as $empresa): ?>
                <tr>
                    <td><?= $this->Html->link($empresa->empresa, ['action' => 'view', $empresa->id],['class'=>'button2']) ?></td>
                    <td><?= h($empresa->provincia) ?></td>
                    <td><?= h($empresa->direccion) ?></td>
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
