<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/19/13
 * Time: 9:26 PM
 * To change this template use File | Settings | File Templates.
 */

App::uses('AccountStatus', 'Model');

App::import('File','Utility');
App::uses('Thumbnail','Utility');

class AccountsController extends AppController
{
  const ACC_SESS_STEP1 = 'step1-account';

  public $uses = array('Account', 'Feature', 'AccountFeature', 'Category','AccountUser');

  public function beforeFilter(){
    parent::beforeFilter();
    $this->Auth->allow('add');
  }

  public function add()
  {
//    $this->Acl->allow();
    if ($this->request->is('post') && !empty($this->request->data)) {
      $this->_prepareGenData();
      $this->_prepareFeatures();
      $this->_prepareCategories();
      $saved_account = $this->Account->saveAll($this->request->data);
      if ($saved_account) {
        $this->redirect(array("action" => 'index'));
      } else {
        $this->Session->setFlash('Save Failed');
      }
    }
    $this->_initSelectList();
  }

  /**
   * Initialize Account features and Account category drop-down list
   */
  private function _initSelectList()
  {
    $features = $this->Feature->getAllFeaturesKeyValue();
    $this->set('features', $features);
    $categories = $this->Category->getAllCategoryPair();
    $this->set('categories', $categories);
  }

  /**
   * @return mixed
   */
  private function _prepareGenData()
  {
    $this->Account->create();
    $this->request->data['Account']['status'] = AccountStatus::REGISTERED;

    $ACC_TYPES = Configure::read("Account.Type");
    $ACC_LEVEL = Configure::read("Account.Level");

    $this->request->data['Account']['level_name'] = $ACC_LEVEL[$this->request->data['Account']['level']];
    $this->request->data['Account']['type_name'] = $ACC_TYPES[$this->request->data['Account']['type']];

    $this->request->data['Account']['name'] = htmlspecialchars($this->request->data['Account']['name']);

    $address = htmlspecialchars($this->request->data['Account']['street']);
    $this->request->data['Account']['street'] = $address;
//    $latLng = $this->_getLatLngFromGoogleMap($address);
//    $this->request->data['Account']['geolat'] = $latLng['lat'];
//    $this->request->data['Account']['geolng'] = $latLng['lng'];
  }

  /**
   * Get data from user select checkboxes, one account might provide multiple features,
   * for example, Restaurant can have Parking, Wifi or Wines etc.
   */
  private function _prepareFeatures()
  {
    if(!empty($this->request->data['AccountFeature']['feature_id'])){
      $accountFeatures = array();
      foreach ($this->request->data['AccountFeature']['feature_id'] as $feature_id) {
        $accountFeature = array(
          'feature_id' => $feature_id
        );
        array_push($accountFeatures, $accountFeature);
      }
      $this->request->data['AccountFeature'] = $accountFeatures;
    }

  }

  /**
   * Account could have multiple categories, we use category to classify different accounts,
   * for example, a restaurant has Chinese food style
   */
  public function _prepareCategories()
  {
    if(!empty($this->request->data['AccountCategory']['category_id'])){
      $accountCategories = array();
      foreach ($this->request->data['AccountCategory']['category_id'] as $categoryId) {
        $accountCategory = array(
          'category_id' => $categoryId
        );
        array_push($accountCategories, $accountCategory);
      }
      $this->request->data['AccountCategory'] = $accountCategories;
    }
  }

  /**
   * @return mixed
   */
  public function _getLatLngFromGoogleMap($address)
  {
    $request = file_get_content('http://maps.googleapis.com/maps/api/geocode/json?address='. urlencode($address) .'&sensor=false');
    if($request){
      $json = json_decode($request, true);

      $latLng = $json['results'][0]['geometry']['location'];
      return $latLng;
    }else{
      return array(
        'lat' => 0.0,
        'lng' => 0.0
      );
    }

  }

  public function index()
  {
    // Do not fetch unnecessary data
    $this->Paginator->settings = array(
      'recursive' => -1,
      'fields' => array('Account.ID', 'Account.name', 'Account.level', 'Account.level_name',
                        'Account.type', 'Account.type_name'),
      'limit' => 5,
      'order' => array(
        'Account.name' => 'asc'
      )
    );
    $accounts = $this->Paginator->paginate();

    $this->set('accounts', $accounts);
  }

  public function edit($id){
    if(empty($id) || !$this->Account->exists($id)){
      throw new NotFoundException("System can't find a account");
    }
    if($this->request->is('put') && !empty($this->request->data)){
      $this->request->data['Account']['ID'] = $id;
      $this->_prepareGenData();
      $this->_prepareFeatures();
      $this->_prepareCategories();

      if($this->Account->saveAll($this->request->data)){
        $this->Session->setFlash("Update Successfully", 'flash_alert');
        $this->redirect(array("action" => 'index'));
      }
    }

    $account = $this->Account->findById($id, $self = false, $query = array(
      'contain' => array('AccountFeature', 'AccountCategory')
    ));
    $account['AccountUser'] = $this->AccountUser->getAccountAdmin($id);
    $this->_initSelectList();

    $this->data = $account;

  }


  /**
   * @param $accid
   */
  public function menu($accid){

    $account = $this->Account->findAccountWithMenus($accid);
    $this->set('account', $account);

    $this->render('/Menus/index', 'layout-accmenu');
  }


  /**
   *
   * This will render and display all of the account uploaded related images. it severs /accounts/1234/photos
   *
   * @param $accid Account ID
   */
  public function photos($accid){

    $account = $this->Account->findPhotos($accid);

    $this->set("account", $account);
  }

  /**
   * Get Account Details information
   *
   * @param $accid Account ID
   */
  public function detail($accid){
    $account = $this->Account->getDetail($accid);
    $this->set("account", $account);
  }

  public function test($accid){
    $tmp = $this->Account->getDetail($accid);

    $this->Feature->recursive = 1;
    $tmp2 = $this->Feature->findById(1, array(
    ));

    debug($tmp2);

    $this->autoRender = false;
  }
}