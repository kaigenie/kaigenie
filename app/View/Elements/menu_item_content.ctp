  <ul class="menu-item-list">
    <?php if(!empty($menu['MenuItem'])): ?>
      <?php foreach($menu['MenuItem'] as $item): ?>

        <?php
          $portrait = reset($item['ItemPortrait']);
        ?>

        <li>
          <div class="menu-item-image pull-left">
            <a href="<?php echo $portrait['medium_url'] ?>">
              <img src="<?php echo $portrait['thumbnail_url'] ?>">
            </a>
          </div>
          <div class="menu-item-content pull-right">
            <header class="menu-item-header">
                <span class="menu-item-name">
                  <a href="#" title="<?php echo $item['name'] ?>">
                    <?php echo $item['name'] ?>
                  </a>
                </span>
               <span class="menu-item-price pull-right">
                  <?php echo $item['price']?>
                </span>
            </header><!-- item-header with price -->
            <p class="menu-item-desc pull-left">
              <?php echo $item['description']?>
            </p><!-- item-description -->
          </div>
        </li>

      <?php endforeach;?>
    <?php endif; ?>

    <li>
      <a data-menu-id="<?php echo $menu['id'];?>" class="btn btn-danger btn-add-menu-item"> Add an Item</a>
    </li>
  </ul>

