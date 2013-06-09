<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/18/13
 * Time: 10:46 PM
 * To change this template use File | Settings | File Templates.
 */

class Account extends AppModel{

  //http://book.cakephp.org/2.0/en/models/associations-linking-models-together.html#hasandbelongstomany-habtm
  public $hasAndBelongsToMany = array(
      'Feature' => array(
        'className'             => 'Feature',
        'joinTable'             => 'accounts_features',
        'foreignKey'            => 'account_id',
        'associationForeignKey' => 'feature_id',
        'with'                  => 'AccountFeature', // If true (default value) cake will first delete existing relationship records in the foreign keys table before inserting new ones. Existing associations need to be passed again when updating
        'unique'                 => false,
        'conditions'             => '',
        'fields'                 => '',
        'order'                  => '',
        'limit'                  => '',
        'offset'                 => '',
        'finderQuery'            => '',
        'deleteQuery'            => '',
        'insertQuery'            => ''
      ),
        'Category' => array(
          'className'             => 'Category',
          'joinTable'             => 'accounts_category',
          'foreignKey'            => 'account_id',
          'associationForeignKey' => 'category_id',
          'with'                  => 'AccountCategory',
          'unique'                 => false,
          'conditions'             => '',
          'fields'                 => '',
          'order'                  => '',
          'limit'                  => '',
          'offset'                 => '',
          'finderQuery'            => '',
          'deleteQuery'            => '',
          'insertQuery'            => ''
        ),
      'Image' => array(
        'className'             => 'Image',
        'joinTable'             => 'accounts_images',
        'foreignKey'            => 'account_id',
        'associationForeignKey' => 'image_id',
        'with'                  => 'AccountImage',
        'unique'                 => false,
        'conditions'             => '',
        'fields'                 => '',
        'order'                  => '',
        'limit'                  => '',
        'offset'                 => '',
        'finderQuery'            => '',
        'deleteQuery'            => '',
        'insertQuery'            => ''
      )
    );

  public static $ACCOUNT_TYPE  = array('1' => 'Restaurant', '2' => 'Coffee Bar' );

  public static $ACCOUNT_LEVEL = array('1' => 'Basic', '2' => 'Premium');

  public $actsAs = array('Containable');

  public $hasMany = array(
    'AccountFeature',
    'AccountCategory',
    'AccountUser',
    'AccountImage',
    'Menu',
    'Review'
  );



  public $validate = array(
    'name' => array(
        'rule' => 'notEmpty'
    ),
    'street' => array(
        'rule' => 'notEmpty'
    )
  );

  /**
   * Due to CakePHP would NOT remove associated features and categories before update main account table.
   * I need to remove the associate data before save everything again.
   *
   * Caution: There has a risk that the save fail then I lose the previous state.
   *
   * @param array $data
   * @param array $options
   * @return mixed|void
   */
  public function saveAll($data = array(), $options = array()){
    $accountId = $data['Account']['id'];
    if(isset($accountId)){
      $this->AccountFeature->deleteAll(array(
        'account_id' => $accountId
      ));

      $this->AccountCategory->deleteAll(array(
        'account_id' => $accountId
      ));
    }
    return parent::saveAll($data, $options);
  }

  public function findById($accountId = null, $self = true, $query = array()){

    if($self){
      $this->recursive = -1;
    }
    $query = array_merge(array(
      'conditions' => array('Account.id = ' => $accountId),
    ),$query);
    return $this->find('first',$query);

  }

  /**
   * @param $accountId
   * @return array
   */
  public function findAccountWithMenus($accountId){

    $this->recursive = -1;

    $account = $this->find('first', array(
      'fields' => array(
        'Account.id', 'Account.name', 'Account.type'
      ),
      'conditions' => array('Account.id = ' => $accountId),
      'contain' => array(
        'Menu' => array(
          'fields' => array(
            'Menu.id', 'Menu.name'
          ),
          'MenuItem' => array(
            'fields'=>array(
              'MenuItem.id','MenuItem.name','MenuItem.description',
              'MenuItem.price','MenuItem.symbol',
            ),
            'ItemPortrait' => array(
              'fields' => array(
                'ItemPortrait.id',
                'ItemPortrait.name',
                'ItemPortrait.size',
                'ItemPortrait.unique_name',
                'ItemPortrait.relative_path',
              )
            )
          )
        )
      )
    ));


    return $account;
  }

  public function findAccountPhotos($accountId){

    $query = array(
      'contain' => 'AccountImage',

      'fields' => array(
        'Account.id', 'Account.name','img.id','img.name','img.size', 'img.relative_path'
      ),
      'conditions' => array(
        'Account.id' => $accountId
      ),
      'joins' => array(
        array(
          'table' => 'accounts_images',
          'alias' => 'ai',
          'type' => 'left',
          'conditions' => array(
            'ai.account_id = Account.id'
          )
        ),
        array(
          'table' => 'images',
          'alias' => 'img',
          'type' => 'left',
          'conditions'=> array(
            'img.id = ai.image_id'
          )
        )
      )
    );

    $account = $this->find("all" ,$query);

    return $account;

  }


  public function findPhotos($accountId){

    $query = array(
      'contain' => 'Image',
      'fields' => array(
        'Account.id', 'Account.name'
      ),

      'conditions' => array(
        'Account.id' => $accountId
      ),
    );

    $account = $this->find("first" ,$query);

    return $account;

  }

  /**
   * This function server as /account/detail/1234 page which display most of the account information. For instance,
   * uploaded photos, Category and Feature info.
   *
   * @param null $accId Account id passed by URL
   * @return array Return Account Detail information
   */
  public function getDetail($accId = null){

    // strictly set recursive otherwise cakephp will retrive redundant records.
    $this->recursive = -1;
    $account = $this->find('first',array(
      'contain'     => array(
        'Feature', 'Category'
      ),
      'conditions'  => array(
        'Account.id' => $accId
      )
    ));

//    $photos = $account['Image'];
//    $photosWithUrl = $this->_buildImageUrl($photos);
//    unset($account['Image']);
//    $account['Image'] = $photosWithUrl;

    return $account;
  }

}