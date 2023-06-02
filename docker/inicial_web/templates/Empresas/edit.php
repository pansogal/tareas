<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empresa $empresa
 */
?>
<div class="row">
	<?= $this->Html->link('Empresas', ['controller'=>'Empresas','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Contactos (Todos)', ['controller'=>'Contactos','action' => 'index'], ['class' => 'button2 float-right']) ?>
</div>
<div class="row">
    <div class="column-responsive column-80">
        <div class="empresas form content">
            <?= $this->Form->create($empresa) ?>
            <fieldset>
                <legend><?= 'Modificar Datos' ?></legend>
                <?php
                    echo $this->Form->control('empresa');
                    echo $this->Form->control('provincia');
                    echo $this->Form->control('direccion');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
