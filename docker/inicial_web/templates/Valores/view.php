<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Valore $valore
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Valore'), ['action' => 'edit', $valore->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Valore'), ['action' => 'delete', $valore->id], ['confirm' => __('Are you sure you want to delete # {0}?', $valore->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Valores'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Valore'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="valores view content">
            <h3><?= h($valore->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Parametro') ?></th>
                    <td><?= $valore->has('parametro') ? $this->Html->link($valore->parametro->parametro, ['controller' => 'Parametros', 'action' => 'view', $valore->parametro->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Proyecto') ?></th>
                    <td><?= $valore->has('proyecto') ? $this->Html->link($valore->proyecto->corto, ['controller' => 'Proyectos', 'action' => 'view', $valore->proyecto->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Valor') ?></th>
                    <td><?= h($valore->valor) ?></td>
                </tr>
                <tr>
                    <th><?= __('Siguiente') ?></th>
                    <td><?= h($valore->siguiente) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($valore->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
