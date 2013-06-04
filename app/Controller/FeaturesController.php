<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/26/13
 * Time: 4:24 PM
 * To change this template use File | Settings | File Templates.
 */

/**
 * Class FeaturesController
 */
class FeaturesController extends AppController{

  /**
   * List all features
   */
  public function index(){

    $this->Feature->recursive = -1;
//    $features = $this->Feature->find('all');
    $features = $this->Feature->getFeaturesWithAccountCount();
    debug($features);
    $this->set("features", $features);

  }

  /**
   *
   */
  public function add(){

    if($this->request->is('post') && !empty($this->request->data)){
      $this->Feature->create();
      $this->request->data['Feature']['enabled'] = true;
      $this->request->data['Feature']['is_deleted'] = false;
      if($this->Feature->save($this->request->data)){
        $this->Session->setFlash("The feature had been saved",'flash_alert');
      }
    }

  }

  public function edit($id){
    if(empty($id)){
      $this->Session->setFlash("Sorry, We couldn't find it",'flash_alert');
      return;
    }else if($this->request->is('get')){
      $feature = $this->Feature->findById($id);
      if(!empty($feature)){
        $this->request->data = $feature;
      }else{
        $this->Session->setFlash("Sorry, We couldn't find it",'flash_alert');
      }

    }else if($this->request->is('post')){
       $this->request->data['Feature']['id'] = $id;
       if($this->Feature->save($this->request->data)){
         $this->Session->setFlash("Update Success",'flash_alert');
         $this->redirect('/features');
       }
    }
  }

  public function update(){

  }

  public function delete($id){

    $this->autoRender = false;

    if(!isset($id)){
      $id = $_POST["id"];
    }

    $result = $this->Feature->delete($id);

    echo json_encode(array("result"=>$result));

  }

  public function beforeFilter(){
    parent::beforeFilter();
    $this->Auth->allow(array(
      'add',
      'index'
    ));
  }

}