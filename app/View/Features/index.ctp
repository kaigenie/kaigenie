
<div class="setup-box feature-list">
  <div class="hd">
    <h5><?php echo __("Setup Account Features") ?></h5>
  </div>
  <div class="con">
    <div class="span12">
      <a class="btn btn-small btn-success add " href="<?php echo Router::url(array('controller' => 'features', 'action'=> 'add')) ?>">
        <i class="icon-plus-sign"></i>
        <span>New</span>
      </a>
    </div>
    <?php if(empty($features)):
            echo __("No Record Found");
      ?>

      <?php else: ?>
      <table class="table table-hover">

        <thead>
        <tr>
          <th><?php echo __('ID') ?></th>
          <th><?php echo __('Name') ?></th>
          <th><?php echo __('# of Account') ?></th>
          <th><?php echo __('Action') ?></th>
        </tr>
        </thead>
        <?php foreach ($features as $feature): ?>
          <tr>
            <td><?php echo $feature['Feature']['ID']; ?></td>
            <td>
              <?php echo $this->Html->link($feature['Feature']['name'], array('action' => 'view', $feature['Feature']['ID'])); ?>
            </td>
            <td><?php echo $feature['0']['cntAcc']; ?></td>
            <td>
              <div class="btn-group">
                <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
                  Action
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <?php echo $this->Html->link(
                      $this->Html->icon('icon-edit icon-large',__('Edit')),
                      array(
                        'controller' => 'features',
                        'action' => 'edit',
                        $feature['Feature']['ID']
                      ),
                      array('escape' => false)
                    ) ?>
                  </li>
                  <li>
                    <?php echo $this->Html->link(
                      $this->Html->icon('icon-trash icon-large',__('Delete')),
                      '#',
                      array('escape' => false, "class"=>'delete-feature',
                            'data-feature-id'=>$feature['Feature']['ID'],
                            'data-feature-name'=>$feature['Feature']['name'])
                    ) ?>
                  </li>

                </ul>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>

      </table>

    <?php endif; ?>
  </div>
</div>

<div id="modal-feature-delete" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4>Confirmation</h4>
  </div>
  <div class="modal-body"></div>
  <div class="modal-footer">
    <a href="#" data-dismiss="modal" class="btn secondary">No</a>
    <a href="#" class="btn btn-danger">Yes</a>
  </div>
</div>

<script type="text/javascript">
  $(function(){


    var deleteModal = $('div#modal-feature-delete');

    $('a.delete-feature').on('click',function(event){
      event.preventDefault();

      var that = $(this),
          line = that.parents('tr'),
          featureId = that.data('feature-id'),
          featureNm = that.data('feature-name');
      deleteModal.on('show',function(){
        $('<span/>')
          .addClass('label label-info')
          .text('Are you sure you want to delete '+ featureNm)
          .appendTo(deleteModal.find('.modal-body'));
      });
      deleteModal.on('hide',function(){
        deleteModal.find('.modal-body').html('');
      });
      deleteModal.modal('show');
      deleteModal.off('show');

    });
  });

</script>

