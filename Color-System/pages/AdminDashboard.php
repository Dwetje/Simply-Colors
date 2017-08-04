<?php
  // Controleer of sessie waardes wel kloppen.
  if ($_SESSION['L_ADMINID'] == 1 && $_SESSION['L_STATUS'] === 2) {
    // Als Voeg product toe is ingedrukt. Voer de variabelen door van het productformulier.
    if (isset($_POST['submit'])) {
      $Productnaam = $_POST['Productnaam']; // In deze variables worden de verstuurde waardes opgeslagen.
      $RGB = $_POST['RGB'];
      $Prijs = $_POST['Prijs'];
      $newGUID = $GUID->getGUID();
      $Product->addProduct($newGUID, $db, $Productnaam, $RGB, $Prijs); //Verstuur de variabelen door naar methode addProduct uit classe $Product
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
        <div class="tab">
          <button class="tablinks" onclick="adminOptions(event, 'Profile')" id="defaultOpen">Profile</button>
          <button class="tablinks" onclick="adminOptions(event, 'Cart')">Cart</button>
          <button class="tablinks" onclick="adminOptions(event, 'Orders')">Orders</button>
          <button class="tablinks" onclick="adminOptions(event, 'Products')">Products</button>
        </div>

        <div id="Profile" class="tabcontent">
          <div class="col-md-12">
            <h3>Profile</h3>
          </div>
          <div class="col-md-4">
            <!-- Hier komt nog de profiel gegevens -->
            <div class="card" style="width: 20rem;">
              <img class="card-img-top" src="..." alt="Card image cap">
              <div class="card-block">
                <h4 class="card-title">Profile name</h4>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Edit</a>
              </div>
            </div>
          </div>
          <div class="col-md-8"></div>
        </div>
        <div id="Cart" class="tabcontent">
          <h3>Cart</h3>
          <?php  $OrderList->getListInfo($db, "Cart", $_SESSION['L_ID']); ?> <!-- Verstuur de variabelen door naar methode getListInfo uit classe $OrderList  -->
        </div>

        <div id="Orders" class="tabcontent">
          <h3>Orders</h3>
          <p>WIP</p>
        </div>

        <div id="Products" class="tabcontent">
          <h3>Add Product</h3>
          <form id='login-form' method='post' action='' onsubmit=''>
            <div class='form-group'>
              <label >Productnaam</label><br />
              <input type='text' name='Productnaam' value='' placeholder='Wit' required/>
            </div>
            <div class='form-group'>
              <label>RGB waarde</label><br />
              <input type='text' name='RGB' value='' placeholder='255,255,255' required/>
            </div>
            <div class='form-group'>
              <label>Prijs</label><br />
              <input type='text' name='Prijs' value='' placeholder='0,00' required/>
            </div>
            <div class='form-group'>
              <button type='submit' name='submit' value='true' class='btn btn-primary btn-lg' data-toggle='modal' data-target='#myModal'>Voeg product toe</button>
            </div>
          </form>
        </div>
        <script>
        function adminOptions(evt, adminOption) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(adminOption).style.display = "block";
            evt.currentTarget.className += " active";
        }
        document.getElementById("defaultOpen").click();
        </script>
      </div>
    </section>
  </body>
</html>
<?php
//Mocht het niet zo zijn. Word je toegewezen naar Uitloggen.
} else {
    echo "<script>
          alert('U bent niet ingelogged!');
          location.href='index.php?page=Uitloggen';
          </script>";
}
?>
