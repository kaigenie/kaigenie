<div class="category-list setup-box">
  <div class="hd">
    <h5> <?php echo __('Categories List') ?></h5>
  </div>
  <div class="con">
    <div class="span12">
      <a class="btn btn-small btn-success add " href="<?php echo Router::url(array('action'=> 'add')) ?>">
        <i class="icon-plus-sign"></i>
        <span>New</span>
      </a>
    </div>
    <?php if(empty($categories)):
      echo __("No Record found");
    ?>
    <?php else: ?>

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

    <?php endif;?>


  </div>
</div>

