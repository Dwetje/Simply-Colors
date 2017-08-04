<?php
  // Leeg alle sessie variabelen en database connectie
  $_SESSION['L_ID'] = "";
  $_SESSION['L_ADMINID'] = "";
  $_SESSION['L_NAME'] = "";
  $_SESSION['L_FRAME'] = "";
  $_SESSION['L_STATUS'] = 0;
  $db = null;
  session_destroy();
  echo "<script>location.href='index.php?page=Home';</script>"; // Ga terug naar Home
?>
