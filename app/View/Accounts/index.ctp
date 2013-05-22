<!-- List all registered Account -->

<div class="setup-box account-list">
  <div class="hd">
    <h4><?php echo __("List of Accounts") ?></h4>
  </div>
  <div class="con">
    <p class="con-hints">You could view, edit and upload pictures for accounts.</p>
    <table class="table table-hover">
      <thead>
      <tr>
        <th><?php echo __('Name') ?></th>
        <th><?php echo __('Level') ?></th>
        <th><?php echo __('Type') ?></th>
        <th><?php echo __('Action') ?></th>
      </tr>
      </thead>

      <?php foreach ($accounts as $account): ?>
        <tr>
          <td>
            <?php echo $this->Html->link($account['Account']['name'], array('action' => 'view', $account['Account']['ID'])); ?>
          </td>
          <td>
            <?php echo $account['Account']['level_name'] ?>
          </td>
          <td>
            <?php echo $account['Account']['type_name'] ?>
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
                    $this->Html->icon('icon-edit icon-large',__('Edit')),
                    array(
                      'controller' => 'accounts',
                      'action' => 'edit',
                      'accid' => $account['Account']['ID']
                    ),
                    array('escape' => false)
                  ) ?>
                </li>
                <li>
                  <?php echo $this->Html->link(
                    $this->Html->icon('icon-cloud-upload icon-large',__('Upload Photos')),
                    array(
                      'controller' => 'upload',
                      'type' => 'account',
                      'id' => $account['Account']['ID'],
                      "action" => "upload",
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
                <li>
                  <?php echo $this->Html->link(
                    $this->Html->icon('icon-cogs icon-large',__('Setup Menus')),
                    array(
                      'controller' => 'accounts',
                      'accid'=>$account['Account']['ID'],
                      'action' => 'menu'
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
  </div>
</div>

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
