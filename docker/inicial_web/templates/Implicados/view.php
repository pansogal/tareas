<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Implicado $implicado
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Implicado'), ['action' => 'edit', $implicado->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Implicado'), ['action' => 'delete', $implicado->id], ['confirm' => __('Are you sure you want to delete # {0}?', $implicado->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Implicados'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Implicado'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="implicados view content">
            <h3><?= h($implicado->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Accione') ?></th>
                    <td><?= $implicado->has('accione') ? $this->Html->link($implicado->accione->accion, ['controller' => 'Acciones', 'action' => 'view', $implicado->accione->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Tecnico') ?></th>
                    <td><?= $implicado->has('tecnico') ? $this->Html->link($implicado->tecnico->id, ['controller' => 'Tecnicos', 'action' => 'view', $implicado->tecnico->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($implicado->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fecha Limite') ?></th>
                    <td><?= h($implicado->fecha_limite) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fecha Inicio') ?></th>
                    <td><?= h($implicado->fecha_inicio) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
