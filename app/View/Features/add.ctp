<div class="setup-box feature-new">
  <div class="hd">
    <h5><?php echo __("Add Feature") ?></h5>
  </div>
  <div class="con">

    <div class="span7">
      <?php echo $this->Form->create('Feature',array(
        'inputDefaults' => array('div'=>false, 'label'=>false),
        'class' => 'form-horizontal'
      ));?>

      <div class="control-group">
        <label class="control-label" for="account-street">Name</label>
        <div class="controls">
          <?php echo $this->Form->input('name', array('required'=>'true')); ?>

        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="account-telephone">Description</label>
        <div class="controls">
          <?php echo $this->Form->input('description') ?>
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
</div>
