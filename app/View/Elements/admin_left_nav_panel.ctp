<div class="well sidebar-nav">
        <ul class="nav nav-list">
          <li class="nav-header">Account Setup</li>
          <li>
            <?php echo $this->Html->link(
              $this->Html->icon('icon-food icon-large',__('Accounts')),
              array(
                'controller' => 'accounts',
                'action'  => 'index'
              ),
              array('escape' => false)
            ) ?>
          </li>
          <li>
            <?php echo $this->Html->link(
              $this->Html->icon('icon-home icon-large',__('Create Account')),
              array(
                'controller' => 'accounts',
                'action' => 'add'
              ),
              array('escape' => false)
            ) ?>
          </li>
          <li>
            <?php echo $this->Html->link(
              $this->Html->icon('icon-user icon-large',__('Administrator')),
              array(
                'controller' => 'users',
                'action' => 'list_admin'
              ),
              array('escape' => false)
            ) ?>
          </li>

          <li class="nav-header">User Setting</li>

          <li>
            <?php echo $this->Html->link(
              $this->Html->icon('icon-key icon-large',__('User Info')),
              array(
                'controller' => 'users',
                'action' => 'setup'
              ),
              array('escape' => false)
            ) ?>
          </li>

          <li class="nav-header">Master Data</li>
          <li>
            <?php echo $this->Html->link(
              $this->Html->icon('icon-file icon-large',__('Account Feature')),
              array(
                'controller' => 'features',
                'action' => 'index'
              ),
              array('escape' => false)
            ) ?>
          </li>
          <li>
            <?php echo $this->Html->link(
              $this->Html->icon('icon-file icon-large',__('Category')),
              array(
                'controller' => 'categories',
                'action' => 'index'
              ),
              array('escape' => false)
            ) ?>
          </li>
        </ul>
</div>