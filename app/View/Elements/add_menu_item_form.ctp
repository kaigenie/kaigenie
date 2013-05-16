<div id="modal-add-menu-item" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4>Add Menu Item</h4>
  </div>
  <div class="modal-body">
    <?php
    echo $this->Form->create('MenuItem',array(
      'inputDefaults' => array('div'=>false, 'label'=>false),
      'url'=>array('controller' => 'menus', 'action' => 'add_item'),
      'default' => true,
      'id'      => 'form-add-menu-item',
      'type' => 'file'
    ));
    ?>

    <div class="controls controls-row">
      <?php
      echo $this->Form->input('name', array(
        'type'        => 'text',
        'placeholder' => __('Menu Name'),
        'class'       => 'span4'
      ));
      echo $this->Form->input('price', array(
        'type'        => 'text',
        'placeholder' => __('Price'),
        'class'       => 'span2'
      ));
      echo $this->Form->input('currency', array(
        'type'        => 'text',
        'placeholder' => __('Currency'),
        'class'       => 'span2'
      ));
      echo $this->Form->hidden('account_id' ,array("value" => $account['Account']['ID']));
      echo $this->Form->hidden('menu_id' ,array("value" => '10'));
      ?>
    </div>
    <div class="controls">
      <?php
      echo $this->Form->textarea('description', array(
        'type'        => 'text',
        'placeholder' => __('Description that make people order...'),
        'class'       => 'span8'
      ));
      ?>
    </div>

    <div class="controls controls-row">
      <?php
      echo $this->Form->input('valid_from', array(
        'type'        => 'text',
        'placeholder' => __('Valid From'),
        'class'       => 'span4 datepicker'
      ));
      echo $this->Form->input('valid_to', array(
        'type'        => 'text',
        'placeholder' => __('Valid to'),
        'class'       => 'span4 datepicker'
      ));
      ?>
    </div>
    <div class="controls controls-row">
    <span class="btn btn-success fileinput-button">
        <i class="icon-plus icon-white"></i>
        <span>Add files...</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="item-image" type="file" name="item-image">
    </span>
    </div>

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <?php
    $options = array(
      'label' => __('Add'),
      'class' => 'btn btn-primary pull-right',
      'div' => false,
      'id'  => 'btn-add-menu'
    );
    echo $this->Form->end($options);
    ?>
  </div>
</div>

<script>
  $(function(){
    $('.datepicker').datepicker({
      autoclose: true
    });
    $("a.btn-add-menu-item").bind('click', function(event){
      event.preventDefault();
      $("#modal-add-menu-item").modal('show');
    });
  });
</script>