<style type="text/css">
  div.acc-pic{
    width: 200px;
    height:150px;
    position: relative;
    overflow: hidden;
    float: left;
  }
  div.acc-txt{

    float: left;
    min-width: 500px;
  }

  .acc-info-item ul{
    list-style: none;
  }
  .acc-info-item ul li{
    margin-top: 10px;
  }

  .acc-info-item ul li:first-of-type{
    margin-top: 0;
  }
  .acc-info-item em{
    color: #999;
    text-align: right;
    float: left;
    margin-right: 10px;
  }
  .acc-recommend{
    border-bottom: 1px dashed #e0e0e0;
    padding: 0 0 15px;
    margin-bottom: 25px;
    overflow: hidden;
    zoom: 1;
  }
  .tabs{
    margin-bottom: 10px;
    height: 22px;
    border-bottom: 1px solid #e0e0e0;
    zoom: 1;
  }
  .tabs ul {
    zoom: 1;
    position: relative;
    list-style: none;
  }
  .tabs li .active {
    border-bottom: 2px solid #c00;
    height: 21px;
    float: left;
  }
  .tabs li {
    float: left;
    font-size: 14px;
    margin: 0 40px 0 -25px;
  }
  .tabs li .active a {
    color: #c00;
  }
  .tabs li a:hover {
    text-decoration: none;
  }
  a.desc-tag{
    margin-right: 5px;
    text-decoration: underline;
  }
</style>

<?php $acc = $account['Account']; ?>
<div class="setup-box account-details">
  <div class="hd">
    <div class="acc-title">
      <div class="acc-name">
        <h4><?php echo $acc['name']?></h4>
      </div>
    </div>
  </div>

  <div class="con clearfix">
    <div class="acc-info">
      <div class="acc-con">
        <div class="acc-pic">
          <a href="http://localhost/uploads//1000/medium/519f96fded3d0.jpg" title="DSCF1013.JPG">
            <img src="http://localhost/uploads//1000/200x150/519f96fded3d0.jpg">
          </a>
        </div>
        <div class="acc-txt">
          <div class="acc-info-item">
            <ul>
              <li><em>Location:</em>
                <span><?php echo $acc['street'] ?></span>
              </li>
              <li>
                <em>Telephone:</em>
                <span itemprop="tel" class="call">
                  <?php echo $acc['telephone'] ?>
                </span>
              </li>
              <li><em>Description:</em>
                <span>
                  <?php
                    if($acc['description']){
                      echo $acc['description'];
                    }else{
                      echo "No Description provided";
                    }
                  ?>
                </span>
              </li>
              <li>
                <em>Open Hours:</em>
                <span>
                  <?php echo $this->Time->format('h:i A',$acc['biz_hour_from']);?> ~ <?php echo $this->Time->format('h:i A',$acc['biz_hour_to']) ?>
                </span>
              </li>
                <?php if(!empty($account['Category'])): ?>
                  <li><em>Category:</em>
                    <?php foreach($account['Category'] as $category): ?>
                    <a href="#" class="desc-tag">
                      <?php echo $category['name'] ?>
                    </a>
                  <?php endforeach; ?>
                  </li>
              <?php endif; ?>
                <?php if(!empty($account['Feature'])): ?>
                <li><em>Features:</em>
                <?php foreach($account['Feature'] as $feature): ?>
                  <a href="#" class="desc-tag">
                    <?php echo $feature['name'] ?>
                  </a>
                  <?php endforeach; ?>
                </li>
                <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="acc-recommend">
    <div class="tabs">
      <ul class="clearfix">
        <li><span class="active"><a href="javascript:;" class="ga-env">Menus</a></span></li>
        <li>
          <span><a href="javascript:;" class="ga-recommend">Recommend</a></span>
        </li>
        <li><span class=""><a href="javascript:;" class="ga-menu">Environment</a></span></li>
      </ul>
    </div>
  </div>
</div>