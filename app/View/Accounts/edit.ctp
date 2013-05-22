<div class="setup-box account-edit">

  <div class="hd">
    <h5><?php echo __("General Info") ?></h5>
  </div>

  <div class="con">

    <?php echo $this->Form->create('Account', array(
        'inputDefaults' => array('div'=>false, 'label'=>false),
        'url'=>array('controller' => 'accounts', 'action' => 'edit'),
        'class' => 'form-horizontal'
      )
    );
    ?>

    <div class="control-group">
      <label class="control-label" for="account-name">Account Name</label>
      <div class="controls">
        <?php echo $this->Form->input('name', array('id'=>'account-name')) ?>
        <?php echo $this->Form->hidden('id') ?>
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
      <label class="control-label" for="account-type">Level</label>
      <div class="controls">
        <?php echo $this->Form->input('level', array(
          'id'=>'account-type',
          'options'=> Configure::read('Account.Level')
        )) ?>
      </div>
    </div>


    <div class="control-group">
      <label class="control-label" for="account-admin">Administrators</label>
      <div class="controls">
        <div id="account-user-list">
          <?php
          $accountUsers = $this->data['AccountUser'];
          if(empty($accountUsers)){
            echo "Doesn't have an account yet. ";
          } else {
            echo $this->UI->userlist($accountUsers, array("class" => 'inline'));
          }
          ?>
        </div>
        <?php
        echo $this->UI->link('Add?', "#add-admin-to-account", array("role" => 'button' , 'data-toggle'=>'modal', 'class' => 'btn btn-primary btn-small'));
        ?>
      </div>
    </div>

    <div class="hd">
      <h5><?php echo __('Location Info') ?></h5>
    </div>

    <div class="con">
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
            )
          )) ?>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="account-suburb">Street</label>
        <div class="controls">
          <?php echo $this->Form->input('street', array('id'=>'account-street')) ?>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="account-suburb">Telephone</label>
        <div class="controls">
          <?php echo $this->Form->input('telephone', array('id'=>'account-telephone')) ?>
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

      <?php if(!empty($features)): ?>
        <div class="control-group">
          <label class="control-label" for="account-features">Features</label>
          <div class="controls">
            <?php
            echo $this->Form->select(
              'AccountFeature.feature_id',
              $features,
              array(
                'multiple' => 'checkbox',
                'value' => array_map(
                  function($item){
                    return $item['feature_id'];
                  },
                  $this->data['AccountFeature']
                )
              )
            );
            ?>

          </div>
        </div>
      <?php endif; ?>

    </div>


    <div class="hd">
      <h5><?php echo __('Other Info') ?></h5>
    </div>

    <div class="con">
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

      <?php if(!empty($categories)): ?>
        <div class="control-group">
          <label class="control-label" for="account-features">Categories</label>
          <div class="controls">
            <?php
            echo $this->Form->select(
              'AccountCategory.category_id',$categories,
              array(
                'multiple' => 'checkbox',
                'value'    => array_map(
                  function($item){
                    return $item['category_id'];
                  },
                  $this->data['AccountCategory']
                )
              )
            );
            ?>
          </div>
        </div>

      <?php endif; ?>

    </div>
  </div>



  <?php
  $options = array(
    'label' => __('Update'),
    'class' => 'btn btn-primary pull-right',
    'div' => false
  );
  echo $this->Form->end($options);
  ?>


</div>



<div id="add-admin-to-account" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h5>Assign an Administrator</h5>
  </div>
  <div class="modal-body">
    <?php echo $this->Form->create('User', array(
        'inputDefaults' => array('div'=>false, 'label'=>false),
        'url'=>array('controller' => 'users', 'action' => 'add_admin'),
        'default' => false,
        'id'      => 'form-assign-admin'
      )
    );
    ?>
    <div class="controls">
      <?php
        echo $this->Form->input('username', array(
          'type'        => 'text',
          'placeholder' => __('Username'),
          'class'       => 'span8'
        ));
        echo $this->Form->hidden('account_id' ,array("value" => $this->data['Account']['ID']));
      ?>
    </div>
    <div class="controls controls-row">
      <?php
      echo $this->Form->input('first_name', array(
        'type'        => 'text',
        'placeholder' => __('First Name'),
        'class'       => 'span4'
      ));
      echo $this->Form->input('last_name', array(
        'type'        => 'text',
        'placeholder' => __('Last Name'),
        'class'       => 'span4'
      ));
      ?>
    </div>
    <div class="controls controls-row">
      <?php
      echo $this->Form->input('email', array(
        'type'        => 'text',
        'placeholder' => __('Email Address'),
        'class'       => 'span8'
      ));
      ?>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
    <?php
    $options = array(
      'label' => __('Assign'),
      'class' => 'btn btn-primary pull-right',
      'div' => false,
      'id'  => 'btn-assign-admin'
    );
    echo $this->Form->end($options);

//    $data = $this->Js->get('#form-assign-admin')->serializeForm(array('isForm' => true, 'inline' => true));
//    $this->Js->get('#form-assign-admin')->event(
//      'submit',
//      $this->Js->request(
//        array('controller'=>'users', 'action' => 'add_admin'),
//        array(
//          'update' => '#commentStatus',
//          'data' => $data,
//          'async' => true,
//          'dataExpression'=>true,
//          'method' => 'POST'
//        )
//      )
//    );
//
//    echo $this->Js->writeBuffer();
    ?>
    <script>
      $(document).ready(function(){
        $("#form-assign-admin").bind('submit', function(event){
          var xhr = $.ajax({
            async : true,
            url   : '<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'add_admin')) ?>',
            data  : $("#form-assign-admin").serialize(),
            type: 'POST'
          });

          xhr.success(function(data){
            var admins = JSON.parse(data);
            if(admins && admins.length > 0){
              var result = '<ul class="inline">';
              for(var key in admins){
                var admin = admins[key];
                result += '<li><a href="#">'+admin.User.username+'</a></li>';
              }
              result += '</ul>';
              $("#account-user-list").html(result);
              $('#add-admin-to-account').modal('hide');
            }

          });
          xhr.fail(function(err){
            console.log(err);
          });
        })
      })

    </script>
  </div>
</div>