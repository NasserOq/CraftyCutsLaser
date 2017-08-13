<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $finish->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $finish->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Finishes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="finishes form large-10 medium-9 columns">
    <?= $this->Form->create($finish) ?>
    <fieldset>
        <legend><?= __('Edit Finish') ?></legend>
        <?php
            echo $this->Form->input('type');
            echo $this->Form->input('description');
            echo $this->Form->input('Extra_price');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
