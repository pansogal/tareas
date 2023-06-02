<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tecnico $tecnico
 * @var \Cake\Collection\CollectionInterface|string[] $delegaciones
 * @var \Cake\Collection\CollectionInterface|string[] $tareas
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Tecnicos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tecnicos form content">
            <?= $this->Form->create($tecnico) ?>
            <fieldset>
                <legend><?= __('Add Tecnico') ?></legend>
                <?php
                    echo $this->Form->control('delegacione_id', ['options' => $delegaciones]);
                    echo $this->Form->control('nombre');
                    echo $this->Form->control('cargo');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
