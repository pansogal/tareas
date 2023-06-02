<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asignado $asignado
 * @var string[]|\Cake\Collection\CollectionInterface $tareas
 * @var string[]|\Cake\Collection\CollectionInterface $tecnicos
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $asignado->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $asignado->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Asignados'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="asignados form content">
            <?= $this->Form->create($asignado) ?>
            <fieldset>
                <legend><?= __('Edit Asignado') ?></legend>
                <?php
                    echo $this->Form->control('tarea_id', ['options' => $tareas]);
                    echo $this->Form->control('tecnico_id', ['options' => $tecnicos]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
