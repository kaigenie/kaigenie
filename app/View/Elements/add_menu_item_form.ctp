<style type="text/css">
  .add-menu-item{
    position: relative;
  }
  .item-portrait{
    position: absolute;
    overflow: hidden;
    width: 120px;
    height: 120px;
    right: 10px;
    top:10px;
    border:2px dotted #ccc;
    border-radius: 10px;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    text-align: center;
    line-height: 150px;
    padding: 5px;
  }

  .item-portrait canvas, .item-portrait img{
    position: absolute;
    top: 5px;
    left: 5px;
    margin-right: 5px;
  }

  .item-portrait input {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    opacity: 0;
    filter: alpha(opacity=0);
    transform: translate(-300px, 0) scale(4);
    font-size: 23px;
    height:120px;
    width:150px;
    direction: ltr;
    cursor: pointer;
  }
</style>
<div id="modal-add-menu-item" class="modal fade hide" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4>Add Menu Item</h4>
  </div>
  <div class="modal-body add-menu-item">
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
        'placeholder' => __('Item Name'),
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
      echo $this->Form->hidden('account_id' ,array("value" => $account['Account']['id']));
      echo $this->Form->hidden('menu_id', array("id"=>"menu_id"));
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
    <div class="item-portrait">
      <div id="files"></div>
      <span class="portrait-holder">
          <i class="icon-plus icon-white"></i>
          <em>Add an Image...</em>
          <!-- The file input field used as target for the file upload widget -->
          <input id="item-image" type="file" name="files">
      </span>
      <!-- The container for the uploaded files -->
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
<?php echo $this->UI->loadJ5upBasic(); ?>
<script>
  $(function(){
    $('.datepicker').datepicker({
      autoclose: true
    });
    $("a.btn-add-menu-item").bind('click', function(event){
      event.preventDefault();
      var modalForm = $("#modal-add-menu-item");
      modalForm.find('#menu_id').prop('value',$(this).data('menu-id'));
      modalForm.modal('show');
    });

    $("#item-image").bind("change",function(e){

      $(".item-portrait img").remove();
      $(".item-portrait canvas").remove();


      window.loadImage(
        e.target.files[0],
        function(img){
          $(".item-portrait").append(img);
        },
        {
//          canvas: true,
          maxWidth: 150

        }
      )
    })

  });
</script>