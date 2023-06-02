<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Nota $nota
 * @var \Cake\Collection\CollectionInterface|string[] $parentNotas
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $acciones
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Notas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="notas form content">
            <?= $this->Form->create($nota) ?>
            <fieldset>
                <legend><?= __('Add Nota') ?></legend>
                <?php
                    echo $this->Form->control('accione_id', ['options' => $acciones]);
                    echo $this->Form->control('titulo');
                    echo $this->Form->control('texto');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
