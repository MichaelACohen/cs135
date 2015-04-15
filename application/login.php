<?php
require_once '../database/db_info.php';

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) die($conn->connect_error);

session_start();

if (isset($_SESSION['id'])) {
  //user is already logged in
  //redirect them to home page

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

    $salt      = "qm&h*";
    $pepper    = "pg!@";
    $encryptPW = hash('ripemd128', "$salt$password$pepper");

    if ($encryptPW == $row[3]) {
      $_SESSION['id']       = $row[0];

      //redirect to home page here
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

<style type="text/css">
.error {
  color:red;
}
</style>
</head>

<body>
<h2>Log In</h2>
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

function validate($data) {
  return htmlspecialchars(stripslashes(trim($data)));
}

?>