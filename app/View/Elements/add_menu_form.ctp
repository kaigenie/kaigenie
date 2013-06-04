<div id="modal-add-menu" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4>Add an Menu</h4>
  </div>
  <div class="modal-body">
    <?php
    echo $this->Form->create('Menu',array(
      'inputDefaults' => array('div'=>false, 'label'=>false),
      'url'=>array('controller' => 'menus', 'action' => 'add'),
      'default' => true,
      'id'      => 'form-add-menu'
    ));
    ?>

    <div class="controls">
      <?php
      echo $this->Form->input('name', array(
        'type'        => 'text',
        'placeholder' => __('Menu Name'),
        'class'       => 'span8'
      ));
      echo $this->Form->hidden('account_id' ,array("value" => $account['Account']['ID']));
      ?>
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
    $('a.add-menu').bind('click', function(event){
      event.preventDefault();
      $("#modal-add-menu").modal();
    });
  });
</script>