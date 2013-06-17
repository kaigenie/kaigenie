<div class="setup-box account-list">
  <div class="hd">
    <h4><?php echo __("Reviews Approval")?></h4>
  </div>
  <style type="text/css">

    .review-acount-list{
      float: left;
      margin-right: 15px;
    }
    .review-sidenav {
      width: 268px;
      /*margin: 30px 0 0;*/
      padding: 0;
      background-color: #fff;
      -webkit-border-radius: 6px;
      -moz-border-radius: 6px;
      border-radius: 6px;
      -webkit-box-shadow: 0 1px 4px rgba(0,0,0,.065);
      -moz-box-shadow: 0 1px 4px rgba(0,0,0,.065);
      box-shadow: 0 1px 4px rgba(0,0,0,.065);
    }
    .review-sidenav > li > a {
      display: block;
      width: 190px \9;
      margin: 0 0 -1px;
      padding: 8px 14px;
      border: 1px solid #e5e5e5;
    }
    .review-sidenav > li:first-child > a {
      -webkit-border-radius: 6px 6px 0 0;
      -moz-border-radius: 6px 6px 0 0;
      border-radius: 6px 6px 0 0;
    }
    .review-sidenav > li:last-child > a {
      -webkit-border-radius: 0 0 6px 6px;
      -moz-border-radius: 0 0 6px 6px;
      border-radius: 0 0 6px 6px;
    }
    .review-sidenav > .active > a {
      position: relative;
      z-index: 2;
      padding: 9px 15px;
      border: 0;
      text-shadow: 0 1px 0 rgba(0,0,0,.15);
      -webkit-box-shadow: inset 1px 0 0 rgba(0,0,0,.1), inset -1px 0 0 rgba(0,0,0,.1);
      -moz-box-shadow: inset 1px 0 0 rgba(0,0,0,.1), inset -1px 0 0 rgba(0,0,0,.1);
      box-shadow: inset 1px 0 0 rgba(0,0,0,.1), inset -1px 0 0 rgba(0,0,0,.1);
    }
      /* Chevrons */
    .review-sidenav .icon-chevron-right {
      float: right;
      margin-top: 2px;
      margin-right: -6px;
      opacity: .25;
    }
    .review-sidenav > li > a:hover {
      background-color: #f5f5f5;
    }
    .review-sidenav a:hover .icon-chevron-right {
      opacity: .5;
    }
    .review-sidenav .active .icon-chevron-right,
    .review-sidenav .active a:hover .icon-chevron-right {
      opacity: 1;
    }
    .review-sidenav.affix {
      top: 40px;
    }
    .review-sidenav.affix-bottom {
      position: absolute;
      top: auto;
      bottom: 270px;
    }
    .review-main > ul{
      list-style: none;
      margin: 0 0 10px 10px;
      width:100%;
      min-height: 200px;
    }
    .review-main > ul > li{
      border-bottom: 1px #ccc dotted;
    }
    .review-main{
      border: 1px solid #ccc;
      float: left;
      width: 70%;
      -webkit-border-radius: 6px;
      -moz-border-radius: 6px;
      border-radius: 6px;
      -webkit-box-shadow: 0 1px 4px rgba(0,0,0,.065);
      -moz-box-shadow: 0 1px 4px rgba(0,0,0,.065);
      box-shadow: 0 1px 4px rgba(0,0,0,.065);

    }
    .review-filter{
      margin-left: 283px;
    }
    .review-filter span{
      margin-left:5px;
    }
  </style>

  <div class="con">
    <p class="con-hints">You could review and approve/reject reviews submited by members.</p>
    <div class="review-filter">
      <div class="btn-toolbar">
        <div class="btn-group">
          <a class="btn rejected <?php if($pagevar['rs']=='rejected') echo 'active'; ?>" href="<?php echo Router::url(array('action'=>'lists', $pagevar['accid'], 'rejected')); ?>"><i class="icon-ban-circle"><span class="filter-txt">Rejected</span> </i></a>
          <a class="btn pending <?php if($pagevar['rs']=='pending' || empty($pagevar['rs']))  echo 'active'; ?>" href="<?php echo Router::url(array('action'=>'lists', $pagevar['accid'], 'pending')); ?>"><i class="icon-spinner"><span class="filter-txt">Pending</span> </i></a>
          <a class="btn approved <?php if($pagevar['rs']=='approved') echo 'active'; ?>" href="<?php echo Router::url(array('action'=>'lists', $pagevar['accid'], 'approved')); ?>"><i class="icon-ok-circle"><span class="filter-txt">Approved</span></i></a>
        </div>
      </div>
    </div>
    <div class="review-acount-list">
      <ul class="nav nav-list review-sidenav affix-top">
        <?php if(!empty($accounts)): ?>
          <?php foreach ($accounts as $account):?>
            <li class="<?php if($pagevar['accid'] == $account['Account']['id']) echo 'active'; ?>">
              <a href="<?php echo Router::url(array('controller'=>'reviews','action'=>'lists',$account['Account']['id'])) ?>">
                <span class="badge badge-warning"><?php echo $account['0']['Count']?></span>
                <i class="icon-chevron-right"></i> <?php echo $account['Account']['name'] ?>
              </a>
            </li>
          <?php endforeach; ?>
        
        <?php endif; ?>
      </ul>
    </div>
    <div class="review-main">
      <ul class="comments-list">
        <?php if(!empty($reviews)): ?>
          <?php foreach($reviews as $review): ?>
            <li>
              <div>
                <?php echo $review['User']['username']; ?>
              </div>
              <div>
                <?php echo $review['Review']['comment']; ?>
              </div>
              <div>
                <?php echo $review['Review']['created']; ?>
              </div>
              <div class="review-actions">
                <?php

                $reviewStatus = $review['Review']['status'];

                switch($reviewStatus){
                  case Constant::REVIEW_REJECTED:
                    echo $this->Form->postLink(__('Approve'), array('action' => 'approve', $review['Review']['id']));
                    break;
                  case Constant::REVIEW_APPROVED:
                    echo $this->Form->postLink(__('Deny'), array('action' => 'reject', $review['Review']['id']));
                    break;
                  case Constant::REVIEW_PENDING:
                    echo $this->Form->postLink(__('Approve'), array('action' => 'approve', $review['Review']['id']));
                    echo $this->Form->postLink(__('Deny'), array('action' => 'reject', $review['Review']['id']));
                    break;
                }
                ?>

              </div>
            </li>
          <?php endforeach; ?>
        <?php endif;?>
      </ul>
    </div>
  </div>
</div>