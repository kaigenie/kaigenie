<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'KaiGenie');
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $cakeDescription ?>:
        <?php echo $title_for_layout; ?>
    </title>
    <?php
    echo $this->Html->meta('icon');
    echo $this->Html->css('cake.changed');
    echo $this->Html->css('bootstrap');
    echo $this->Html->css('datepicker');
//    echo $this->Html->css('bootstrap-responsive');
    echo $this->Html->css('font-awesome');
    echo $this->Html->css('main');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    echo $this->Html->script('jquery-1.9.1');
    echo $this->Html->script('bootstrap');
    echo $this->Html->script('jquery.uploadifive');
    echo $this->Html->script('bootstrap-datepicker');
    ?>
</head>
<body>
<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <div class="container">
      <div class="container-fluid">
        <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="brand" href="#"><i class='icon-trophy'></i>Kaigenie</a>
        <div class="nav-collapse collapse">
          <?php if($this->Access->loggedIn()){ ?>
            <p class="navbar-text pull-right">
                Logged in as <a href="#" class="navbar-link">
                    <?php echo $this->Access->getUsername() ?>
                </a>
            </p>
        <?php } ?>
        <ul class="nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </div>
    </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span11 main">
      <?php echo $this->Session->flash(); ?>
      <?php echo $this->fetch('content'); ?>
    </div>
  </div>
</div>

<?php echo $this->element('sql_dump'); ?>
</body>
</html>
