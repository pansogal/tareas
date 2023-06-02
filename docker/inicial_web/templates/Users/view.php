<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <h3><?= h($user->usuario) ?></h3>
            <table>
                <tr>
                    <th><?= __('Tecnico') ?></th>
                    <td><?= $user->has('tecnico') ? $this->Html->link($user->tecnico->nombre, ['controller' => 'Tecnicos', 'action' => 'view', $user->tecnico->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Usuario') ?></th>
                    <td><?= h($user->usuario) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Esadmin') ?></th>
                    <td><?= $user->esadmin ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Notas') ?></h4>
                <?php if (!empty($user->notas)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Titulo') ?></th>
                            <th><?= __('Texto') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->notas as $notas) : ?>
                        <tr>
                            <td><?= h($notas->id) ?></td>
                            <td><?= h($notas->user_id) ?></td>
                            <td><?= h($notas->titulo) ?></td>
                            <td><?= h($notas->texto) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Notas', 'action' => 'view', $notas->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Notas', 'action' => 'edit', $notas->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Notas', 'action' => 'delete', $notas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notas->id)]) ?>
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
