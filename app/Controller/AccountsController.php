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

  public $uses = array('Account', 'Feature', 'AccountFeature', 'Category', 'Image','AccountUser');

  public function beforeFilter(){
    parent::beforeFilter();
    $this->Auth->allow('add');
  }

  public function add()
  {
//    $this->Acl->allow();
    if ($this->request->is('post') && !empty($this->request->data)) {
      $latLng = $this->_prepareGenData();
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
    $address = htmlspecialchars($this->request->data['Account']['street']);
    $this->request->data['Account']['status'] = AccountStatus::REGISTERED;
    $this->request->data['Account']['name'] = htmlspecialchars($this->request->data['Account']['name']);
    $this->request->data['Account']['street'] = $address;
    $latLng = $this->_getLatLngFromGoogleMap($address);
    $this->request->data['Account']['geolat'] = $latLng['lat'];
    $this->request->data['Account']['geolng'] = $latLng['lng'];
    return $latLng;
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
   *
   * @param $latLng Latitude
   * @return string Longitude
   */
  public function _construct_step2_url($latLng)
  {
    return '/accounts/add_step2?lat=' . $latLng['lat'] . '&lng=' . $latLng['lng'];
  }

  /**
   * @return mixed
   */
  public function _getLatLngFromGoogleMap($address)
  {
    $request = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='. urlencode($address) .'&sensor=false');
    $json = json_decode($request, true);

    $latLng = $json['results'][0]['geometry']['location'];
    return $latLng;
  }

  public function add_step2()
  {
    if(!$this->Session->check($this::ACC_SESS_STEP1)){
      $this->Session->setFlash('You have to input generic information.');
      $this->redirect(array('action' => 'add'));

    }

    $this->Session->setFlash('Test Flash Message.', 'flash_alert');
    $this->set('step', 'step2');
  }

  public function index()
  {
    // Do not fetch unnecessary data
    $this->Paginator->settings = array(
      'recursive' => -1,
      'fields' => array('Account.ID', 'Account.name'),
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

    $account = $this->Account->findById($id);
    $account['AccountUser'] = $this->AccountUser->getAccountAdmin($id);
    $this->_initSelectList();

    $this->data = $account;

  }

  public function upload($accountId){

    $uploadConfig= Configure::read('App.Uploads');

    $uploadDir = $uploadConfig['location'];

    $fileTypes = $uploadConfig['fileType'];

    $uploadDir = rtrim($uploadDir, DS) . DS;

    $relativePath = DS . $accountId . DS . 'images' .DS;

    $uploadDir = rtrim($uploadDir, DS) . $relativePath;



    if($this->request->is('post')){

      if(!is_dir($uploadDir)){
        if(!mkdir($uploadDir, $recursive = true)){
          throw new NotFoundException(__("The folder is not accessible"));
        }
      }

      $account = $this->Account->findById($accountId);

      $user = $this->Auth->user();

      $verifyToken = md5(Configure::read('Security.salt') . $_POST['timestamp']);

      if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
        $tempFile   = $_FILES['Filedata']['tmp_name'];
        $realFileName   = $_FILES['Filedata']['name'];
        $targetFile = $uploadDir . $realFileName;
        // Validate the filetype
        $fileParts = pathinfo($realFileName);

        $mimeType = $_POST['mimeType'];

        $uniqueFileName = uniqid() . '.' . strtolower($fileParts['extension']);
        $uniqueFile = rtrim($uploadDir, DS) . DS . $uniqueFileName;
        $image = array(
          'name' => $realFileName,
          'directory' => dirname($targetFile),
          'extension' => strtolower($fileParts['extension']),
          'size'      => filesize($tempFile),
          'unique_name' => $uniqueFileName,
          'relative_path' => $relativePath,
          'mime_type'   => $mimeType
        );

        $image['user_id'] = $user['ID'];
        $image['account_id'] = $accountId;

        if (in_array(strtolower($fileParts['extension']), $fileTypes)) {
          // Save the file
          move_uploaded_file($tempFile, $uniqueFile);
          // generate thumbnail for display
          Thumbnail::generateThumbnail($uniqueFile);
          // save image into database
          $this->Image->save($image);
          echo 1;
        } else {
          // The file type wasn't allowed
          echo 'Invalid file type.';
        }
      }
    }

  }
}