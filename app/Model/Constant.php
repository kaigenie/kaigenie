<?php
/**
 * Created by JetBrains PhpStorm.
 * User: I076004
 * Date: 6/9/13
 * Time: 9:30 PM
 * To change this template use File | Settings | File Templates.
 */

class Constant {

  const REVIEW_PENDING  = 0;
  const REVIEW_APPROVED = 1;
  const REVIEW_REJECTED = -1;

  public static $REVIEW_STATUS = array(
    'pending' => self::REVIEW_PENDING,
    'approved'=> self::REVIEW_APPROVED,
    'rejected'=> self::REVIEW_REJECTED
  );

}