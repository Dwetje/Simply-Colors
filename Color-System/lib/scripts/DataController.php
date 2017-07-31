<?php
  $User = new User();
  $List = new List();
  $Product = new Product();
  $Voorraad = new Voorraad();
  $Login = new Login();
  $GUID = new GUID();
  // $variable->function($_POST);
  // $_POST == $postData
  /**
   *
   */
  class User
  {
    static public $userID;
    static public $userName;
    static public $email;
    static public $rol;
    static public $sessionSet;
    function getUserInfo($postData)
    {
      self::$userID = $postData['userID'];
      self::$userName = $postData['userName'];
      self::$email = $postData['email'];
      self::$rol = $postData['rol'];
      self::$sessionSet = $postData[''];
      # code...
    }
    function checkRol($postData){
      self::$rol = $postData['rol'];
      # code...
    }
  }
  /**
   *
   */
  class List
  {
    static public $bestelLijstCartID;
    static public $userID;
    static public $productID;
    function getListInfo($postData)
    {
      # code...
    }
    function updateListInfo($postData)
    {
      # code...
    }
    function deleteFromListInfo($postData)
    {
      # code...
    }
  }
  /**
   *
   */
  class Product
  {
    static public $productID;
    static public $productNaam;
    static public $RGB;
    static public $prijs;
    function getProductInfo()
    {
      # code...
    }
    function getProductList()
    {
      # code...
    }
  }
  /**
   *
   */
  class Voorraad
  {
    static public $voorraadID;
    static public $productID;
    static public $aantal;
    function deleteVoorraad()
    {
      # code...
    }
    function getVoorraad()
    {
      # code...
    }
    function checkVoorraad()
    {
      # code...
    }
    function updateVoorraad()
    {
      # code...
    }
  }
  /**
   *
   */
  class Login
  {
    static public $userName;
    static public $password;
    function getDB()
    {
      DEFINE("DB_USER", "");
      DEFINE("DB_PASS", "");

      try {
      	$db = new PDO("mysql:host=localhost;dbname=", DB_USER, DB_PASS);
      	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {

      	echo $e->getMessage();

      }
    }
    function getLogin()
    {
      # code...
    }
  }
  /**
   *
   */
  class GUID
  {
    static public $guid;
    function getGUID(){
        if (function_exists('com_create_guid')){
            return com_create_guid();
        }else{
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid =
                substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12);
            return $uuid;
        }
    }
  }

?>
