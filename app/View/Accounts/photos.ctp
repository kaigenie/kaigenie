<?php
  $acc = $account["Account"];
?>
<div class="setup-box account-photos">
  <div class="hd">
    <h4><?php echo __("Photos of ") . $acc["name"] ?></h4>
  </div>
  <div class="con">
    <style>
      .main{
        background-color: #f5f5f5 !important;
      }
      ol.account-photos-list{
        width:100%;
        list-style:none;
        float:left;
        margin-left:-5px !important;
      }

      ol.account-photos-list li{
        /*width:30%;*/
        width:200px;
        height: 150px;
        float:left;
        margin:10px 0 0 10px;
        border:8px solid #fff;
        background-color: #fff;
        position:relative;
      }

      ol.account-photos-list li img{
        max-width:100%;
        float:left;
        -webkit-box-sizing:border-box;
        -moz-box-sizing:border-box;
        box-sizing:border-box;
      }
    </style>

    <?php if(empty($photos)):
            echo "No Photo had been uploaded.";
      ?>
      <?php else: ?>
      <ol class="account-photos-list">
        <?php foreach($photos as $photo):?>
        <li id="photo-<?php echo $photo['Image']['ID'] ?>" class="photo">
          <a href="<?php echo $photo['Image']['medium_url'] ?>" title="<?php echo $photo['Image']['name'] ?>">
            <img src="<?php echo $photo['Image']['200x150_url'] ?>">
          </a>
        </li>

        <?php endforeach?>
      </ol>

    <?php endif;?>



  </div>
</div>
