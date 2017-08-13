<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Orderdetail'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</div>
<?= $this->Html->script('https://code.jquery.com/jquery-2.1.3.js') ?>
	<?= $this->Html->script('jspdf.js') ?>
	<?= $this->Html->script('standard_fonts_metrics.js') ?>
	<?= $this->Html->script('split_text_to_size.js') ?>
	<?= $this->Html->script('from_html.js') ?>
	<?= $this->Html->script('cell.js') ?>
	<?= $this->Html->script('FileSaver.js') ?>
	<script type="text/javascript">
        $(document).ready(function() {

            $("#exportpdf").click(function() {
                var pdf = new jsPDF('p', 'pt', 'ledger');
                // source can be HTML-formatted string, or a reference
                // to an actual DOM element from which the text will be scraped.
                source = $('#list')[0];

                // we support special element handlers. Register them with jQuery-style 
                // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
                // There is no support for any other type of selectors 
                // (class, of compound) at this time.
                specialElementHandlers = {
                    // element with id of "bypass" - jQuery style selector
                    '#bypassme' : function(element, renderer) {
                        // true = "handled elsewhere, bypass text extraction"
                        return true
                    }
                };
                margins = {
                    top : 80,
                    bottom : 60,
                    left : 60,
                    width : 522
                };
                // all coords and widths are in jsPDF instance's declared units
                // 'inches' in this case
                pdf.fromHTML(source, // HTML string or DOM elem ref.
                margins.left, // x coord
                margins.top, { // y coord
                    'width' : margins.width, // max width of content on PDF
                    'elementHandlers' : specialElementHandlers
                },

                function(dispose) {
                    // dispose: object with X, Y of the last line add to the PDF 
                    //          this allow the insertion of new lines after html
                    pdf.save('purchased-history-list.pdf');
                }, margins);
            });

        });
    </script>
<div class="orderdetails index large-10 medium-9 columns">
 <input type="button" id="exportpdf" value="Download PDF">
	<div id="list">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('order_id') ?></th>
            <th><?= $this->Paginator->sort('product_id') ?></th>
            <th><?= $this->Paginator->sort('quantity') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($orderdetails as $orderdetail): ?>
        <tr>
            <td>
                <?= $orderdetail->has('order') ? $this->Html->link($orderdetail->order->id, ['controller' => 'Orders', 'action' => 'view', $orderdetail->order->id]) : '' ?>
            </td>
            <td>
                <?= $orderdetail->has('product') ? $this->Html->link($orderdetail->product->id, ['controller' => 'Products', 'action' => 'view', $orderdetail->product->id]) : '' ?>
            </td>
            <td><?= h($orderdetail->quantity) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $orderdetail->order_id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderdetail->order_id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orderdetail->order_id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderdetail->order_id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
	</div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
