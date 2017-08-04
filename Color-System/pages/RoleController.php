<?php
  if ($_SESSION['L_ADMINID'] == 1 && $_SESSION['L_STATUS'] === 2) {
    echo "<script>location.href='index.php?page=AdminDashboard';</script>";
  } elseif ($_SESSION['L_ADMINID'] == 0 && $_SESSION['L_STATUS'] === 1) {
    // echo "<script>location.href='Index.php?page=UserDashboard';</script>";
  } else {
    echo "<script>
          alert('U bent niet ingelogged!');
          location.href='index.php?page=Uitloggen';
          </script>";
  }
?>
