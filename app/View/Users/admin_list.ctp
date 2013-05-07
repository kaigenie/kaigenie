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
      <th>#</th>
      <th>Account</th>
      <th>Username</th>
      <th>Email</th>
      <th>Expire Date</th>
      <th>Actions</th>
    </tr>
  </thead>

  <?php foreach ($admins as $key=>$admin): ?>
    <tr>
      <td><?php echo $key + 1 ?></td>
      <td><?php echo $admin['Account']['name']; ?></td>
      <td><?php echo $admin['User']['username']; ?></td>
      <td>
        <?php echo $admin['User']['email']; ?>
      </td>
      <td><?php echo $admin['AccountUser']['expired_date']; ?></td>
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
                  'action' => 'list_admin',
                  $admin['Account']['ID'],
                  $admin['User']['ID']
                ),
                array('escape' => false)
              ) ?>
            </li>
            <li>
              <?php echo $this->Html->link(
                $this->Html->icon('icon-time icon-large',__('Set Expire Date')),
                array(
                  'controller' => 'users',
                  'action' => 'list_admin',
                  $admin['Account']['ID'],
                  $admin['User']['ID']
                ),
                array('escape' => false)
              ) ?>
            </li>
        </div>

      </td>
    </tr>
  <?php endforeach; ?>

</table>