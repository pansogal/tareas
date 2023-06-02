<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Avance $avance
 * @var \Cake\Collection\CollectionInterface|string[] $parentAvances
 * @var \Cake\Collection\CollectionInterface|string[] $proyectos
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Avances'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="avances form content">
            <?= $this->Form->create($avance) ?>
            <fieldset>
                <legend><?= __('Add Avance') ?></legend>
                <?php
                    echo $this->Form->control('parent_id', ['options' => $parentAvances, 'empty' => true]);
                    echo $this->Form->control('proyecto_id', ['options' => $proyectos]);
                    echo $this->Form->control('avance');
                    echo $this->Form->control('completado');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
