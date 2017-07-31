<?php
if (isset($_POST['submit'])) {
  $error = "";
  $username = $_POST['Username']; // In deze variables worden de verstuurde waardes opgeslagen.
  $password = $_POST['Password'];
  // WIP
  $passwordHash = hash("sha256", $password);
  //
  if (strlen($error)<1) {
    try {
      $inlogQuery = "SELECT * FROM gebruikers WHERE gebruikersnaam = :Username AND wachtwoord = :Password"; // Deze query dient voor het controleren van de inlog gegevens.
      $stmt = $db -> prepare($inlogQuery);
      $stmt -> bindparam(':Username',$username);
      $stmt -> bindparam(':Password',$passwordHash);
      $stmt -> execute();
      $rows = $stmt -> fetch();
      $result = $rows > 0 ? true : false;
      $directie = $rows["rol"] == "Directie" ? true : false;
      // if () {
      //   # code...
      // }
        if($result){
          if($directie){
            $_SESSION['L_ADMINID'] = $rows['rol'];
            $_SESSION['L_NAME'] = $rows['gebruikersnaam'];
            $_SESSION['L_STATUS'] = 2;
            echo "<script>location.href='index.php?page=Directie';</script>";
          }else {
            $_SESSION['L_ADMINID'] = $rows['rol'];
            $_SESSION['L_NAME'] = $rows['gebruikersnaam'];
            $_SESSION['L_STATUS'] = 1;
            echo "<script>location.href='Index.php?page=Medewerker';</script>";
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
?>
<html>
<head>
  <title></title>
</head>
<body id="index">
  
</body>
</html>
