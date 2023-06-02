<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contacto $contacto
 * @var string[]|\Cake\Collection\CollectionInterface $empresas
 */
?>
<div class="row">
	<?= $this->Html->link('Empresas', ['controller'=>'Empresas','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Contactos (todos)', ['controller'=>'Contactos','action' => 'index'], ['class' => 'button2 float-right']) ?>
</div>
<div class="row">
    <div class="column-responsive column-80">
        <div class="contactos form content">
            <?= $this->Form->create($contacto) ?>
            <fieldset>
                <legend><?= 'Modificar Contacto' ?></legend>
                <?php
                    echo $this->Form->control('persona');
                    echo $this->Form->control('empresa_id', ['options' => $empresas]);
                    echo $this->Form->control('rol');
                    echo $this->Form->control('tlfno_mail');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
