<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Avance $avance
 * @var string[]|\Cake\Collection\CollectionInterface $parentAvances
 * @var string[]|\Cake\Collection\CollectionInterface $proyectos
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $avance->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $avance->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Avances'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="avances form content">
            <?= $this->Form->create($avance) ?>
            <fieldset>
                <legend><?= __('Edit Avance') ?></legend>
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
