<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Proyecto[]|\Cake\Collection\CollectionInterface $proyectos
 */
?>
<div class="row">
	<?= $this->Html->link('Avances', ['controller'=>'Avances','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Acciones', ['controller'=>'Acciones','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Empresas', ['controller'=>'Empresas','action' => 'index'], ['class' => 'button2 float-right']) ?>
</div>
<div class="row">
 <div class="column-responsive column-100">
<div class="proyectos index content">
    <?= $this->Html->link('Nuevo Proyecto', ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Proyectos') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('delegacione_id',['label'=>'Deleg.']) ?><br />
                    <?= $this->Paginator->sort('codigo') ?></th>
                    <th><?= $this->Paginator->sort('empresa_id') ?><br />
                    <?= $this->Paginator->sort('lugar') ?></th>
                    <th><?= $this->Paginator->sort('proyecto') ?><br />
                    <?= $this->Paginator->sort('corto') ?></th>
                    <th><?= $this->Paginator->sort('es_fv',['label'=>'FV']) ?><br />
                    <?= $this->Paginator->sort('es_clima',['label'=>'CLIMA']) ?></th>
                    <th><?= $this->Paginator->sort('es_industrial',['label'=>'Ind.']) ?><br />
                    <?= $this->Paginator->sort('es_residencial', ['label'=>'Resid.']) ?></th>
                    <th><?= $this->Paginator->sort('created', ['label'=>'Creado']) ?><br />
                    <?= $this->Paginator->sort('modified', ['label'=>'Modif.']) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proyectos as $proyecto): ?>
                <tr>
                    <td><?= $proyecto->has('delegacione') ? $this->Html->link($proyecto->delegacione->delegacion, ['controller' => 'Delegaciones', 'action' => 'view', $proyecto->delegacione->id]) : '' ?><br />
                    <?= h($proyecto->codigo) ?></td>
                    <td><?= $proyecto->has('empresa') ? 
					$this->Html->link($proyecto->empresa->empresa, ['controller' => 'Empresas', 'action' => 'view', $proyecto->empresa->id],['class'=>'button2']) : '' ?><br />
                    <?= h($proyecto->lugar) ?></td>
                    <td><?= $this->Html->link( $proyecto->proyecto, ['action' => 'view', $proyecto->id], ['class' => 'button2']) ?><br />  
				<?= h($proyecto->corto) ?></td>
                    <td><?php if($proyecto->es_fv) echo 'FV '; if($proyecto->es_clima) echo 'Clima ';
				?></td>
                    <td><?php if($proyecto->es_industrial) echo 'IND. '; if($proyecto->es_residencial) echo 'RESID. ';
				?></td>
                    <td><?= h($proyecto->created) ?><br />
                    <?= h($proyecto->modified) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
</div>
</div>
