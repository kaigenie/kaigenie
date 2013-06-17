<?php
App::uses('AppController', 'Controller');
/**
 * Reviews Controller
 *
 */
class ReviewsController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

  public $uses = array('Account', 'Review');


  public function approval(){
    $this->layout = 'layout-accmenu';
    $this->autoRender = false;

    // first get accounts list that has reviews.
    $accountsHaveReview = $this->Review->findReviewCount();

    $this->set("accounts", $accountsHaveReview);
    $this->set("pagevar", array("accid"=>'', "rs"=>''));

    $this->render('approval');
  }

  public function lists($accid, $status = null){
    if(!$this->Account->exists($accid)){
      throw new NotFoundException(sprintf("Account %d not found" ,$accid));
    }

    $this->layout = 'layout-accmenu';
    $this->autoRender = false;

    // first get accounts list that has reviews.
    $accountsHaveReview = $this->Review->findReviewCount();
    $this->set("accounts", $accountsHaveReview);

    $reviews = $this->Review->findReviewsByAccount($accid, $status);
    $this->set("reviews", $reviews);

    $this->set("pagevar", array("accid"=>$accid, "rs"=>$status));

    $this->render('approval');


  }

  public function reject($reviewId){
    $this->autoRender = false;

    $result = $this->Review->updateStatus($reviewId, Constant::REVIEW_REJECTED);

    echo json_encode($result);

    $this->redirect($this->referer());
  }

  public function approve($reviewId){
    $this->autoRender = false;
    $result = $this->Review->updateStatus($reviewId, Constant::REVIEW_APPROVED);
    $this->redirect($this->referer());
  }

}
