<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Confavance $confavance
 * @var \Cake\Collection\CollectionInterface|string[] $parentConfavances
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Confavances'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="confavances form content">
            <?= $this->Form->create($confavance) ?>
            <fieldset>
                <legend><?= 'Añadir avance' ?></legend>
                <?php
                    echo $this->Form->control('parent_id', ['label'=>'Avance Anterior', 'options' => $parentConfavances, 'empty' => true]);
                    echo $this->Form->control('prefijo', ['label'=>'Prefijo, para luego ordenar alfabéticamente']);
                    echo $this->Form->control('cavance', ['label'=>'Avance']);
                    echo $this->Form->control('explicacion');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
