<h1> Account Administrator List </h1>

<?php
  echo $this->UI->link( __('Add'), array(
    'controller' => "users",
    'action'     => 'add_admin'
  ))
?>

<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Id</th>
      <th>Name</th>
    </tr>
  </thead>

  <?php foreach ($admins as $key=>$admin): ?>
    <tr>
      <td><?php echo $key + 1 ?></td>
      <td><?php echo $admin['User']['username']; ?></td>
      <td>
        <?php echo $admin['User']['email']; ?>
      </td>
    </tr>
  <?php endforeach; ?>

</table>