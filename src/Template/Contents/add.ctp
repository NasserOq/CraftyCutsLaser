<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Contents'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="contents form large-10 medium-9 columns">
    <?= $this->Form->create($content) ?>
    <fieldset>
        <legend><?= __('Add Content') ?></legend>
        <?php
            echo $this->Form->input('pageName');
            echo $this->TinyMCE->editor(['selector' => 'textarea']) ;
            echo $this->Form->inuput('content',['type'=>'textarea','rows' => '20','style'=>'margin: 0px; width: 1184px; height: 406px;']);
            
           
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
