<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');

class Security
{

  private $general;

   public function __construct()
   {
       // Create an instance of the General class
       $this->general = new General();
   }


 public  function  LoginControl($deger,$tekmi=""){

      $session = $deger["session"];
      $homePage = $deger["homePage"];
      $loginPage = $deger["loginPage"];
      $logoutPage = $deger["logoutPage"];
      $panel = $deger["panel"];

      session_start();

      if($_SESSION[$session]==true) {


          $UserGet = $this->general->GetUser('token');
          $IpAdress = $this->general->GetUser('IpAdress');
          $ClientIpAdress = $this->general->Get_Client_Ip();

          if ($ClientIpAdress!=$IpAdress) {
            session_destroy();
            header("Location: $panel/$logoutPage");
            exit();
          }

          if ($UserGet=="") {
            session_destroy();
            header("Location: $panel/$logoutPage");
            exit();
          }


         if(isset($_SESSION['timeout']))
         {


               $session_life = time() - $_SESSION['timeout'];

               if($session_life > 60000000)
               {
                 session_destroy();
                 header("Location: $panel/$logoutPage");
               } else
               {
                 $_SESSION['timeout']=time();
               }
         }
       } else {
         if ($tekmi==1) {
           return true;
         }else {
           header("Location:$panel/$loginPage");
           exit(); // Yönlendirmeden sonra kodu sonlandır
         }

      }

  }



public  function Encrypt($data,$key) {
  $encoded = openssl_encrypt($data,"AES-128-ECB", $key);
  $encoded = base64_encode($encoded);
  return $encoded;
  }

public   function Decrypt($data,$key) {
  $data = base64_decode($data);
  $decoded = openssl_decrypt($data,"AES-128-ECB", $key);
  return $decoded;
}


}



$security = new Security();



 ?>
