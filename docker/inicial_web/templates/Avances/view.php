<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Avance $avance
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Avance'), ['action' => 'edit', $avance->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Avance'), ['action' => 'delete', $avance->id], ['confirm' => __('Are you sure you want to delete # {0}?', $avance->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Avances'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Avance'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="avances view content">
            <h3><?= h($avance->avance) ?></h3>
            <table>
                <tr>
                    <th><?= __('Parent Avance') ?></th>
                    <td><?= $avance->has('parent_avance') ? $this->Html->link($avance->parent_avance->avance, ['controller' => 'Avances', 'action' => 'view', $avance->parent_avance->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Proyecto') ?></th>
                    <td><?= $avance->has('proyecto') ? $this->Html->link($avance->proyecto->id, ['controller' => 'Proyectos', 'action' => 'view', $avance->proyecto->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Avance') ?></th>
                    <td><?= h($avance->avance) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($avance->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lft') ?></th>
                    <td><?= $this->Number->format($avance->lft) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rght') ?></th>
                    <td><?= $this->Number->format($avance->rght) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($avance->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($avance->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Completado') ?></th>
                    <td><?= $avance->completado ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Acciones') ?></h4>
                <?php if (!empty($avance->acciones)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Avance Id') ?></th>
                            <th><?= __('Accion') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Realizada') ?></th>
                            <th><?= __('Descripcion') ?></th>
                            <th><?= __('Documentar') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($avance->acciones as $acciones) : ?>
                        <tr>
                            <td><?= h($acciones->id) ?></td>
                            <td><?= h($acciones->avance_id) ?></td>
                            <td><?= h($acciones->accion) ?></td>
                            <td><?= h($acciones->created) ?></td>
                            <td><?= h($acciones->modified) ?></td>
                            <td><?= h($acciones->realizada) ?></td>
                            <td><?= h($acciones->descripcion) ?></td>
                            <td><?= h($acciones->documentar) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Acciones', 'action' => 'view', $acciones->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Acciones', 'action' => 'edit', $acciones->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Acciones', 'action' => 'delete', $acciones->id], ['confirm' => __('Are you sure you want to delete # {0}?', $acciones->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Avances') ?></h4>
                <?php if (!empty($avance->child_avances)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Parent Id') ?></th>
                            <th><?= __('Lft') ?></th>
                            <th><?= __('Rght') ?></th>
                            <th><?= __('Proyecto Id') ?></th>
                            <th><?= __('Avance') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Completado') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($avance->child_avances as $childAvances) : ?>
                        <tr>
                            <td><?= h($childAvances->id) ?></td>
                            <td><?= h($childAvances->parent_id) ?></td>
                            <td><?= h($childAvances->lft) ?></td>
                            <td><?= h($childAvances->rght) ?></td>
                            <td><?= h($childAvances->proyecto_id) ?></td>
                            <td><?= h($childAvances->avance) ?></td>
                            <td><?= h($childAvances->created) ?></td>
                            <td><?= h($childAvances->modified) ?></td>
                            <td><?= h($childAvances->completado) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Avances', 'action' => 'view', $childAvances->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Avances', 'action' => 'edit', $childAvances->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Avances', 'action' => 'delete', $childAvances->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childAvances->id)]) ?>
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
