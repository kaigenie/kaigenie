<?php
$this->extend('/Features/common');
?>

<table>
  <tr>
    <th>Id</th>
    <th>Name</th>
  </tr>

  <?php foreach ($features as $feature): ?>
    <tr>
      <td><?php echo $feature['Feature']['ID']; ?></td>
      <td>
        <?php echo $this->Html->link($feature['Feature']['name'], array('action' => 'edit', $feature['Feature']['ID'])); ?>
      </td>
    </tr>
  <?php endforeach; ?>

</table>