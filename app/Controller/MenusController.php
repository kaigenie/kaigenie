<?php
/**
 * MenusController means to maintenance account menu and menu items. It basically allow account administrator to add/edit
 * Account Menu and append items with it. It also provide features like attach external photos with menu items.
 * User: zjczhjuncai@gmail.com
 * Date: 5/10/13
 * Time: 10:40 PM
 */
App::uses('Thumbnail','Utility');
class MenusController extends AppController{

  public $uses = array('Account', 'User', 'MenuItem','Menu', 'Image');

  public function beforeFilter(){

    /*
     * Since Menu can not exist alone, so we need to check if the passed account id exits
     */
    if(!empty($this->passedArgs)){
      $accid = $this->passedArgs[0];
    }else{
      $accid = $this->request->data['Menu']['account_id'] || $this->request->data['MenuItem']['account_id'];
    }
    if(!isset($accid) && !$this->Account->exists($accid)){
      throw new NotFoundException("You have to specify an existing account");
    }

    $this->layout = 'layout-accmenu';
  }

  /**
   * Index page of Menu, URI like /accounts/1000/menu will route to this method
   *
   * @param $accid Account ID
   */
  public function index($accid = null){

    $account = $this->Account->findById($accid);
    $this->set("account", $account);
  }

  public function add(){

    if($this->request->is('post')){
      $this->Menu->create();
      $this->Menu->save($this->request->data);
    }
    $this->redirect(array(
      "controller"=>"accounts",
      "accid"=> $this->request->data['Menu']['account_id'],
      'action' => 'menu'
    ));
  }

  public function add_item(){

    if($this->request->is('post')){
      $this->MenuItem->create();
      $this->MenuItem->save($this->request->data);
      if(!empty($_FILES)){
        $accountId = $this->request->data["MenuItem"]['account_id'];
        $uploadConfig= Configure::read('App.Uploads');

        $uploadDir = $uploadConfig['location'];


        $fileTypes = $uploadConfig['fileType'];

        $uploadDir = rtrim($uploadDir, DS) . DS;

        $relativePath = DS . $accountId . DS . 'images' .DS;

        $uploadDir = rtrim($uploadDir, DS) . $relativePath;

        if(!is_dir($uploadDir)){
          if(!mkdir($uploadDir, 0777,true)){
            throw new NotFoundException(__("The folder is not accessible"));
          }
        }

        $tempFile   = $_FILES['item-image']['tmp_name'];
        $realFileName   = $_FILES['item-image']['name'];
        $targetFile = $uploadDir . $realFileName;
        // Validate the filetype
        $fileParts = pathinfo($realFileName);


        $uniqueFileName = uniqid() . '.' . strtolower($fileParts['extension']);
        $uniqueFile = rtrim($uploadDir, DS) . DS . $uniqueFileName;
        $image = array(
          'name' => $realFileName,
          'directory' => dirname($targetFile),
          'extension' => strtolower($fileParts['extension']),
          'size'      => filesize($tempFile),
          'unique_name' => $uniqueFileName,
          'relative_path' => $relativePath
        );
        $user = $this->Auth->user();
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
        }
        $this->redirect(array(
          'controller' => 'accounts',
          'action'=> 'menu',
          'accid' => $accountId
        ));
      }
    }


  }

}