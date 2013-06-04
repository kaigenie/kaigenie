
<div>
  <?php
  echo $this->UI->link('Add', array(
    'controller' => 'features',
    'action'     => 'add'
  ));
  ?>

</div>

<?php echo $this->fetch('content'); ?>