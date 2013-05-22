<div class="setup-box category-new">
  <div class="hd"><h5><?php echo __('Add Category') ?></h5></div>
  <div class="con span7">
    <?php
      echo $this->Form->create('Category', array(
      'inputDefaults' => array('div'=>false, 'label'=>false),
      'class' => 'form-horizontal'
    ));
    ?>
    <div class="control-group">
      <label class="control-label" for="account-street">Name</label>
      <div class="controls">
        <?php echo $this->Form->input('name', array('required'=>'true')); ?>

      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="account-street">Description</label>
      <div class="controls">
        <?php echo $this->Form->input('description', array(
          'type' => 'textarea',
          'rows' => 3,
          'cols' => 5
        )); ?>
      </div>
    </div>

    <?php
    $options = array(
      'label' => __('Add'),
      'class' => 'btn btn-primary pull-right',
      'div' => false
    );
    echo $this->Form->end($options);
    ?>
  </div>
</div>



