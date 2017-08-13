
<?php $this->set('title', 'About us ');?>


<div class="contents view large-10 medium-9 columns">
   <!-- <h2><?= h($content->id) ?></h2>-->
    <div class="row">

      <!--  <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($content->id) ?></p>
        </div>
        </div>-->

    
            <div class="tab-content product-detail-info ">
             
            <?= $this->Text->autoParagraph($content->content) ?>
        
        </div>
    </div>

