<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Parametro $parametro
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Parametro'), ['action' => 'edit', $parametro->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Parametro'), ['action' => 'delete', $parametro->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parametro->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Parametros'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Parametro'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="parametros view content">
            <h3><?= h($parametro->parametro) ?></h3>
            <table>
                <tr>
                    <th><?= __('Familia') ?></th>
                    <td><?= h($parametro->familia) ?></td>
                </tr>
                <tr>
                    <th><?= __('Parametro') ?></th>
                    <td><?= h($parametro->parametro) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($parametro->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Indice') ?></th>
                    <td><?= $this->Number->format($parametro->indice) ?></td>
                </tr>
                <tr>
                    <th><?= __('Requiere Doc') ?></th>
                    <td><?= $parametro->requiere_doc ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Puede Otro') ?></th>
                    <td><?= $parametro->puede_otro ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Describe') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($parametro->describe)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Valores') ?></h4>
                <?php if (!empty($parametro->valores)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Parametro Id') ?></th>
                            <th><?= __('Proyecto Id') ?></th>
                            <th><?= __('Valor') ?></th>
                            <th><?= __('Siguiente') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($parametro->valores as $valores) : ?>
                        <tr>
                            <td><?= h($valores->id) ?></td>
                            <td><?= h($valores->parametro_id) ?></td>
                            <td><?= h($valores->proyecto_id) ?></td>
                            <td><?= h($valores->valor) ?></td>
                            <td><?= h($valores->siguiente) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Valores', 'action' => 'view', $valores->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Valores', 'action' => 'edit', $valores->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Valores', 'action' => 'delete', $valores->id], ['confirm' => __('Are you sure you want to delete # {0}?', $valores->id)]) ?>
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
