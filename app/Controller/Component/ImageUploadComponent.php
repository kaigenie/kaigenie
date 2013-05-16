<?php
/**
 * Created by JetBrains PhpStorm.
 * User: I076004
 * Date: 5/13/13
 * Time: 9:05 PM
 * To change this template use File | Settings | File Templates.
 */
App::import('Component', 'Upload');

class ImageUploadComponent extends UploadComponent{

  private $accountId = null;

  function __construct(ComponentCollection $collection, $options = null){

    parent::__construct();

    $this->Image = ClassRegistry::init('Image');

    $uploadConfig = Configure::read("App.Uploads");

    $this->options = array_merge($this->options , $uploadConfig);

    if($options){
      // handle other options if provided
    }
  }

  public function delete_file(){

  }

  /**
   * @param array $option
   * @return array
   * @throws ConfigureException
   */
  public function upload($option = array()){

    if(isset($option["account_id"])){
      $this->accountId = $option["account_id"];
    }else{
      throw new ConfigureException("Account is missing");
    }
    $files = $this->upload_files();
    $images = array();
    if(!empty($files)){
      foreach($files as $key=>$file){
        $this->Image->create();
        $image = array(
          'name' => $file->name,
          'directory' => $file->dir,
          'extension' => $file->ext,
          'size'      => $file->size,
          'unique_name' => $file->name,
          'relative_path' => "",
          'mime_type'   => $file->type
        );
        $savedImage = $this->Image->save($image);
        $images[] = $savedImage;
      }

      $response = $this->generate_response(
        array($this->options['param_name'] => $files),
        true
      );
      return array("files"=>$images, "response"=>$response);
    }

    return array();
  }

  protected function generate_response($content, $print_response = false){
    return json_encode($content);
  }

  public function initialize(Controller $controller){

   // $this->init();

  }

  protected function get_unique_filename($name, $type, $index, $content_range){
    $tmp = explode('.', $name);
    $ext = $tmp["1"];
    return uniqid() . '.' . strtolower($ext);
  }

  public function handle_form_data($file, $index){
    // Handle form data, e.g. $_REQUEST['description'][$index]
  }

  protected function get_upload_path($file_name = null, $version = null){
    $file_name = $file_name ? $file_name : '';
    $version_path = empty($version) ? '' : $version . '/';
    return $this->options['upload_dir'] . $this->get_account_path()
            . $this->get_user_path() . $version_path . $file_name;
  }

  protected function get_account_path(){
    return $this->accountId . '/';
  }

}