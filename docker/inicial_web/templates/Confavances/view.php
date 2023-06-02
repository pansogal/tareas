<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Confavance $confavance
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Confavance'), ['action' => 'edit', $confavance->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Confavance'), ['action' => 'delete', $confavance->id], ['confirm' => __('Are you sure you want to delete # {0}?', $confavance->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Confavances'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Confavance'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="confavances view content">
            <h3><?= h($confavance->cavance) ?></h3>
            <table>
                <tr>
                    <th><?= __('Parent Confavance') ?></th>
                    <td><?= $confavance->has('parent_confavance') ? $this->Html->link($confavance->parent_confavance->cavance, ['controller' => 'Confavances', 'action' => 'view', $confavance->parent_confavance->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Prefijo') ?></th>
                    <td><?= h($confavance->prefijo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cavance') ?></th>
                    <td><?= h($confavance->cavance) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($confavance->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lft') ?></th>
                    <td><?= $this->Number->format($confavance->lft) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rght') ?></th>
                    <td><?= $this->Number->format($confavance->rght) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Explicacion') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($confavance->explicacion)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Confavances') ?></h4>
                <?php if (!empty($confavance->child_confavances)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Parent Id') ?></th>
                            <th><?= __('Lft') ?></th>
                            <th><?= __('Rght') ?></th>
                            <th><?= __('Prefijo') ?></th>
                            <th><?= __('Cavance') ?></th>
                            <th><?= __('Explicacion') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($confavance->child_confavances as $childConfavances) : ?>
                        <tr>
                            <td><?= h($childConfavances->id) ?></td>
                            <td><?= h($childConfavances->parent_id) ?></td>
                            <td><?= h($childConfavances->lft) ?></td>
                            <td><?= h($childConfavances->rght) ?></td>
                            <td><?= h($childConfavances->prefijo) ?></td>
                            <td><?= h($childConfavances->cavance) ?></td>
                            <td><?= h($childConfavances->explicacion) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Confavances', 'action' => 'view', $childConfavances->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Confavances', 'action' => 'edit', $childConfavances->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Confavances', 'action' => 'delete', $childConfavances->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childConfavances->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Tareas') ?></h4>
                <?php if (!empty($confavance->tareas)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Codigo') ?></th>
                            <th><?= __('Tarea') ?></th>
                            <th><?= __('Descripcion') ?></th>
                            <th><?= __('Documentar') ?></th>
                            <th><?= __('Critico') ?></th>
                            <th><?= __('Confavance Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($confavance->tareas as $tareas) : ?>
                        <tr>
                            <td><?= h($tareas->id) ?></td>
                            <td><?= h($tareas->codigo) ?></td>
                            <td><?= h($tareas->tarea) ?></td>
                            <td><?= h($tareas->descripcion) ?></td>
                            <td><?= h($tareas->documentar) ?></td>
                            <td><?= h($tareas->critico) ?></td>
                            <td><?= h($tareas->confavance_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Tareas', 'action' => 'view', $tareas->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Tareas', 'action' => 'edit', $tareas->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tareas', 'action' => 'delete', $tareas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tareas->id)]) ?>
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
