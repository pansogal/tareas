<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Accione $accione
 * @var \Cake\Collection\CollectionInterface|string[] $avances
 * @var \Cake\Collection\CollectionInterface|string[] $tecnicos
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Acciones'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="acciones form content">
            <?= $this->Form->create($accione) ?>
            <fieldset>
                <legend><?= __('Add Accione') ?></legend>
                <?php
                    echo $this->Form->control('avance_id', ['options' => $avances]);
                    echo $this->Form->control('accion');
                    echo $this->Form->control('realizada');
                    echo $this->Form->control('iniciada', ['empty' => true]);
                    echo $this->Form->control('finalizada', ['empty' => true]);
                    echo $this->Form->control('descripcion');
                    echo $this->Form->control('documentar');
                    echo $this->Form->control('tecnicos._ids', ['options' => $tecnicos]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
