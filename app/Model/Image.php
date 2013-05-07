<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 5/4/13
 * Time: 8:53 PM
 * To change this template use File | Settings | File Templates.
 */

class Image extends AppModel{

  /**
   * Images were uploaded by either Account Admin or Super Administrator,
   * and the image will be loaded on account detail page.
   * @var array
   */
  public $belongsTo = array(
    'User',
    'Account'
  );

}