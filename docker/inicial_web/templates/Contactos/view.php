<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contacto $contacto
 */
?>
<div class="row">
	<?= $this->Html->link('Empresas', ['controller'=>'Empresas','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Contactos (todos)', ['controller'=>'Contactos','action' => 'index'], ['class' => 'button2 float-right']) ?>
</div>
<div class="row">
    <div class="column-responsive column-80">
        <div class="contactos view content">
            <h3><?= h($contacto->persona) ?> <?= $this->Html->link('Modificar',   ['controller' => 'Contactos', 'action' => 'edit', $contacto->id], ['class'=>'button2'])?></h3>
            <table>
                <tr>
                    <th><?= __('Empresa') ?></th>
                    <td><?= $contacto->has('empresa') ? $this->Html->link($contacto->empresa->empresa, ['controller' => 'Empresas', 'action' => 'view', $contacto->empresa->id], ['class'=>'button2']) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Persona') ?></th>
                    <td><?= h($contacto->persona) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rol') ?></th>
                    <td><?= h($contacto->rol) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tlfno Mail') ?></th>
                    <td><?= h($contacto->tlfno_mail) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
