<?php
// Als login is ingedrukt. Voer de variabelen door van het inlogformulier.
if (isset($_POST['submit'])) {
  $username = $_POST['Username']; // In deze variables worden de verstuurde waardes opgeslagen.
  $password = $_POST['Password'];
  $Login->getLogin($db, $username, $password); //Verstuur de variabelen door naar methode getLogin uit classe $login
}
// Als addToCart is ingedrukt. Voer de variabelen door van het product.
if (isset($_POST['addToCart'])) {
  $dataID = "Cart"; // In deze variables worden de verstuurde waardes opgeslagen.
  $getGUID = $GUID->getGUID(); // Genereer een unieke code als ID
  $OrderList->addListInfo($getGUID, $db, $dataID, $_POST); //Verstuur de variabelen door naar methode addListInfo uit classe $OrderList
}

?>
<html>
  <head>
    <title></title>
    <?php $html->getHeadInfo(); ?> <!-- Haal alle opgeslagen informatie op voor <head>  -->
  </head>
  <body class="index">
    <section id="" class="">
      <div class="">
        <?php $html->getNavBar(); ?> <!-- Haal alle opgeslagen informatie op voor de navigatie  -->
      </div>
    </section>
    <!-- body -->
    <section id="" class="">
      <div class="">
        <?php  $Product->getProductList($db);   ?> <!-- Verstuur de variabelen door naar methode getProductList uit classe $Product  -->
      </div>
    </section>
  </body>
</html>
