<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/27/13
 * Time: 10:33 PM
 * To change this template use File | Settings | File Templates.
 */

class AccountFeature extends AppModel{

  public $useTable = 'accounts_features';

  public $belongsTo = array(
    'Account', 'Feature'
  );
}