<div class="setup-box user-setup change-password">
  <div class="hd">
    <h5>

      <a href="<?php echo Router::url(array("controller"=>"users", "action"=>"setup")) ?>">User Setup</a>

      <span><em>&gt;</em><?php echo __('Change Password') ?></span>
    </h5>

  </div>
  <div class="con">
    <p class="con-hints">For security reason, please do not reuse your previous password.</p>

    <form class="form-horizontal" method="post" accept-charset="utf-8" action="<?php echo Router::url(
      array("controller"=>"users", "action"=>"setup",'password')
    ) ?>">
      <div class="control-group">
        <label class="control-label" for="oldPassword">Current Password</label>
        <div class="controls">
          <input type="password" name="oldPassword" id="oldPassword"
                 required value="<?php if(!empty($this->data['oldPassword'])) : echo $this->data['oldPassword']; endif;?>">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="newPassword">New Password</label>
        <div class="controls">
          <input type="password" name="newPassword" id="newPassword"
                 required value="<?php if(!empty($this->data['newPassword'])) : echo $this->data['newPassword']; endif;?>">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="repeatPassword">Confirm Password</label>
        <div class="controls">
          <input type="password" name="repeatPassword" id="repeatPassword"
                 required value="<?php if(!empty($this->data['repeatPassword'])) : echo $this->data['repeatPassword']; endif;?>">
          <span class="hide help-inline">Password is inconsistant</span>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <button type="submit" class="btn">Save</button>
        </div>
      </div>
    </form>

  </div>
</div>