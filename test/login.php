<?php
  session_start();

  // Cek apakah sudah login atau belum. Jika sudah, langsung redirect
  // ke halaman index.php.
  if (isset($_SESSION["login_success"])) {
    header("Location: index.php");
    die(); // atau exit() juga boleh
  }

  // Jika belum login dan ada data yang dikirim melalui $_POST (form login)
  // maka cek email dan password yang diberikan.
  if ($_POST) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Cek email dan password
    require_once "database.php";

    // $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    // $result = $mysqli->query($sql);

    // Prepared statement untuk mencegah SQL Injection
    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      // Login berhasil. Catat di session.
      $_SESSION["login_success"] = true;
      $_SESSION["email"] = $email;

      // Kemudian, redirect ke index.php
      header("Location: index.php");
      die();
    } else {
      echo "<script>alert('Wrong email or password')</script>";
    }
  }
?>
<html>
  <head><title>Login</title></head>
  <body>
    <h1>Login</h1>
    <form method="post" action="login.php">
      Email:
      <input type="email" name="email" required>
      

      Password:
      <input type="password" name="password" required>
      

      <input type="submit" name="submit" value="Login">
    </form>
  </body>
</html>