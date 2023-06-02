<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rojo $rojo
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Rojos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="rojos form content">
            <?= $this->Form->create($rojo) ?>
            <fieldset>
                <legend><?= __('Add Rojo') ?></legend>
                <?php
                    echo $this->Form->control('propio');
                    echo $this->Form->control('noantesde');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
