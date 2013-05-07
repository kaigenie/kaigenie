<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 5/5/13
 * Time: 3:42 PM
 * To change this template use File | Settings | File Templates.
 */

class AccountCategory extends AppModel{
  public $useTable = 'accounts_categories';

  public $belongsTo = array(
    'Account', 'Category'
  );
}