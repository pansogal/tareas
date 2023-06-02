<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Implicado $implicado
 * @var string[]|\Cake\Collection\CollectionInterface $acciones
 * @var string[]|\Cake\Collection\CollectionInterface $tecnicos
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $implicado->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $implicado->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Implicados'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="implicados form content">
            <?= $this->Form->create($implicado) ?>
            <fieldset>
                <legend><?= __('Edit Implicado') ?></legend>
                <?php
                    echo $this->Form->control('accione_id', ['options' => $acciones]);
                    echo $this->Form->control('tecnico_id', ['options' => $tecnicos]);
                    echo $this->Form->control('fecha_limite', ['empty' => true]);
                    echo $this->Form->control('fecha_inicio', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
