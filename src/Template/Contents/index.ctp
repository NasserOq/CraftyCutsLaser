<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Content'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="contents index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('pageName') ?></th>
            <th><?= $this->Paginator->sort('content') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($contents as $content): ?>
        <tr>
            <td><?= $this->Number->format($content->id) ?></td>
            <td><?= h($content->pageName) ?></td>
            <td><?= h($content->content) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $content->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $content->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $content->id], ['confirm' => __('Are you sure you want to delete {0}?', $content->pageName)]) ?>
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
