<?php
  session_start();

  // Cek apakah user sudah login. Jika belum, tidak bisa membuka file/halaman ini.
  // Arahkan (redirect) ke login terlebih dahulu.
  if (!isset($_SESSION["login_success"])) {
    header("Location: login.php");
    die();
  }
?>
<html>
  <head><title>Index</title></head>
  <body>
    <h1>Welcome</h1>
    <p>
      Anda berhasil login sebagai <?php echo $_SESSION["email"]; ?>.
    </p>
    <p><a href="logout.php">Logout</a></p>
  </body>
</html>