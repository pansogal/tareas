<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Valore $valore
 * @var string[]|\Cake\Collection\CollectionInterface $parametros
 * @var string[]|\Cake\Collection\CollectionInterface $proyectos
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $valore->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $valore->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Valores'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="valores form content">
            <?= $this->Form->create($valore) ?>
            <fieldset>
                <legend><?= __('Edit Valore') ?></legend>
                <?php
                    echo $this->Form->control('parametro_id', ['options' => $parametros]);
                    echo $this->Form->control('proyecto_id', ['options' => $proyectos]);
                    echo $this->Form->control('valor');
                    echo $this->Form->control('siguiente');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
