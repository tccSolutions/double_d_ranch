<?php
require dirname(__DIR__).'/vendor/autoload.php';
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Api\Admin\AdminApi;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

Configuration::instance([
  'cloud' => [
    'cloud_name' => 'hynhj7nmf', 
    'api_key' => '424537574772339', 
    'api_secret' => 'AM50EuC6bHia_MXRXnMXuc_orgk'],
  'url' => [
    'secure' => true]]);


class CloudImage{
 

  public static function upload($file, $horse){
   
    $upload = new UploadApi();   

    return $upload->upload($file, 
          ["folder"=> "double_d_ranch/$horse->name/"]);
  }

  public static function delete( $public_id){
    $upload = new UploadApi();
    return $upload->destroy($public_id);
  }
}
