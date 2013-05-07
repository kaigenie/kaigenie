<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/29/13
 * Time: 9:55 PM
 * To change this template use File | Settings | File Templates.
 */

class CategoriesController extends AppController{

  public function index(){
    $categories = $this->Category->find('all', $params = array(
      'conditions' => array('Category.enabled' => true),
      'fields'     => array('Category.name', 'Category.enabled')
    ));

    $this->set('categories', $categories);
  }

  public function add(){

    if($this->request->is('post') && !empty($this->data)){
      $this->request->data['Category']['enabled'] = true;
      if($this->Category->save($this->request->data)){
        $this->Session->setFlash('Your data had been saved!', 'flash_alert');
//        $this->redirect(array(
//          'controller' => 'categories',
//          'action'     => 'index'
//        ));
      }
    }

  }

  public function edit($id){

  }

  public function view($id){

  }

  public function delete($ids = array()){

  }

  public function beforeFilter(){
    parent::beforeFilter();
    $this->Auth->allow(array(
      'index',
      'add',
      'edit',
      'view'
    ));
  }
}