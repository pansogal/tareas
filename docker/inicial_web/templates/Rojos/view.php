<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rojo $rojo
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Rojo'), ['action' => 'edit', $rojo->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Rojo'), ['action' => 'delete', $rojo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rojo->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Rojos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Rojo'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="rojos view content">
            <h3><?= h($rojo->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($rojo->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Propio') ?></th>
                    <td><?= $this->Number->format($rojo->propio) ?></td>
                </tr>
                <tr>
                    <th><?= __('Noantesde') ?></th>
                    <td><?= $this->Number->format($rojo->noantesde) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Tareas') ?></h4>
                <?php if (!empty($rojo->esperas)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Codigo') ?></th>
                            <th><?= __('Tarea') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($rojo->esperas as $esperas) : ?>
                        <tr>
                            <td><?= h($esperas->id) ?></td>
                            <td><?= h($esperas->codigo) ?></td>
                            <td><?= h($esperas->tarea) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Tareas', 'action' => 'view', $esperas->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Tareas', 'action' => 'edit', $esperas->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tareas', 'action' => 'delete', $esperas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $esperas->id)]) ?>
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
