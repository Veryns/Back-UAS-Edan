<?php
  session_start();

  // Hapus semua session yang ada
  session_destroy();

  // Redirect ke login
  header("Location: login.php");
  die();
?>  