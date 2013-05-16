<!-- List all registered Account -->

<div class="setup-box account-list">
  <div class="hd">
    <h4><?php echo __("Setup Account Menu") ?></h4>
  </div>
  <div class="con">


    <?php if(empty($account['Menu'])): ?>
      <p class="con-hints">You don't have any menu yet!
        <?php echo $this->UI->link(
          $this->Html->icon('icon-plus',__('Add Menu')),
          array(
            'controller' => 'menus',
            'accid' => $account['Account']['ID'],
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
        <li class="<?php if($firstMenu['ID'] == $menu['ID']):  echo "active"; endif;?>">
          <a href="#tabcon<?php echo $menu['ID'];?>" data-toggle="tab"><?php echo $menu['name'] ?></a>
        </li>
          <?php if($menu['ID'] == $lastMenu['ID']): // ID is unique to identify a menu?>
            <li>
              <?php echo $this->UI->link(
                $this->Html->icon('icon-plus',__('Add Menu')),
                array(
                  'controller' => 'menus',
                  'accid' => $account['Account']['ID'],
                  'action' => 'add'
                ),
                array('escape' => false ,'class'=>'add-menu')
              ) ?>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>

      <div id="menu-item-content" class="tab-content">

        <div class="tab-pane fade active in" id="tabcon9">
          <ul class="menu-item-list">
            <li>
              <div class="menu-item-image pull-left">
                <a href="http://grandpixels.com/linguini/wp-content/uploads/2012/01/04-caviar1.jpg">
                  <img src="http://grandpixels.com/linguini/wp-content/uploads/2012/01/04-caviar1-100x70.jpg" class="attachment-menucard-small wp-post-image">
                </a>
              </div>
              <div class="menu-item-content pull-right">
                <div class="menu-item-header">
                  <span class="menu-item-name pull-left">
                    <a href="http://grandpixels.com/linguini/food/item/original-caviar/" title="Original caviar">Original caviar</a>
                  </span>
                  <span class="menu-item-price pull-right">$49</span>
                </div><!-- item-header with price -->
                <p class="menu-item-desc pull-left">
                  Caviar, sometimes called black caviar, is a luxury delicacy, consisting of processed, salted, non-fertilized sturgeon roe.
                </p><!-- item-description -->
              </div>
            </li>
            <li>
              <div class="menu-item-image pull-left">
                <a href="http://grandpixels.com/linguini/wp-content/uploads/2012/01/04-caviar1.jpg">
                  <img src="http://grandpixels.com/linguini/wp-content/uploads/2012/01/04-caviar1-100x70.jpg" class="attachment-menucard-small wp-post-image">
                </a>
              </div>
              <div class="menu-item-content pull-right">
                <div class="menu-item-header">
                  <span class="menu-item-name pull-left">
                    <a href="http://grandpixels.com/linguini/food/item/original-caviar/" title="Original caviar">Original caviar</a>
                  </span>
                  <span class="menu-item-price pull-right">$49</span>
                </div><!-- item-header with price -->
                <p class="menu-item-desc pull-left">
                  Caviar, sometimes called black caviar, is a luxury delicacy, consisting of processed, salted, non-fertilized sturgeon roe.
                </p><!-- item-description -->
              </div>
            </li>
            <li>
              <a class="btn btn-danger"> Add an Item</a>
            </li>
          </ul>

        </div>

        <div class="tab-pane fade" id="tabcon10">
          <ul class="menu-item-list">
            <li>
              <div class="menu-item-image pull-left">
                <a href="http://grandpixels.com/linguini/wp-content/uploads/2012/01/04-caviar1.jpg">
                  <img src="http://grandpixels.com/linguini/wp-content/uploads/2012/01/04-caviar1-100x70.jpg" class="attachment-menucard-small wp-post-image">
                </a>
              </div>
              <div class="menu-item-content pull-right">
                <div class="menu-item-header">
                  <span class="menu-item-name pull-left">
                    <a href="http://grandpixels.com/linguini/food/item/original-caviar/" title="Original caviar">Original caviar</a>
                  </span>
                  <span class="menu-item-price pull-right">$49</span>
                </div><!-- item-header with price -->
                <p class="menu-item-desc pull-left">
                  Caviar, sometimes called black caviar, is a luxury delicacy, consisting of processed, salted, non-fertilized sturgeon roe.
                </p><!-- item-description -->
              </div>
            </li>
            <li>
              <div class="menu-item-image pull-left">
                <a href="http://grandpixels.com/linguini/wp-content/uploads/2012/01/04-caviar1.jpg">
                  <img src="http://grandpixels.com/linguini/wp-content/uploads/2012/01/04-caviar1-100x70.jpg" class="attachment-menucard-small wp-post-image">
                </a>
              </div>
              <div class="menu-item-content pull-right">
                <div class="menu-item-header">
                  <span class="menu-item-name pull-left">
                    <a href="http://grandpixels.com/linguini/food/item/original-caviar/" title="Original caviar">Original caviar</a>
                  </span>
                  <span class="menu-item-price pull-right">$49</span>
                </div><!-- item-header with price -->
                <p class="menu-item-desc pull-left">
                  Caviar, sometimes called black caviar, is a luxury delicacy, consisting of processed, salted, non-fertilized sturgeon roe.
                </p><!-- item-description -->
              </div>
            </li>
            <li>
              <a class="btn btn-danger btn-add-menu-item"> Add an Item</a>
            </li>
          </ul>
        </div>

      </div>

    <?php endif; ?>

  </div>
</div>



<?php echo $this->element("add_menu_form"); ?>
<?php echo $this->element("add_menu_item_form"); ?>
