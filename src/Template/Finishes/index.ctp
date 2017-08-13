<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Finish'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="finishes index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('type') ?></th>
            <th><?= $this->Paginator->sort('description') ?></th>
            <th><?= $this->Paginator->sort('Extra_price') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($finishes as $finish): ?>
        <tr>
            <td><?= $this->Number->format($finish->id) ?></td>
            <td><?= h($finish->type) ?></td>
            <td><?= h($finish->description) ?></td>
            <td><?= $this->Number->format($finish->Extra_price) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $finish->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $finish->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $finish->id], ['confirm' => __('Are you sure you want to delete # {0}?', $finish->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
