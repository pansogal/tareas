<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contacto[]|\Cake\Collection\CollectionInterface $contactos
 */
?>
<div class="row">
	<?= $this->Html->link('Empresas', ['controller'=>'Empresas','action' => 'index'], ['class' => 'button2 float-right']) ?>
</div>
<div class="contactos index content">
    <?= $this->Html->link(__('New Contacto'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Contactos') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('empresa_id') ?></th>
                    <th><?= $this->Paginator->sort('persona') ?></th>
                    <th><?= $this->Paginator->sort('rol') ?></th>
                    <th><?= $this->Paginator->sort('tlfno_mail') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contactos as $contacto): ?>
                <tr>
                    <td><?= $contacto->has('empresa') ? 
					$this->Html->link($contacto->empresa->empresa, ['controller' => 'Empresas', 'action' => 'view', $contacto->empresa->id],['class'=>'button2']) 
					: '' ?></td>
                    <td><?= $this->Html->link($contacto->persona, ['action' => 'view', $contacto->id],['class'=>'button2']) ?></td>
                    <td><?= $contacto->rol ?></td>
                    <td><?= $contacto->tlfno_mail ?></td>
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
