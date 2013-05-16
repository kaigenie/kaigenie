<?php
/**
 * Created by JetBrains PhpStorm.
 * User: I076004
 * Date: 5/11/13
 * Time: 10:52 AM
 * To change this template use File | Settings | File Templates.
 */

class MenuItem extends AppModel{

  public $belongsTo = array('Menu');

  public $useTable = 'menuitem';
}