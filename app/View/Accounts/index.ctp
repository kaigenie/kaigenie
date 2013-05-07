<!-- List all registered Account -->

<h1> List of Accounts</h1>

<table class="table table-hover">
    <thead>
      <tr>
        <th><?php __('Name') ?></th>
        <th><?php __('Edit') ?></th>
      </tr>
    </thead>

    <?php foreach ($accounts as $account): ?>
        <tr>
          <td>
              <?php echo $this->Html->link($account['Account']['name'], array('action' => 'view', $account['Account']['ID'])); ?>
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
                    $this->Html->icon('icon-picture icon-large',__('Upload Pictures')),
                    array(
                      'controller' => 'accounts',
                      'action' => 'upload',
                      $account['Account']['ID']
                    ),
                    array('escape' => false)
                  ) ?>
                </li>
<!--                <li class="divider"></li>-->

                <li>
                  <?php echo $this->Html->link(
                    $this->Html->icon('icon-edit icon-large',__('Edit')),
                    array(
                      'controller' => 'accounts',
                      'action' => 'edit',
                      $account['Account']['ID']
                    ),
                    array('escape' => false)
                  ) ?>
                </li>

                <li>
                  <?php echo $this->Html->link(
                    $this->Html->icon('icon-eye-open icon-large',__('View Detail')),
                    array(
                      'controller' => 'accounts',
                      'action' => 'view',
                      $account['Account']['ID']
                    ),
                    array('escape' => false)
                  ) ?>
                </li>
              </ul>
            </div>
          </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php

  if($this->Paginator->hasPage()){
    echo '<div class="pagination pagination-right"><ul>';
    if($this->Paginator->hasPrev()){
      echo $this->Paginator->prev('<<', array('tag' => 'li'), null, array('class' => 'disabled'));
    }

    echo $this->Paginator->numbers(array(
      'before' => '',
      'separator' => '',
      'currentClass' => 'active',
      'currentTag' => 'a',
      'tag' => 'li',
      'after' => ''
    ));

    if($this->Paginator->hasNext()){
      echo $this->Paginator->next('>>', array('tag' => 'li'), null, array('class' => 'disabled'));
    }

    echo '</ul></div>';
  }
?>
