<div class="setup-box account-upload-image">
  <div class="hd">
    <h4><?php echo __("Upload Photos") ?></h4>
  </div>
  <div class="con">
    <p class="con-hints">Upload Photos into the account, only jpeg, jpg, png allowed.</p>
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action='<?php echo Router::url(array("controller"=>"upload", "type"=>"account", "id"=>$account["Account"]["ID"])) ?>'
          method="POST" enctype="multipart/form-data">
      <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
      <div class="fileupload-buttonbar">
        <div class="span12">
          <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="icon-plus icon-white"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple>
                </span>
          <button type="submit" class="btn btn-primary start">
            <i class="icon-upload icon-white"></i>
            <span>Start upload</span>
          </button>
          <button type="reset" class="btn btn-warning cancel">
            <i class="icon-ban-circle icon-white"></i>
            <span>Cancel upload</span>
          </button>
<!--          <button type="button" class="btn btn-danger delete">-->
<!--            <i class="icon-trash icon-white"></i>-->
<!--            <span>Delete</span>-->
<!--          </button>-->
<!--          <input type="checkbox" class="toggle">-->

          <a class="btn btn-success pull-right"
             href="<?php echo Router::url(array("controller"=>"accounts", "action"=>"photos", "accid"=>$account["Account"]["ID"])) ?>">
            <i class="icon-eye-open"></i>
            <span>View All</span>
          </a>
          <!-- The loading indicator is shown during file processing -->
          <span class="fileupload-loading"></span>
        </div>
        <!-- The global progress information -->
        <div class="span12 fileupload-progress fade">
          <!-- The global progress bar -->
          <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
            <div class="bar" style="width:0%;"></div>
          </div>
          <!-- The extended global progress information -->
          <div class="progress-extended">&nbsp;</div>
        </div>
      </div>
      <!-- The table listing the files available for upload/download -->
      <div>
        <table role="presentation" class="table table-striped">
          <tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody>
        </table>
      </div>
      <br>
      <!-- modal-gallery is the modal dialog used for the image gallery -->
      <div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd" tabindex="-1">
        <div class="modal-header">
          <a class="close" data-dismiss="modal">&times;</a>
          <h3 class="modal-title"></h3>
        </div>
        <div class="modal-body"><div class="modal-image"></div></div>
        <div class="modal-footer">
          <a class="btn modal-download" target="_blank">
            <i class="icon-download"></i>
            <span>Download</span>
          </a>
          <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000">
            <i class="icon-play icon-white"></i>
            <span>Slideshow</span>
          </a>
          <a class="btn btn-info modal-prev">
            <i class="icon-arrow-left icon-white"></i>
            <span>Previous</span>
          </a>
          <a class="btn btn-primary modal-next">
            <span>Next</span>
            <i class="icon-arrow-right icon-white"></i>
          </a>
        </div>
      </div>
  </div>

</div>

  <!-- The template to display files available for upload -->
  <script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
      <td>
        <span class="preview"></span>
      </td>
      <td>
        <p class="name">{%=file.name%}</p>
        {% if (file.error) { %}
        <div><span class="label label-important">Error</span> {%=file.error%}</div>
        {% } %}
      </td>
      <td>
        <p class="size">{%=o.formatFileSize(file.size)%}</p>
        {% if (!o.files.error) { %}
        <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
        {% } %}
      </td>
      <td>
        {% if (!o.files.error && !i && !o.options.autoUpload) { %}
        <button class="btn btn-primary start">
          <i class="icon-upload icon-white"></i>
          <span>Start</span>
        </button>
        {% } %}
        {% if (!i) { %}
        <button class="btn btn-warning cancel">
          <i class="icon-ban-circle icon-white"></i>
          <span>Cancel</span>
        </button>
        {% } %}
      </td>
    </tr>
    {% } %}
  </script>
  <!-- The template to display files available for download -->
  <script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
      <td>
            <span class="preview">
                {% if (file.thumbnail_url) { %}
                    <a href="{%=file.url%}" title="{%=file.original_name%}" data-gallery="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
                {% } %}
            </span>
      </td>
      <td>
        <p class="name">
          <a href="{%=file.url%}" title="{%=file.original_name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.original_name%}</a>
        </p>
        {% if (file.error) { %}
        <div><span class="label label-important">Error</span> {%=file.error%}</div>
        {% } %}
      </td>
      <td>
        <span class="size">{%=o.formatFileSize(file.size)%}</span>
      </td>
      <td>
        <button class="btn btn-danger delete" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
        <i class="icon-trash icon-white"></i>
        <span>Delete</span>
        </button>
        <input type="checkbox" name="delete" value="1" class="toggle">
      </td>
    </tr>
    {% } %}
  </script>

  <?php echo $this->UI->loadJ5upFull(); ?>
  <script>
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
      // Uncomment the following to send cross-domain cookies:
      //xhrFields: {withCredentials: true},
      url: '<?php echo Router::url(array("controller"=>"upload", "type"=>"account", "id"=>$account["Account"]["ID"])) ?>'
    });
  </script>
