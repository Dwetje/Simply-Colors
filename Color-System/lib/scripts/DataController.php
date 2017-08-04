<?php
  // Defineer variabelen voor database connectie
  DEFINE("DB_USER", "root");
  DEFINE("DB_PASS", "");
  try {
    $db = new PDO("mysql:host=localhost;dbname=simply-colors", DB_USER, DB_PASS); // Instelling voor connectie
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Maak connectie
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
  // Defineer variabelen voor alle classes
  $User = new User();
  $OrderList = new Order();
  $Product = new Product();
  $Login = new Login();
  $GUID = new GUID();
  $html = new HTML();

  // User class voor methodes betreft users/gebruikers
  class User
  {
    // Defineer static variabelen die toegangelijk zijn voor alle methodes binnen de class
    static public $userID;
    static public $userName;
    static public $email;
    static public $rol;
    static public $sessionSet;
    // Methode om gebruikers informatie op te halen en daarmee je profiel mee weer te geven
    function getUserInfo($postData)
    {
      // Koppel static variabelen met input van de arguments uit de methode
      self::$userID = $postData['userID'];
      self::$userName = $postData['userName'];
      self::$email = $postData['email'];
      self::$rol = $postData['rol'];
      self::$sessionSet = $postData[''];
      # WIP...
    }
  }
  /**
   *
   */
  // User Order voor methodes betreft bestellingen en Cart
  class Order
  {
    // Defineer static variabelen die toegangelijk zijn voor alle methodes binnen de class
    static public $GUID;
    static public $db;
    static public $postValue;
    static public $bestelLijstCartID;
    static public $userID;
    static public $productID;
    static public $aantal;
    // Koppel static vaiabelen met input van de arguments uit de methode
    function getListInfo($db_, $postData, $user_)
    {
      // Koppel static variabelen met input van de arguments uit de methode
      self::$postValue = $postData;
      self::$db = $db_;
      self::$userID = $user_;
      // schakel tussen het ophalen van bestellijsten en cart doormiddel van een argument
      switch (self::$postValue) {
        case 'Order':
          // $getBestellijstSQL = "SELECT * FROM `bestellijst-7155` WHERE ";
        break;
        case 'Cart':
          $totaalPrijsProductenArray = array();
          //Zet query klaar 'selecteer alles van cart waar userID gelijk is aan die gegeven userID'
          $getCartSQL = "SELECT * FROM `cart-8355` WHERE `userID` = :userID";
          // Zet prepared statement klaar
          $getCartStmt = self::$db->prepare($getCartSQL);
          // Koppel variabelen
          $getCartStmt->bindparam(":userID", self::$userID);
          //
          echo "
          <form id='cart-form' method='post' action='' onsubmit=''>
          <table class='table-striped'>
            <tbody>";
          // Vestuur query
          if ($getCartStmt->execute()) {
            // Haal alle informatie op
            $getCartRows = $getCartStmt->fetchAll();
            // Controleer hoeveel rows
            $countCartRows = $getCartStmt->rowCount();
            // Sluit af
            $getCartStmt->closeCursor();
            // Schrijf tabel uit
            echo "<tr><td>Product</td><td>RGB</td><td>Aantal</td><td>Prijs</td></tr>";
            // Haal voor elke ----
            for ($cartRowI=0; $cartRowI < $countCartRows; $cartRowI++) {
              echo "
              <tr>";
              $productCartSQL = "SELECT * FROM `producten-7416` WHERE `productID` = :productID";
              $productCartStmt = self::$db->prepare($productCartSQL);
              $productCartStmt->bindparam(":productID", $getCartRows[$cartRowI]['productID']);
              if ($productCartStmt->execute()) {
                $productCartRows = $productCartStmt->fetchAll();
                $productCartStmtCount = $productCartStmt->rowCount();
                for ($productCartRowI=0; $productCartRowI < $productCartStmtCount; $productCartRowI++) {
                  echo "
                    <td>" . $productCartRows[$productCartRowI]['productnaam'] . "</td>
                    <td>" . $productCartRows[$productCartRowI]['rgb'] . "</td>
                  ";
                  $totaalPrijsProduct = $productCartRows[$productCartRowI]['prijs'] * $getCartRows[$cartRowI]['aantal'];
                  array_push($totaalPrijsProductenArray, $totaalPrijsProduct);
                }
              } else {
                echo "<td>No record</td>";
              }
              echo "<td>" . $getCartRows[$cartRowI]['aantal'] . "</td>
              <td>&euro;" . $totaalPrijsProductenArray[$cartRowI] . "</td>
              <td><button class='btn btn-primary' type='submit' name='Delete' value=''>Delete</button></td>";
              echo "
              </tr>";
            }
          } else {

            echo "Can't get cart";
          }
          echo "<tr> <td colspan='4'>Totaal: &euro;" . array_sum($totaalPrijsProductenArray) . "</td> </tr>";
          echo "<tr>
            <td colspan='2'><button class='btn btn-primary' type='submit' name='Order' value=''>Order</button></td>
            <td colspan='2'><button class='btn btn-primary' type='submit'name='Empty' value=''>Empty</button></td>
          </tr>";
          echo "
            </tbody>
          </table>
          </from>
          ";
        break;
        default:
          echo "Can't get list.";
        break;
      }
    }
    function addListInfo($getGUID_, $db_, $dataID_, $postData_)
    {
      // Koppel static variabelen met input van de arguments uit de methode
      self::$GUID = $getGUID_;
      self::$db = $db_;
      self::$postValue = $dataID_;
      self::$productID = $postData_['addToCart'];
      self::$aantal = $postData_['aantal'];
      switch (self::$postValue) {
        case 'Order':

        break;
        case 'Cart':
          $insertCartSQL = "INSERT INTO `cart-8355`(`cartID`, `userID`, `productID`, `aantal`) VALUES (:cartID, :userID, :productID, :aantal)";
          $insertCartStmt = self::$db->prepare($insertCartSQL);
          $insertCartStmt->bindparam(':cartID',self::$GUID);
          $insertCartStmt->bindparam(':userID',$_SESSION['L_ID']);
          $insertCartStmt->bindparam(':productID',self::$productID);
          $insertCartStmt->bindparam(':aantal',self::$aantal);
          if ($insertCartStmt->execute()) {
            // echo "Added to cart.";
          } else {
            echo "Not added to cart.";
          }
        break;
      default:
        # code...
      break;
      }
    }
    function updateListInfo($postData)
    {
      # code...
    }
    function deleteFromListInfo($postData)
    {
      # code...
    }
    function placeOrder()
    {
      # code... // doe iets met checkVoorrraad
    }
    function checkVoorraad()
    {
      # code...
    }
  }
  /**
   *
   */
  class Product
  {
    // Defineer static variabelen die toegangelijk zijn voor alle methodes binnen de class
    static public $GUID;
    static public $db;
    static public $productID;
    static public $productNaam;
    static public $RGB;
    static public $prijs;
    function addProduct($GUID_AP, $db_AP, $productNaam_AP, $RGB_AP, $prijs_AP)
    {
      // Koppel static variabelen met input van de arguments uit de methode
      self::$GUID = $GUID_AP;
      self::$db = $db_AP;
      self::$productNaam = $productNaam_AP;
      self::$RGB = $RGB_AP;
      self::$prijs = $prijs_AP;
      $addProductSQL = "INSERT INTO `producten-7416`(`productID`, `productnaam`, `rgb`, `prijs`) VALUES (:productID, :productNaam, :rgb, :prijs)";
      $addProductStmt = self::$db->prepare($addProductSQL);
      $addProductStmt->bindparam(":productID", self::$GUID);
      $addProductStmt->bindparam(":productNaam", self::$productNaam);
      $addProductStmt->bindparam(":rgb", self::$RGB);
      $addProductStmt->bindparam(":prijs", self::$prijs);
      if ($addProductStmt->execute()) {
        $addProductStmt->closeCursor();
      } else {
        echo "<script>alert('Cannot add product.');</script>";
      }
    }
    function getProductInfo()
    {
      # code...
    }
    function getProductList($db_value)
    {
      // Koppel static variabelen met input van de arguments uit de methode
      self::$db = $db_value;
      $getProductListSQL = "SELECT * FROM `producten-7416`";
      $getProductListStmt = self::$db->prepare($getProductListSQL);
      if ($getProductListStmt->execute()) {
        $productRows = $getProductListStmt->fetchAll();
        $productRowCount = $getProductListStmt->Rowcount();
        echo "<div class='productList'>";
        for ($productRowI=0; $productRowI < $productRowCount; $productRowI++) {
          echo "
            <div class='col-md-3'>
            <div class='card' style='width: 20rem;'>
              <img class='card-img-top' src='...' alt='Card image cap' style='background-color:rgba(" . $productRows[$productRowI]['rgb'] . ",1);width:100px;height:100px;'>
              <div class='card-block'>
                <form id='addToCart-form' method='post' action='' onsubmit=''>
                  <h4 class='card-title' name='productNaam' >Product: ". $productRows[$productRowI]['productnaam'] ."</h4>
                  <p class='card-text' name='RGB' >RGB: ". $productRows[$productRowI]['rgb'] ."</p>
                  <p class='card-text' name='Prijs' >Prijs: ". $productRows[$productRowI]['prijs'] ."</p>
                  Aantal<input type='text' name='aantal'/>
                  <button class='btn btn-primary' type='submit' value='". $productRows[$productRowI]['productID'] ."' name='addToCart'>Add to cart</button>
                </form>
              </div>
            </div>
            </div>";
        }
        echo "</div>";
        $getProductListStmt->closeCursor();
      } else {
        echo "Cannot get list.";
      }
    }
  }
  /**
   *
   */
  class Login
  {
    // Defineer static variabelen die toegangelijk zijn voor alle methodes binnen de class
    static public $userName;
    static public $password;
    static public $passwordHash;
    static public $rol;
    static public $email;
    static public $db;
    static public $guid;
    static public $DBConfig;
    function getLogin($db_value, $userN, $passW)
    {
      // Koppel static variabelen met input van de arguments uit de methode
      $error = "";
      self::$db = $db_value;
      self::$userName = $userN;
      self::$password = $passW;
      self::$passwordHash = hash("sha256", self::$password);
      // echo self::$userName . "<br>" . self::$password . "<br>" . self::$passwordHash;
      //
      if (strlen($error)<1) {
        try {
          $inlogQuery = "SELECT * FROM `users-3469` WHERE gebruikersnaam = :Username AND password = :Password"; // Deze query dient voor het controleren van de inlog gegevens.
          $stmt = self::$db->prepare($inlogQuery);
          $stmt->bindparam(':Username',self::$userName);
          $stmt->bindparam(':Password',self::$passwordHash);
          $stmt->execute();
          $rows = $stmt->fetch();
          $result = $rows > 0 ? true : false;
          $directie = $rows["rol"] == 1 ? true : false;
            if($result){
              if($directie){
                $_SESSION['L_ADMINID'] = $rows['rol'];
                $_SESSION['L_NAME'] = $rows['gebruikersnaam'];
                $_SESSION['L_ID'] = $rows['userID'];
                $_SESSION['L_LOGIN'] = 1;
                $_SESSION['L_STATUS'] = 2;
                // echo "Oh";
                echo "<script>location.href='Index.php?page=RoleController';</script>";
              }else {
                $_SESSION['L_ADMINID'] = $rows['rol'];
                $_SESSION['L_NAME'] = $rows['gebruikersnaam'];
                $_SESSION['L_ID'] = $rows['userID'];
                $_SESSION['L_LOGIN'] = 2;
                $_SESSION['L_STATUS'] = 1;
                // echo "Oh no";
                echo "<script>location.href='Index.php?page=RoleController';</script>";
              }
            }else {
              $error .= "Gegevens zijn niet bij ons bekend! Probeer nogmaals.";
              echo "<script type='text/javascript'>alert('" . $error . "');</script>";

            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
      }
    }
  }
  /**
   *
   */
  class GUID
  {
    // methode dat een formule gebruikt om unieke codes te genereren
    function getGUID(){
        if (function_exists('com_create_guid')){
            return com_create_guid();
        }else{
            mt_srand((double)microtime()*10000);
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
  /**
   *
   */
  class HTML // view
  {
    // functie voor het ophalen van informatie voor <head>
    function getHeadInfo()
    {
      echo "
        <meta charset='utf-8'>
        <link rel='stylesheet' href='lib/assets/css/style.css'>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css' integrity='sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ' crossorigin='anonymous'>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js' integrity='sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn' crossorigin='anonymous'></script>
        <!-- Latest compiled and minified CSS -->
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>
        <!-- Optional theme -->
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css' integrity='sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp' crossorigin='anonymous'>
        <!-- Latest compiled and minified JavaScript -->
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>
        <meta name='viewport' content='width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0'/>
        <meta name='apple-mobile-web-app-capable' content='yes'/>
        <meta name='apple-mobile-web-app-status-bar-style' content='black'/>
        <meta http-equiv='Content-Type' content='text/html;charset=utf-8'/>
        <meta http-equiv='x-ua-compatible' content='IE=edge'/>
        <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js'></script>
      	<script src='http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js'></script>";
    }
    // functie voor het ophalen van informatie voor navigatie
    function getNavBar(){
        echo "<nav class='navbar navbar-toggleable-md navbar-light bg-faded'>
                  <button class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse' data-target='#navbarNavDropdown' aria-controls='navbarNavDropdown' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                  </button>
                  <a class='navbar-brand' href='#'>Color</a>
                  <div class='collapse navbar-collapse' id='navbarNavDropdown'>
                    <ul class='navbar-nav'>
                      <li class='nav-item active'>
                        <a class='nav-link' href='index.php?page=Home'>HOME <span class='sr-only'>(current)</span></a>
                      </li>
                      ";
                      echo "<li class='nav-item'>
                        <a class='nav-link' href='index.php?page=RoleController'>ACCOUNT</a>
                      </li>";
                      echo "<li class='nav-item'>
                        <button type='button' class='nav-link' data-toggle='modal' data-target='#exampleModalLong'>
                          Sign in
                        </button>
                        <!-- Modal -->
                        <div class='modal fade' id='exampleModalLong' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>
                          <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title' id='exampleModalLongTitle'>Modal title</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                              </div>
                              <div class='modal-body'>
                                <form id='login-form' method='post' action='' onsubmit=''>
                                  <div class='form-group'>
                                    <label >Gebruikersnaam</label><br />
                                    <input type='text' name='Username' value='' placeholder='Naam' required/>
                                  </div>
                                  <div class='form-group'>
                                    <label>Wachtwoord</label><br />
                                    <input type='password' name='Password' value='' placeholder='********' required/>
                                  </div>
                                  <div class='form-group'>
                                    <button type='submit' name='submit' value='true' class='btn btn-primary btn-lg' data-toggle='modal' data-target='#myModal'>Inloggen</button>
                                  </div>
                                </form>
                              </div>
                              <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>";
                      echo "<li class='nav-item'>
                        <a class='dropdown-item' href='index.php?page=uitloggen'>Sign out</a>
                      </li>";
                      echo "
                    </ul>
                  </div>
                </nav>";
    }
  }

?>
