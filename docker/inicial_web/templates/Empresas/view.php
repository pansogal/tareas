<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empresa $empresa
 */
?>
<div class="row">
	<?= $this->Html->link('Empresas', ['controller'=>'Empresas','action' => 'index'], ['class' => 'button2 float-right']) ?>
	<?= $this->Html->link('Contactos (Todos)', ['controller'=>'Contactos','action' => 'index'], ['class' => 'button2 float-right']) ?>
</div>
<div class="row">
    <div class="column-responsive column-100">
        <div class="empresas view content">
            <h3><?= 'Empresa: <b>'.$empresa->empresa.'</b>' ?></h3>
            <table>
                <tr>
                    <th><?= __('Empresa') ?></th>
                    <td><?= $empresa->empresa ?></td>
                    <td><?= $this->Html->link('Modificar', ['action' => 'edit', $empresa->id], ['class' => 'button2']) ?>
			<?= $this->Form->postLink('Borrar', ['action' => 'delete', $empresa->id], ['confirm' => __('Seguro de borrar # {0}?', $empresa->id), 'class' => 'button2']) ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Provincia') ?></th>
                    <td><?= h($empresa->provincia) ?></td>
                </tr>
                <tr>
                    <th><?= __('Direccion') ?></th>
                    <td><?= h($empresa->direccion) ?></td>
                </tr>
            </table>
           </div></div></div><br />

	<div class="row">
           <div class="column-responsive column-100">
           <div class="empresas view content">
            <div class="related">
                <h4><?= 'Contactos de <b>'.$empresa->empresa.'</b>' ?> <?= $this->Html->link('Nuevo Contacto', ['controller'=>'Contactos', 'action' => 'add', $empresa->id], ['class' => 'button2']) ?></h4>
                <?php if (!empty($empresa->contactos)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Persona') ?></th>
                            <th><?= __('Rol') ?></th>
                            <th>mail tlfno</th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($empresa->contactos as $contactos) : ?>
                        <tr>
                            <td><?= $this->Html->link($contactos->persona,   ['controller' => 'Contactos', 'action' => 'view', $contactos->id], ['class'=>'button2'])?></td>
                            <td><?= $contactos->rol ?></td>
                            <td><?= $contactos->tlfno_mail ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Contactos', 'action' => 'view', $contactos->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Contactos', 'action' => 'edit', $contactos->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Contactos', 'action' => 'delete', $contactos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactos->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
           </div></div></div><br />

	<div class="row">
           <div class="column-responsive column-100">
           <div class="empresas view content">
            <div class="related">
                <h4><?= 'Proyectos de <b>'.$empresa->empresa.'</b>' ?> <?= $this->Html->link('Nuevo Proyecto', ['controller'=>'Proyectos', 'action' => 'add', $empresa->id], ['class' => 'button2']) ?></h4>
                <?php if (!empty($empresa->proyectos)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= 'Deleg.' ?><br />
                            	<?= __('Codigo') ?></th>
                            <th><?= __('Proyecto') ?><br />
					<?= __('Lugar') ?></th>
                            <th><?= __('Corto') ?><br />
                            	<?= __('Tipo') ?></th>
                            <th><?= __('Created') ?><br />
					<?= __('Modified') ?></th>
                        </tr>
                        <?php foreach ($empresa->proyectos as $proyectos) : ?>
                        <tr>
                            <td><?= h($proyectos->delegacione->corto) ?> <br />
					<?= h($proyectos->corto) ?></td>
                            <td><?=  $this->Html->link($proyectos->proyecto, ['controller' => 'Proyectos', 'action' => 'view', $proyectos->id],['class'=>'button2']) ?><br />
					<?= h($proyectos->lugar) ?></td>
                            <td><?= h($proyectos->corto) ?><br />
					<?php 
						if($proyectos->es_fv) echo "FV ";
						if($proyectos->es_clima) echo "CLIMA ";
						if($proyectos->es_industrial) echo "INDUSTRIAL ";
						if($proyectos->es_residencial) echo "RESIDENCIAL ";
					 ?></td>
                            <td><?= h($proyectos->created) ?><br />
					<?= h($proyectos->modified) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
