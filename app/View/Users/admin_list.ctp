<div class="setup-box account-edit">
  <div class="hd">
    <h4><?php echo __("Account Administrator List") ?></h4>
  </div>

  <div class="con">
    <p class="con-hints">You could delete or set adminstrator expire date. </p>
    <?php if(empty($admins)):
        echo __("No record found.");
      ?>


      <?php else: ?>
      <table class="table table-hover">
        <thead>
        <tr>
          <th>Account</th>
          <th>Username</th>
          <th>Email</th>
          <th>Expired After</th>
          <th>Actions</th>
        </tr>
        </thead>
        <?php foreach ($admins as $key=>$admin): ?>
          <tr>
            <td><?php echo $admin['Account']['name']; ?></td>
            <td><?php echo $admin['User']['username']; ?></td>
            <td>
              <?php echo $admin['User']['email']; ?>
            </td>
            <td>
              <?php
              if(!empty($admin['AccountUser']['expired_date'])):
//              echo date('Y-M-d',strtotime($admin['AccountUser']['expired_date']));
                echo $this->Time->laterDays($admin['AccountUser']['expired_date']);
//          echo date('l jS F',strtotime($admin['AccountUser']['expired_date']));
              else:
                echo '<span class="label label-warning">Never</span>';
              endif; ?>
            </td>
            <td>
              <div class="btn-group">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                  Action
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <?php echo $this->Html->link(
                      $this->Html->icon('icon-trash icon-large',__('Delete')),
                      '#',
                      array('escape' => false,'class'=>'remove-admin', 'data-admin-id'=>$admin['AccountUser']['id'])
                    ) ?>
                  </li>
                  <li>
                    <?php echo $this->UI->link(
                      $this->Html->icon('icon-time icon-large',__('Set Expire Date')),
                      "#expire-date-modal",
                      array("escape"=>false, "role"=>"button", "data-toggle"=>"modal", "data-account-user" => $admin['AccountUser']['id'])
                    ) ?>
                  </li>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>

    <?php endif; ?>
  </div>

</div>


<?php
//  echo $this->UI->link( __('Add'), array(
//    'controller' => "users",
//    'action'     => 'add_admin'
//  ))
//?>

<div id="expire-date-modal" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4><?php echo __("Reset Expire Date") ?></h4>
  </div>
  <div class="modal-body">
    <?php echo $this->Form->create("User", array(
      'inputDefaults' => array('div'=>false, "label"=>false),
      'action' => 'expire_admin',
      'default' => true, // change it to false if you want to do ajax update.
      'id'  => 'form-set-expire-date'
      )
    ); ?>

    <input class="input-mini" type="number" name="expire-days" id="expire-days" value="0" min="-1"/>
    <span class="help-block">After days you setup, the administrator will not able to manage the account anymore.</span>


  </div>
  <div class="modal-footer">
    <a class="btn" href="#" data-dismiss="modal">Close</a>
    <?php
    $options = array(
      'label' => __('Set'),
      'class' => 'btn btn-primary pull-right',
      'div' => false,
      'id'  => 'btn-assign-admin'
    );
    echo $this->Form->end($options);
    ?>
  </div>
</div>

<div id="modal-admin-delete" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4></h4>
  </div>
  <div class="modal-body">Are you sure remove user from administrator list?</div>
  <div class="modal-footer">
    <a href="#" class="btn secondary">No</a>
    <a href="#" class="btn btn-danger">Yes</a>
  </div>
</div>

<script>
  $(document).ready(function(){

    var form = $('#form-set-expire-date');

    $("a[href='#expire-date-modal']").bind('click', function(){
      form.data('account-user', $(this).data('account-user'));
    });

    $('#btn-assign-admin').bind('click',function(event){
      var oldAction = form.attr('action');
      var newAction = oldAction + '/' + form.data('account-user') + '/' + $("#expire-days").val();
      form.attr('action',newAction);
    });

    var deleteModal = $("#modal-admin-delete");

    deleteModal.on('hide',function(){
      console.log(this);
    });

    $("a.remove-admin").on('click',function(event){
      event.preventDefault();
      // get admin id
      var anchor = $(this),
          id     = anchor.data('admin-id'),
          line   = anchor.parents('tr');

      // show confirmation modal
      deleteModal.modal({backdrop: true});

      deleteModal.find('a.secondary').click(function(){
        deleteModal.modal('hide');
      });

      deleteModal.find('a.btn-danger').click(function(event){
        var req =  $.ajax({
          'url' : '<?php echo Router::url(array("controller"=>"users", "action"=>"remove_admin")) ?>',
          'data': {
            id: id
          },
          'method': 'POST'
        });

        req.success(function(response){
          deleteModal.modal('hide');
          line.hide('slow',function(){
            line.remove();
          });
        });

      })
    })


  });
</script>