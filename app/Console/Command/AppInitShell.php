<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/30/13
 * Time: 10:11 PM
 * To change this template use File | Settings | File Templates.
 */

class AppInitShell extends AppShell{

  public $uses = array('Group', 'User', 'Acl');

  public function main(){

    self::_initGroup();
    self::_initSiteAdmin();
//    self::_buildAcl();

  }

  /**
   * This method will be invoked only once on system deployment on production, we need to setup an super user to maintenance
   * everything including master data setup etc.
   *
   * Here I hard-code one super admin here
   */
  private function _initSiteAdmin(){
    if(!$this->User->findByUsername('admin')){

      print_r("Begin to create super administrator...\n");
      $this->User->create(array(
        'username' => 'admin',
        'password' => 'P@ssword1',
        'first_name' => 'Super',
        'last_name'  => 'Admin',
        'email'      => 'zjczhjuncai@gmail.com',
        'group_id'  => Group::USER_GROUP_SITE_ADMIN,
        'is_active' => true,
        'is_delete' => false
      ));

      $this->User->save();
      print_r("End creating super administrator with id " .$this->User->getID() );
    }
  }

  /**
   * System doesn't provide an interface to maintenance groups so we could run the script on the terminal or shell to
   * initialize group master data.
   *
   * Basically currently we only support three types of users
   * 1, Site Administrator
   * 2, Account Administrator
   * 3, Member
   */
  private function _initGroup(){
    echo "Initialize Group Record if it haven't been setup...\n";
    $groupNames = Group::$USER_GROUP_NAMES;
    foreach($groupNames as $key => $groupName){
      if(!$this->Group->exists($key)){
        $this->Group->create(array("id" => $key, 'name' => $groupName,  'description' => $groupName));
        $this->Group->save();
      }else{
        $this->Group->id = $key;
        $this->Group->create(array('name' => $groupName,  'description' => $groupName));
      }
    }
  }

  /**
   * Rebuild the Acl based on the current controllers in the application
   *
   * @return void
   */
  private function _buildAcl() {
    $log = array();

    $aco =& $this->Acl->Aco;
    $root = $aco->node('controllers');
    if (!$root) {
      $aco->create(array('parent_id' => null, 'model' => null, 'alias' => 'controllers'));
      $root = $aco->save();
      $root['Aco']["id"] = $aco->id;
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
}