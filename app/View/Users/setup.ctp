<style type="text/css">
  .user-setup ul{
    list-style: none;
  }
  .user-setup .tit{
    width:140px;
    float: left;
    line-height: 30px;
    text-align: right;
    margin-right: 20px;
  }
  .user-setup .f-part{
    display: inline-block;
    overflow: hidden;
    zoom: 1;
    vertical-align: middle;
    position: relative;
  }
  .user-setup .f-part a{
    margin-left: 10px;
  }
</style>
<div class="setup-box user-setup">
  <div class="hd">
    <h4><?php echo __('User Setup') ?></h4>
  </div>
  <div class="con">
    <div class="form-box">
      <ul>
        <li>
          <div class="tit"><label for="">
              <?php echo __('Username: ') ?>
            </label></div>
          <div class="f-part">
            <p>
              <span>
                <?php echo $this->Access->getUsername(); ?>
              </span>
            </p>
          </div>
        </li>
        <li>
          <div class="tit"><label for="">
              <?php echo __('Email: ') ?>
          </label></div>
          <div class="f-part">
            <p>
              <span>
                <?php echo $this->Access->getEmail(); ?>
              </span>
            </p>
          </div>
        </li>
        <li>
          <div class="tit"><label for=""><?php echo __('Password: ') ?></label></div>
          <div class="f-part">
            <p>
            <span>******</span>
            <a href="<?php echo Router::url(
              array(
                'controller'=>'users',
                'action'=>'setup',
                'password'
              )

            ) ?>">[Change]</a>
            </p>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>