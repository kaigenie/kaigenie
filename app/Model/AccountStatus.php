<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/22/13
 * Time: 7:06 PM
 * To change this template use File | Settings | File Templates.
 */

class AccountStatus {

  /**
   * Use is when account was first registered, but haven't been approved by Admin
   */
  const REGISTERED = 0;

  /**
   * Administrator is verifying the account.
   */
  const APPROVING = 1;

  /**
   * Account had been validate and approved and public
   */
  const ACTIVE = 2;

}