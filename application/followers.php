<?php
require_once 'loginStatus.php';

require_once '../database/db_info.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$id = $_SESSION['id'];

//same thing as following.php except with people following the user


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Followers</title>
</head>
<body>
	<?php require_once 'navBar.php' ?>
    <?php
    $query = "SELECT Users.display_name, Users.username FROM Follows, Users WHERE Follows.followeeID = '$id' AND Users.id = Follows.followerID";
    $result = $conn->query($query);
    if (!$result) die($conn->error);

    $rows = $result->num_rows;
    if ($rows) {
        echo 'These are the people you are following!';
        echo '<ul>';
        for ($i = 0; $i < $rows; ++$i) {
			$result->data_seek($i);
			$display_name = $result->fetch_assoc()['display_name'];

			$result->data_seek($i);
			$username = $result->fetch_assoc()['username'];
            echo '<li>'.$display_name.' ('.$username.')'.'</li>';
            echo '</ul>';
		}
    } else {
    	//no followers
    	echo "no one likes you.";
    }
    $result->close();
    $conn->close();
    ?>
</body>
</html>