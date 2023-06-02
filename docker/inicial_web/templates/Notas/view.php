<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Nota $nota
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Nota'), ['action' => 'edit', $nota->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Nota'), ['action' => 'delete', $nota->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nota->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Notas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Nota'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="notas view content">
            <h3><?= h($nota->titulo) ?></h3>
            <table>
                <tr>
                    <th><?= __('Parent Nota') ?></th>
                    <td><?= $nota->has('parent_nota') ? $this->Html->link($nota->parent_nota->titulo, ['controller' => 'Notas', 'action' => 'view', $nota->parent_nota->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $nota->has('user') ? $this->Html->link($nota->user->usuario, ['controller' => 'Users', 'action' => 'view', $nota->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Accione') ?></th>
                    <td><?= $nota->has('accione') ? $this->Html->link($nota->accione->accion, ['controller' => 'Acciones', 'action' => 'view', $nota->accione->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Titulo') ?></th>
                    <td><?= h($nota->titulo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($nota->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Left') ?></th>
                    <td><?= $nota->left === null ? '' : $this->Number->format($nota->left) ?></td>
                </tr>
                <tr>
                    <th><?= __('Right') ?></th>
                    <td><?= $nota->right === null ? '' : $this->Number->format($nota->right) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($nota->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($nota->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Texto') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($nota->texto)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Notas') ?></h4>
                <?php if (!empty($nota->child_notas)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Parent Id') ?></th>
                            <th><?= __('Left') ?></th>
                            <th><?= __('Right') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Accione Id') ?></th>
                            <th><?= __('Titulo') ?></th>
                            <th><?= __('Texto') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($nota->child_notas as $childNotas) : ?>
                        <tr>
                            <td><?= h($childNotas->id) ?></td>
                            <td><?= h($childNotas->parent_id) ?></td>
                            <td><?= h($childNotas->left) ?></td>
                            <td><?= h($childNotas->right) ?></td>
                            <td><?= h($childNotas->user_id) ?></td>
                            <td><?= h($childNotas->accione_id) ?></td>
                            <td><?= h($childNotas->titulo) ?></td>
                            <td><?= h($childNotas->texto) ?></td>
                            <td><?= h($childNotas->created) ?></td>
                            <td><?= h($childNotas->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Notas', 'action' => 'view', $childNotas->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Notas', 'action' => 'edit', $childNotas->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Notas', 'action' => 'delete', $childNotas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childNotas->id)]) ?>
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
