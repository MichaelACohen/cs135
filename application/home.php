<?php
require_once 'loginStatus.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home Page</title>
</head>
<body>
	<?php require_once 'navBar.php' ?>

	<h2>Home Page</h2>

	<p>Welcome to you home page <?php echo $_SESSION['displayName']; ?>. </p>
</body>
</html>