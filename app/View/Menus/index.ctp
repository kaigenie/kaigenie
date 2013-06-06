<!-- List all registered Account -->

<div class="setup-box account-list">
  <div class="hd">
    <h4><?php echo __("Setup Menu of ") . $account['Account']['name'] ?></h4>
  </div>
  <div class="con">
    <?php if(empty($account['Menu'])): ?>
      <p class="con-hints">You don't have any menu yet!
        <?php echo $this->UI->link(
          $this->Html->icon('icon-plus',__('Add Menu')),
          array(
            'controller' => 'menus',
            'accid' => $account['Account']['id'],
            'action' => 'add'
          ),
          array('escape' => false ,'class'=>'btn add-menu')
        ) ?>
      </p>

    <?php else: ?>
      <?php
      $allAccountMenus = $account['Menu'];
      $lastMenu = end($allAccountMenus);
      $firstMenu = reset($allAccountMenus);
      ?>
      <ul class="nav nav-tabs" id="menu-tab">
        <?php foreach($allAccountMenus as $menuKey => $menu): ?>
        <li class="<?php if($firstMenu['id'] == $menu['id']):  echo "active"; endif;?>">
          <a data-menu-name="<?php echo $menu['name'] ?>" href="#tabcon<?php echo $menu['id'];?>" data-toggle="tab"><?php echo $menu['name'] ?></a>
        </li>
          <?php if($menu['id'] == $lastMenu['id']): // id is unique to identify a menu?>
            <li>
              <?php echo $this->UI->link(
                $this->Html->icon('icon-plus',__('Add Menu')),
                array(
                  'controller' => 'menus',
                  'accid' => $account['Account']['id'],
                  'action' => 'add'
                ),
                array('escape' => false ,'class'=>'add-menu')
              ) ?>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>

      <div id="menu-item-content" class="tab-content">

        <?php foreach($allAccountMenus as $menuKey => $menu): ?>
          <div class="tab-pane fade <?php if($firstMenu['id'] == $menu['id']):  echo "in active"; endif;?>" id="tabcon<?php echo $menu['id'];?>">
            <?php echo $this->element("menu_item_content", array("menu"=>$menu)) ?>
          </div>
        <?php endforeach;?>
      </div>

    <?php endif; ?>

  </div>
</div>
<?php echo $this->element("add_menu_form"); ?>
<?php echo $this->element("add_menu_item_form"); ?>

<script type="text/javascript">
  $(function(){
    if (location.hash !== '') $('a[href="' + location.hash + '"]').tab('show');
    return $('a[data-toggle="tab"]').on('shown', function(e) {
      return location.hash = $(e.target).attr('href').substr(1);
    });
  });
</script>
