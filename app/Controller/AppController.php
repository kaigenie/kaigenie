<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */



class AppController extends Controller {

    // Add DebugKit Toolbar, remove it as need
  // public $components = array('DebugKit.Toolbar');

  public $components = array(
    'Acl',
    'Auth' => array(
      'className' => 'GroupAuth',
      'authorize' => array(
        'Actions' => array('actionPath' => 'controllers')
      ),
      'authError' => 'do you really think you are allow to see that?',
      'authenticate' => array(
        'Form' => array(
          'fields' => array('username' => 'username')
        )
      )
    ),
    'Session', 'Paginator',
    'DebugKit.Toolbar'
  );
    public $helpers = array(
      'Html'    => array('className' => 'UI'),
      'Time'    => array('className' => 'MyTime'),
      'Js'      => array('Jquery'),
      "Access"  => array(
        "className" => 'Access'
      )
    );

  public function beforeFilter() {
    //Configure AuthComponent
    $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
    $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
    $this->Auth->loginRedirect = array('controller' => 'accounts', 'action' => 'add');

    $this->Auth->actionPath = 'controllers/';
    $this->Auth->authorize = 'actions';

    /**
      * AuthComponent needs to know about the existence of this root node, 
      * so that when making ACL checks it can use the correct node path.
      */
    $this->Auth->actionPath = 'controllers/';
  }

  /**
   * Rebuild the Acl based on the current controllers in the application
   *
   * @return void
   */
  public  function buildAcl() {
    $log = array();

    $aco =& $this->Acl->Aco;
    $root = $aco->node('controllers');
    if (!$root) {
      $aco->create(array('parent_id' => null, 'model' => null, 'alias' => 'controllers'));
      $root = $aco->save();
      $root['Aco']['id'] = $aco->id;
      $log[] = 'Created Aco node for controllers';
    } else {
      $root = $root[0];
    }

    App::import('Core', 'File');
    // change Configure:listObjects to Configure::objects
    $Controllers = App::objects('controller');
    $appIndex = array_search('AppController', $Controllers);
    if ($appIndex !== false ) {
      unset($Controllers[$appIndex]);
    }
    $baseMethods = get_class_methods('Controller');
    $baseMethods[] = 'buildAcl';

    // look at each controller in app/controllers
    foreach ($Controllers as $ctrlName) {
      $shortCtrlName = chop($ctrlName,'Controller');
      App::import('Controller', $shortCtrlName);
      $methods = get_class_methods($ctrlName);
      $shortCtrlName = strtolower($shortCtrlName);
      // find / make controller node
      $controllerNode = $aco->node('controllers/'.$shortCtrlName);
      if (!$controllerNode) {
        $aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $shortCtrlName));
        $controllerNode = $aco->save();
        $controllerNode['Aco']['id'] = $aco->id;
        $log[] = 'Created Aco node for '.$shortCtrlName;
      } else {
        $controllerNode = $controllerNode[0];
      }

      //clean the methods. to remove those in Controller and private actions.
      foreach ($methods as $k => $method) {
        if (strpos($method, '_', 0) === 0) {
          unset($methods[$k]);
          continue;
        }
        if (in_array($method, $baseMethods)) {
          unset($methods[$k]);
          continue;
        }
        $methodNode = $aco->node('controllers/'.$shortCtrlName.'/'.$method);
        if (!$methodNode) {
          $aco->create(array('parent_id' => $controllerNode['Aco']['id'], 'model' => null, 'alias' => $method));
          $methodNode = $aco->save();
          $log[] = 'Created Aco node for '. $method . ' of '.$ctrlName;
        }
      }
    }
    debug($log);
  }



  public function initDb(){
    $group =& $this->User->Group;
    //Allow admins to everything
    $group->id = Group::USER_GROUP_SITE_ADMIN;
    $this->Acl->allow($group, 'controllers');
    $this->Acl->allow($group, 'controllers/accounts/upload');

    //allow managers to posts and widgets
    $group->id = Group::USER_GROUP_ACCOUNT_ADMIN;
    $this->Acl->deny($group, 'controllers');
    $this->Acl->allow($group, 'controllers/accounts/add');
    $this->Acl->allow($group, 'controllers/accounts/edit');
    $this->Acl->allow($group, 'controllers/accounts/upload');

    //allow users to only add and edit on posts and widgets
    $group->id = Group::USER_GROUP_MEMBER;
    $this->Acl->deny($group, 'controllers');
  }


}
