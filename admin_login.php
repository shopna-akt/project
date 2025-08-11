<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php");
    } else {
        echo "Invalid login";
    }
}
?>
<form method="POST">
  Username: <input name="username">
  Password: <input name="password" type="password">
  <button type="submit">Login</button>
</form>
