<h1>UploadiFive Demo</h1>
<form action="" method="POST" enctype="multipart/form-data">

  <input id="file_upload" name="file_upload" type="file" multiple="true">
  <a href="javascript:$('#file_upload').uploadifive('upload')">Upload Files</a>

  <!--This is our main container, which contains the thumbnail list-->
  <div class="output">
    <span class="dnd-tip">Drag and drop your files.</span>
    <div class="thumb-container">
      <ul class="thumb" id="queue">
      </ul>
    </div>
  </div>
</form>

<script>

  <?php $timestamp = time();?>
  $(function() {
    $('#file_upload').uploadifive({
      'auto'             : false,
      'checkScript'      : false,
      'formData'         : {
        'timestamp' : '<?php echo $timestamp;?>',
        'token'     : '<?php echo md5(Configure::read('Security.salt') . $timestamp);?>'
      },
      'queueID'          : 'queue',
      'uploadScript'     : '<?php echo $this->here ?>'

    });
  });
</script>