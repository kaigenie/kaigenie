<?php
/**
 * Created by JetBrains PhpStorm.
 * User: I076004
 * Date: 5/11/13
 * Time: 10:52 AM
 * To change this template use File | Settings | File Templates.
 */

class Menu extends AppModel{

  public $hasMany = array('MenuItem');
  public $belongsTo = array("Account");

}