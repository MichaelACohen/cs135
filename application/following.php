<?php
require_once 'loginStatus.php';

require_once '../database/db_info.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$id = $_SESSION['id'];
//this query should hopefully return the username and display name for 
//all the people that the current user is following
$query = "SELECT Users.display_name, Users.username FROM Follows, Users WHERE Follows.followerID = '$id' AND Users.id = Follows.followeeID";
$result = $conn->query($query);
if (!$result) die($conn->error);

$rows = $result->num_rows;
if ($rows) {
	for ($i = 0; $i < $rows; ++$i) {
		$result->data_seek($i);
		$display_name = $result->fetch_assoc()['display_name'];

		$result->data_seek($i);
		$username = $result->fetch_assoc()['username'];

		//display all the info in a table or something
} else {
	//you aren't following anyone
}

$result->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Following</title>
</head>
<body>
	<?php require_once 'navBar.php' ?>
</body>
</html>