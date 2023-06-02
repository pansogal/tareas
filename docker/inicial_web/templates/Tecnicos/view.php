<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tecnico $tecnico
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Tecnico'), ['action' => 'edit', $tecnico->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Tecnico'), ['action' => 'delete', $tecnico->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tecnico->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Tecnicos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Tecnico'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tecnicos view content">
            <h3><?= h($tecnico->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Delegacione') ?></th>
                    <td><?= $tecnico->has('delegacione') ? $this->Html->link($tecnico->delegacione->delegacion, ['controller' => 'Delegaciones', 'action' => 'view', $tecnico->delegacione->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Nombre') ?></th>
                    <td><?= h($tecnico->nombre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($tecnico->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Asignados') ?></h4>
                <?php if (!empty($tecnico->asignados)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Tarea Id') ?></th>
                            <th><?= __('Tecnico Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($tecnico->asignados as $asignados) : ?>
                        <tr>
                            <td><?= h($asignados->id) ?></td>
                            <td><?= h($asignados->tarea_id) ?></td>
                            <td><?= h($asignados->tecnico_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Asignados', 'action' => 'view', $asignados->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Asignados', 'action' => 'edit', $asignados->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Asignados', 'action' => 'delete', $asignados->id], ['confirm' => __('Are you sure you want to delete # {0}?', $asignados->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Implicados') ?></h4>
                <?php if (!empty($tecnico->implicados)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Accione Id') ?></th>
                            <th><?= __('Tecnico Id') ?></th>
                            <th><?= __('Fecha Limite') ?></th>
                            <th><?= __('Fecha Inicio') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($tecnico->implicados as $implicados) : ?>
                        <tr>
                            <td><?= h($implicados->id) ?></td>
                            <td><?= h($implicados->accione_id) ?></td>
                            <td><?= h($implicados->tecnico_id) ?></td>
                            <td><?= h($implicados->fecha_limite) ?></td>
                            <td><?= h($implicados->fecha_inicio) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Implicados', 'action' => 'view', $implicados->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Implicados', 'action' => 'edit', $implicados->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Implicados', 'action' => 'delete', $implicados->id], ['confirm' => __('Are you sure you want to delete # {0}?', $implicados->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
