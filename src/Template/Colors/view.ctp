<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Color'), ['action' => 'edit', $color->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Color'), ['action' => 'delete', $color->id], ['confirm' => __('Are you sure you want to delete # {0}?', $color->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Colors'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Color'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="colors view large-10 medium-9 columns">
    <h2><?= h($color->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Description') ?></h6>
            <p><?= h($color->description) ?></p>
            <h6 class="subheader"><?= __('Image Url') ?></h6>
            <p><?= h($color->image_url) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($color->id) ?></p>
            <h6 class="subheader"><?= __('Extra Price') ?></h6>
            <p><?= $this->Number->format($color->Extra_price) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Products') ?></h4>
    <?php if (!empty($color->products)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('ProductName') ?></th>
            <th><?= __('Color Id') ?></th>
            <th><?= __('Size Id') ?></th>
            <th><?= __('Material Id') ?></th>
            <th><?= __('Finish Id') ?></th>
            <th><?= __('Price') ?></th>
            <th><?= __('Quantity') ?></th>
            <th><?= __('MaxOrder') ?></th>
            <th><?= __('Tax Amount') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($color->products as $products): ?>
        <tr>
            <td><?= h($products->id) ?></td>
            <td><?= h($products->productName) ?></td>
            <td><?= h($products->color_id) ?></td>
            <td><?= h($products->size_id) ?></td>
            <td><?= h($products->material_id) ?></td>
            <td><?= h($products->finish_id) ?></td>
            <td><?= h($products->price) ?></td>
            <td><?= h($products->quantity) ?></td>
            <td><?= h($products->MaxOrder) ?></td>
            <td><?= h($products->tax_amount) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $products->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $products->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Products', 'action' => 'delete', $products->id], ['confirm' => __('Are you sure you want to delete # {0}?', $products->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
