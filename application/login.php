<?php
require_once '../database/db_info.php';

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) die($conn->connect_error);

session_start();

if (isset($_SESSION['id'])) {
  redirectToHome();

} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = validate($_POST["username"]);
  $password = validate($_POST["password"]);

  require_once '../database/db_info.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  $query = "SELECT * FROM Users WHERE username='$username'";
  $result = $conn->query($query);

  if (!$result) {
    die($conn->error);
  } else if ($result->num_rows) {
    $row = $result->fetch_array(MYSQLI_NUM);
    $result->close();
    //extra security in salt and peppering our passwords
    $salt      = "qm&h*";
    $pepper    = "pg!@";
    $encryptPW = hash('ripemd128', "$salt$password$pepper");

    if ($encryptPW == $row[3]) {
      $_SESSION['id'] = $row[0];
      $_SESSION['displayName'] = $row[1];

      redirectToHome();
    } else {
      $_SESSION['error'] = 'Incorrect username/password combination';
      header('Location: ' . $_SERVER['PHP_SELF']);
    }
  } else {
    $_SESSION['error'] = 'Incorrect username/password combination';
    header('Location: ' . $_SERVER['PHP_SELF']);
  }
} else {

?>
<html lang="en">

<head>
<title>Log In</title>
<?php require_once 'includes.php' ?>
<style type="text/css">
.error {
  color:red;
}
</style>
</head>

<body>
<h2>Log In (or <a href='createAccount.php'> create account</a>)</h2>
<form method="post">
  <table>
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

function redirectToHome() {
  $path = str_replace('login.php', 'home.php', $_SERVER['PHP_SELF']);
  header('Location: ' . $path);
}

function validate($data) {
  return htmlspecialchars(stripslashes(trim($data)));
}

?>