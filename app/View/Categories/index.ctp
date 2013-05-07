<h1> <?php echo __('Categories List') ?></h1>

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
    <th>Category Name</th>
  </tr>
  </thead>
  <?php foreach ($categories as $key=>$category): ?>
    <tr>
      <td><?php echo $key + 1 ?></td>
      <td><?php echo $category['Category']['name']; ?></td>
    </tr>
  <?php endforeach; ?>

</table>