<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tecnico $tecnico
 * @var string[]|\Cake\Collection\CollectionInterface $delegaciones
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tecnico->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tecnico->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Tecnicos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tecnicos form content">
            <?= $this->Form->create($tecnico) ?>
            <fieldset>
                <legend><?= __('Edit Tecnico') ?></legend>
                <?php
                    echo $this->Form->control('delegacione_id', ['options' => $delegaciones]);
                    echo $this->Form->control('nombre');
                    echo $this->Form->control('cargo');
                    echo $this->Form->control('central', ['label'=>'Actúa en todas las delegaciones']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
