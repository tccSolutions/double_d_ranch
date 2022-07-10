<?php
require dirname(__DIR__).'/vendor/autoload.php';
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Api\Admin\AdminApi;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

Configuration::instance([
  'cloud' => [
    'cloud_name' => 'dmobley0608', 
    'api_key' => '172351854381963', 
    'api_secret' => 'aHccAD-bj6FasCVv_m_xn2BSjxg'],
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
