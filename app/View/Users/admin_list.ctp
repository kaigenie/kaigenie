<h1> Account Administrator List </h1>

<?php
//  echo $this->UI->link( __('Add'), array(
//    'controller' => "users",
//    'action'     => 'add_admin'
//  ))
//?>

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
                array(
                  'controller' => 'users',
                  'action' => 'delete_admin',
                  $admin['AccountUser']['ID']
                ),
                array('escape' => false)
              ) ?>
            </li>
            <li>
              <?php echo $this->UI->link(
                $this->Html->icon('icon-time icon-large',__('Set Expire Date')),
                "#expire-date-modal",
                array("escape"=>false, "role"=>"button", "data-toggle"=>"modal", "data-account-user" => $admin['AccountUser']['ID'])
              ) ?>
            </li>
        </div>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

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
  });
</script>