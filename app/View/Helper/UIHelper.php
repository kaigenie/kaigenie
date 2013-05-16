<?php
/**
 * Created by kaigenie.
 * User: I076004
 * Date: 4/21/13
 * Time: 2:03 PM
 * To change this template use File | Settings | File Templates.
 */

App::uses('HtmlHelper', 'View/Helper');

class UIHelper extends HtmlHelper{

  public function icon($class = null, $text = null, $options = array()) {
    if (!empty($class)) {
        $options['class'] = $class;
    }

    $icon = '<i class="%s"></i> <span class="">%s</span>';
    return sprintf($icon, $class, $text);
  }

  public function userlist($users = array(), $options = array()){
    if(!empty($users)){
      $result = sprintf("<ul class='%s'>", $options['class']);
      foreach($users as $key=>$user){
        $result .= sprintf("<li><a href='#'>%s</a></li>", $user['User']['username']);
      }
      $result .= "</ul>";

      return $result;
    }
    return "";
  }

  public function loadJ5upBasic(){
    self::_loadJQueryFileUploadCss();
    self::_loadJQueryFileUploadBasicJs();

  }

  public function loadJ5upFull(){
    self::_loadJQueryFileUploadCss();
    self::_loadBootstrapImageGallaryCss();
    self::_loadJQueryFileUploadBasicJs();
    self::_loadJQueryFileUploadOtherJs();
  }

  /**
   *	Load external JS files needed for JQuery File Upload.
   * 	@access private
   * 	@return void
   */
  private function _loadJQueryFileUploadOtherJs()
  {
    // <script type="text/javascript" src="'.Router::url('/', true).'js/j5up/tmpl.js"></script>
    echo '
    <script type="text/javascript" src="'.Router::url('/', true).'js/j5up/bootstrap-image-gallery.js"></script>
		<script type="text/javascript" src="'.Router::url('/', true).'js/j5up/jquery.fileupload-ui.js"></script>
		<!--[if gte IE 8]><script src="js/j5up/cors/jquery.xdr-transport.js"></script><![endif]-->
		';
  }

  private function _loadJQueryFileUploadBasicJs(){

    echo '
    <script type="text/javascript" src="'.Router::url('/', true).'js/j5up/vendor/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="'.Router::url('/', true).'js/j5up/tmpl.js"></script>
    <script type="text/javascript" src="'.Router::url('/', true).'js/j5up/jquery.fileupload.js"></script>
    <script type="text/javascript" src="'.Router::url('/', true).'js/j5up/load-image.js"></script>
    <script type="text/javascript" src="'.Router::url('/', true).'js/j5up/canvas-to-blob.js"></script>
    <script type="text/javascript" src="'.Router::url('/', true).'js/j5up/jquery.iframe-transport.js"></script>
    <script type="text/javascript" src="'.Router::url('/', true).'js/j5up/jquery.fileupload-process.js"></script>
		<script type="text/javascript" src="'.Router::url('/', true).'js/j5up/jquery.fileupload-resize.js"></script>
		<script type="text/javascript" src="'.Router::url('/', true).'js/j5up/jquery.fileupload-validate.js"></script>
    ';

  }

  private function _loadJQueryFileUploadCss(){
    echo '
      <link rel="stylesheet" href="'. Router::url('/', true) .'css/jquery.fileupload-ui.css">
    ';
  }

  private function _loadBootstrapImageGallaryCss(){
    echo '<link rel="stylesheet" href="'. Router::url('/', true) .'css/bootstrap-image-gallery.css">';
  }






}