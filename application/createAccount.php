<?php
require_once '../database/db_info.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $displayname = validate($_POST["displayname"]);
  $username    = validate($_POST["username"]);
  $password    = validate($_POST["password"]);

  $query = "SELECT EXISTS(SELECT 1 FROM Users WHERE username='$username')";
  $result = $conn->query($query);

  if (!$result) {
    die($conn->error);
  } else {
    $row = $result->fetch_array(MYSQLI_NUM);
    $result->close();

    if ($row[0]) {
      echo "username already taken";
    } else {
    //For extra security, we salt and pepper our passwords
      $salt   = "qm&h*";
      $pepper = "pg!@";
      $encryptPW = hash('ripemd128', "$salt$password$pepper");
      $query = "INSERT INTO Users (display_name, username, password, role) Values ('$displayname', '$username', '$encryptPW', 'user')";
      $result = $conn->query($query);
      if (!$result) die($conn->error);

      $conn->close();
      
      ?> Click <a href='login.php'>Here</a> to Login <?php
    }
  }
} else {
?>
<html lang="en">

<head>
<title>Create Account</title>
<?php require_once 'includes.php' ?>
<style type="text/css">
.error {
  color:red;
}
</style>
</head>

<body>
<h2>Create Account</h2>
<form method="post">
  <table>
    <tr>
      <td>Display Name</td>
      <td><input type="text" name="displayname"/></td>
    <tr>
      <td>Username</td>
      <td><input type="text" name="username"/></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input type="password" name="password"/></td>
    </tr>
  </table>
  <input type="submit"/>
</form>
<?php
if (isset($_SESSION['error'])) { 
  echo '<p class="error">' . $_SESSION['error'] . "</p>";
  unset($_SESSION['error']);
}
?>
</body>
</html>

<?php
}
?>

<?php

function validate($data) {
  return htmlspecialchars(stripslashes(trim($data)));
}

?>