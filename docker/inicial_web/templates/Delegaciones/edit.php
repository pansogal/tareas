<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Delegacione $delegacione
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $delegacione->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $delegacione->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Delegaciones'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="delegaciones form content">
            <?= $this->Form->create($delegacione) ?>
            <fieldset>
                <legend><?= __('Edit Delegacione') ?></legend>
                <?php
                    echo $this->Form->control('delegacion');
                    echo $this->Form->control('corto');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
