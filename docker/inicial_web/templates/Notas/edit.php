<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Nota $nota
 * @var string[]|\Cake\Collection\CollectionInterface $parentNotas
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $acciones
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $nota->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $nota->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Notas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="notas form content">
            <?= $this->Form->create($nota) ?>
            <fieldset>
                <legend><?= __('Edit Nota') ?></legend>
                <?php
                    echo $this->Form->control('parent_id', ['options' => $parentNotas, 'empty' => true]);
                    echo $this->Form->control('left');
                    echo $this->Form->control('right');
                    echo $this->Form->control('user_id', ['options' => $users]);
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
