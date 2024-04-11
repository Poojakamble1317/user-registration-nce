<?php
define('_USER_REGISTER_URL_',"http://".$_SERVER['HTTP_HOST'].'/user-registration-nce');
date_default_timezone_set("Asia/Kolkata");
class usersecure {
   private static $secretKey = 'User Registration Demo'; 
   private static $secretIv = 'www.admin.registration.com';
   private static $encryptMethod = "AES-256-CBC"; 
   public static function userencrypt($data) {
   	  $key = hash('sha256', self::$secretKey);
   	  $iv = substr(hash('sha256', self::$secretIv), 0, 16);
   	  $result = openssl_encrypt($data, self::$encryptMethod, $key, 0, $iv);
      return $result= base64_encode($result);
   }
   public static function userdecrypt($data) {
   	  $key = hash('sha256', self::$secretKey);
   	  $iv = substr(hash('sha256', self::$secretIv), 0, 16);
   	  $result = openssl_decrypt(base64_decode($data), self::$encryptMethod, $key, 0, $iv);
      return $result;
   }
}
?>