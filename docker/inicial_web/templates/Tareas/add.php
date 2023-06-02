<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tarea $tarea
 * @var \Cake\Collection\CollectionInterface|string[] $tecnicos
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Tareas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tareas form content">
            <?= $this->Form->create($tarea) ?>
            <fieldset>
                <legend><?= __('Add Tarea') ?></legend>
                <?php
                    echo $this->Form->control('codigo');
                    echo $this->Form->control('tarea');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
