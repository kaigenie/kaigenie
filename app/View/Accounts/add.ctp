<?php
//$this->extend('/Accounts/add_nav');
//?>

<h2>Add an Account</h2>

<?php echo $this->Form->create('Account', array(
                                          'inputDefaults' => array('div'=>false, 'label'=>false),
                                          'url'=>array('controller' => 'accounts', 'action' => 'add'),
                                          'class' => 'form-horizontal'
                                          )
                              );
?>

  <div class="control-group">
      <label class="control-label" for="account-name">Account Name</label>
      <div class="controls">
          <?php echo $this->Form->input('name', array('id'=>'account-name')) ?>
      </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="account-type">Type</label>
    <div class="controls">
      <?php echo $this->Form->input('type', array(
        'id'=>'account-type',
        'options'=> Configure::read('Account.Type')
      )) ?>
    </div>
  </div>

  <div class="control-group">
      <label class="control-label" for="account-suburb">City</label>
      <div class="controls">
          <?php echo $this->Form->input('city', array(
              'id'=>'account-city',
              'options' => array(
                  'Auckland'          => 'Auckland',
                  'Hamilton'          => 'Hamilton',
                  'Tauranga'          => 'Tauranga',
                  'Napier'            => 'Napier',
                  'Palmerston North'  => 'Palmerston North',
                  'Porirua'           => 'Porirua',
                  'Upper Hutt'        => 'Upper Hutt',
                  'Lower Hutt'        => 'Lower Hutt',
                  'Wellington'        => 'Wellington',
                  'Nelson'            => 'Nelson',
                  'Christchurch'      => 'Christchurch',
                  'Dunedin'           => 'Dunedin',
                  'Invercargill'      => 'Invercargill',
              ),
              'empty' => __('choose one city')
          )) ?>
      </div>
  </div>

  <div class="control-group">
      <label class="control-label" for="account-street">Street</label>
      <div class="controls">
          <?php echo $this->Form->input('street', array('id'=>'account-street')) ?>
      </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="account-telephone">Telephone</label>
    <div class="controls">
      <?php echo $this->Form->input('telephone', array('id'=>'account-telephone')) ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="account-fax">Fax</label>
    <div class="controls">
      <?php echo $this->Form->input('fax', array('id'=>'account-fax')) ?>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="account-telephone">Suburb</label>
    <div class="controls">
      <?php echo $this->Form->input('suburb', array('id'=>'account-suburb')) ?>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="account-zipcode">Zip Code</label>
    <div class="controls">
      <?php echo $this->Form->input('zipcode', array(
        'id'=>'account-zipcode',
        'class' => 'input-small'
      )) ?>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="account-features">Features</label>
    <div class="controls">
      <?php
      //echo $this->Form->select('AccountFeature.feature_id',$features, array('multiple' => 'checkbox'));
      ?>
      <?php
        $index = 0;
        foreach($features as $feature_id=>$feature_name){

      ?>
          <div class="checkbox">
            <input type="checkbox" name="data[AccountFeature][feature_id][<?php echo $index ?>]"
                   value="<?php echo $feature_id ?>"
                   id="account_feature_<?php echo $index ?>">
            <label for="account_feature_<?php echo $index ?>"><?php echo $feature_name ?></label>
          </div>
      <?php
          $index++;
        }
      ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="account-avg_spending">Average Spending</label>
    <div class="controls">
      <?php echo $this->Form->input('avg_spending', array(
        'id'=>'account-avg_spending',
        'type' => 'number',
        'class' => 'input-small'
      )) ?>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="account-seat_num">Total Seat Number</label>
    <div class="controls">
      <?php echo $this->Form->input('seat_num', array(
        'id'=>'account-seat_num',
        'type' => 'number',
        'class' => 'input-small'
      )) ?>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="account-openFrom">Business Hours</label>
    <div class="controls">
      <?php echo $this->Form->time('openFrom', array(
        'id'=>'account-openFrom',
        'type'=>'time',
        'class' => 'input-small'
      )) ?>
      <?php echo $this->Form->time('openTo', array(
        'id'=>'account-openTo',
        'type'=>'time',
        'class' => 'input-small'
      )) ?>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="account-features">Categories</label>
    <div class="controls">
    <?php
    $index = 0;
    foreach($categories as $category_id=>$category_name){

      ?>
      <div class="checkbox">
        <input type="checkbox" name="data[AccountCategory][category_id][<?php echo $index ?>]"
               value="<?php echo $category_id ?>"
               id="account_category<?php echo $index ?>">
        <label for="account_category<?php echo $index ?>"><?php echo $category_name ?></label>
      </div>
      <?php
      $index++;
    }
    ?>
    </div>
  </div>

<?php
    $options = array(
        'label' => __('Continue'),
        'class' => 'btn btn-primary pull-right',
        'div' => false
    );
    echo $this->Form->end($options);
?>