<?php
App::uses('AppModel', 'Model');
/**
 * Review Model
 *
 * @property Account $Account
 * @property User $User
 * @property ReviewImage $ReviewImage
 */
class Review extends AppModel {

  public $REVIEW_STATUS = array(
    "pending"   => 0,
    'denied'    => -1,
    "approved"  => 1
  );


  public $actsAs = array('Containable');


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'account_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'comment' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Account' => array(
			'className' => 'Account',
			'foreignKey' => 'account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ReviewImage' => array(
			'className' => 'ReviewImage',
			'foreignKey' => 'review_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

  public function findReviewCount(){

    $this->Account->recursive = -1;

    $result = $this->Account->find('all', $query=array(
      'fields' => array("Account.id", 'Account.name', 'count(review.id) as Count'),
      'joins' => array(
        array(
          'table'=>'reviews',
          'alias' => 'review',
          'type' => 'left',
          'conditions' => array(
            'review.account_id = Account.id',
          )
        )
      ),
      'conditions' => array(
        'Account.enabled'=>true
      ),
      'group'  => array("Account.id", 'Account.name'),
      'order'  => array("Account.name ASC")
    ));

    return $result;
  }

  public function findReviewsByAccount($accid, $status){

    if(isset($status) && array_key_exists($status, Constant::$REVIEW_STATUS) ){
      $status = Constant::$REVIEW_STATUS[$status];
    }else{
      $status = Constant::REVIEW_PENDING;
    }

    $result = $this->find('all', array(
      'fields' => array('Review.id', 'Review.*','User.id', 'User.username'),
      'contain'=> array('User', 'ReviewImage'),
      'conditions'    => array(
        'account_id' => $accid,
        'status'     => $status
      ),
      'order'=> array('Review.created DESC')

    ));
    return $result;
  }

  public function updateStatus($id, $status){
    $this->id = $id;
    $success = $this->saveField("status", $status);
    return $success;

  }

}
