<?php $this->set('title', 'Edit About us ');?>


<div class="contents form large-10 medium-9 columns">
    <?= $this->Form->create($content) ?>
    <fieldset>
        <legend><?= __('Edit Content') ?></legend>
 
        <?php
            echo $this->TinyMCE->editor(['selector' => 'textarea']) ;
            echo $this->Form->input('content',['type'=>'textarea','rows' => '20','style'=>'margin: 0px; width: 1184px; height: 406px;']);

        ?>
    </fieldset>
    <?= $this->Form->button(__('Save Changes',['class' => 'btn btn-default'])) ?>
 

    <?= $this->Form->end() ?>
</div>
