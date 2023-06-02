<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tarea $tarea
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Tarea'), ['action' => 'edit', $tarea->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Tarea'), ['action' => 'delete', $tarea->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tarea->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Tareas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Tarea'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tareas view content">
            <h3><?= h($tarea->tarea) ?></h3>
            <table>
                <tr>
                    <th><?= __('Tarea') ?></th>
                    <td><?= h($tarea->tarea) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($tarea->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Tecnicos') ?></h4>
                <?php if (!empty($tarea->tecnicos)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Delegacione Id') ?></th>
                            <th><?= __('Nombre') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($tarea->tecnicos as $tecnicos) : ?>
                        <tr>
                            <td><?= h($tecnicos->id) ?></td>
                            <td><?= h($tecnicos->delegacione_id) ?></td>
                            <td><?= h($tecnicos->nombre) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Tecnicos', 'action' => 'view', $tecnicos->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Tecnicos', 'action' => 'edit', $tecnicos->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tecnicos', 'action' => 'delete', $tecnicos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tecnicos->id)]) ?>
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
