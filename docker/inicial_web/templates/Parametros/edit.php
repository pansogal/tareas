<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Parametro $parametro
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $parametro->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $parametro->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Parametros'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="parametros form content">
            <?= $this->Form->create($parametro) ?>
            <fieldset>
                <legend><?= __('Edit Parametro') ?></legend>
                <?php
                    echo $this->Form->control('familia');
                    echo $this->Form->control('indice');
                    echo $this->Form->control('parametro');
                    echo $this->Form->control('requiere_doc');
                    echo $this->Form->control('puede_otro');
                    echo $this->Form->control('describe');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
