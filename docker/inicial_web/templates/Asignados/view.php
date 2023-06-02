<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asignado $asignado
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Asignado'), ['action' => 'edit', $asignado->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Asignado'), ['action' => 'delete', $asignado->id], ['confirm' => __('Are you sure you want to delete # {0}?', $asignado->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Asignados'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Asignado'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="asignados view content">
            <h3><?= h($asignado->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Tarea') ?></th>
                    <td><?= $asignado->has('tarea') ? $this->Html->link($asignado->tarea->id, ['controller' => 'Tareas', 'action' => 'view', $asignado->tarea->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Tecnico') ?></th>
                    <td><?= $asignado->has('tecnico') ? $this->Html->link($asignado->tecnico->id, ['controller' => 'Tecnicos', 'action' => 'view', $asignado->tecnico->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($asignado->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
