<?php
require_once 'loginStatus.php';
require_once '../database/db_info.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$id = $_SESSION['id'];
//this query should hopefully return the username and display name for 
//all the people that the current user is following

//add followers
if($_POST){
    if($_POST['toFollow']){
        $followee = validate($_POST['toFollow']);
        $query = "SELECT id from Users WHERE username='$followee'";
        $result = $conn->query($query);
        if (!$result) die($conn->error);

        $rows = $result->num_rows;
        if ($rows) {
            for ($i = 0; $i < $rows; ++$i) {
                    $result->data_seek($i);
                    $followeeID = $result->fetch_assoc()['id'];
            }
        }
        $query = "INSERT into Follows(followerID,followeeID) VALUES ('$id','$followeeID')";
        $conn->query($query);
        if (!$result) die($conn->error);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
        <title>Following</title>
</head>
<body>
	<?php require_once 'navBar.php' ?>
                
        <?php 
        $query = "SELECT Users.display_name, Users.username FROM Follows, Users WHERE Follows.followerID = '$id' AND Users.id = Follows.followeeID";
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
		//display all the info in a table or something
                echo '<li>'.$display_name.' ('.$username.')'.'</li>';
            }	
            echo '</ul>';
        } else {
            echo 'You are not following anyone!';
        }

$result->close();
$conn->close();
     
?>
        <form method="post">
            <table>
                <tr>
                <td><input type="text" name="toFollow"/></td>
                <td>Username of person you want to follow</td>
                </tr>
            </table>
            <input type="submit"/>
        </form>

</body>
</html>


<?php

function validate($data) {
  return htmlspecialchars(stripslashes(trim($data)));
}

?>