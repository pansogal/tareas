<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contacto $contacto
 * @var \Cake\Collection\CollectionInterface|string[] $empresas
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Contactos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="contactos form content">
            <?= $this->Form->create($contacto) ?>
            <fieldset>
                <legend><?= __('Add Contacto') ?></legend>
                <?php
                if(isset($empresa)){
			echo $this->Form->control('empresa_id', ['label'=>'Cliente','options' => $empresas, 'default'=>$empresa->id]);
		}else{
			echo $this->Form->control('empresa_id', ['label'=>'Cliente','options' => $empresas]);
		}
                    echo $this->Form->control('persona');
                    echo $this->Form->control('rol');
                    echo $this->Form->control('tlfno_mail');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
