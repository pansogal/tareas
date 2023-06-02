<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Accione $accione
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Accione'), ['action' => 'edit', $accione->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Accione'), ['action' => 'delete', $accione->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accione->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Acciones'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Accione'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="acciones view content">
            <h3><?= h($accione->accion) ?></h3>
            <table>
                <tr>
                    <th><?= __('Avance') ?></th>
                    <td><?= $accione->has('avance') ? $this->Html->link($accione->avance->avance, ['controller' => 'Avances', 'action' => 'view', $accione->avance->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Accion') ?></th>
                    <td><?= h($accione->accion) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($accione->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($accione->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($accione->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Iniciada') ?></th>
                    <td><?= h($accione->iniciada) ?></td>
                </tr>
                <tr>
                    <th><?= __('Finalizada') ?></th>
                    <td><?= h($accione->finalizada) ?></td>
                </tr>
                <tr>
                    <th><?= __('Realizada') ?></th>
                    <td><?= $accione->realizada ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Descripcion') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($accione->descripcion)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Documentar') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($accione->documentar)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Tecnicos') ?></h4>
                <?php if (!empty($accione->tecnicos)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Delegacione Id') ?></th>
                            <th><?= __('Nombre') ?></th>
                            <th><?= __('Cargo') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($accione->tecnicos as $tecnicos) : ?>
                        <tr>
                            <td><?= h($tecnicos->id) ?></td>
                            <td><?= h($tecnicos->delegacione_id) ?></td>
                            <td><?= h($tecnicos->nombre) ?></td>
                            <td><?= h($tecnicos->cargo) ?></td>
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
