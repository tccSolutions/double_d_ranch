<?php
require dirname(__DIR__).'/vendor/autoload.php';
use Cloudinary\Api\Admin\AdminApi;
use Cloudinary\Configuration\Configuration;
Configuration::instance([
    'cloud' => [
      'cloud_name' => 'dmobley0608', 
      'api_key' => '172351854381963', 
      'api_secret' => 'aHccAD-bj6FasCVv_m_xn2BSjxg'],
    'url' => [
      'secure' => true]]);

$admin = new AdminApi();

 var_dump($cld->image('139754631816000'));
 exit;
