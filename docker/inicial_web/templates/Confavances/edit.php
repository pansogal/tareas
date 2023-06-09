<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Confavance $confavance
 * @var string[]|\Cake\Collection\CollectionInterface $parentConfavances
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $confavance->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $confavance->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Confavances'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="confavances form content">
            <?= $this->Form->create($confavance) ?>
            <fieldset>
                <legend><?= __('Edit Confavance') ?></legend>
                <?php
                    echo $this->Form->control('parent_id', ['options' => $parentConfavances, 'empty' => true]);
                    echo $this->Form->control('prefijo');
                    echo $this->Form->control('cavance');
                    echo $this->Form->control('explicacion');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
