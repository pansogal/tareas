<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Proyecto $proyecto
 * @var \Cake\Collection\CollectionInterface|string[] $delegaciones
 * @var \Cake\Collection\CollectionInterface|string[] $empresas
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Proyectos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="proyectos form content">
            <?= $this->Form->create($proyecto) ?>
            <fieldset>
                <legend><?= __('Add Proyecto') ?></legend>
                <?php
                    echo $this->Form->control('delegacione_id', ['options' => $delegaciones]);
                    echo $this->Form->control('lugar');
                    echo $this->Form->control('empresa_id', ['options' => $empresas]);
                    echo $this->Form->control('proyecto');
                    echo $this->Form->control('codigo');
                    echo $this->Form->control('corto');
                    echo $this->Form->control('es_fv');
                    echo $this->Form->control('es_clima');
                    echo $this->Form->control('es_industrial');
                    echo $this->Form->control('es_residencial');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
