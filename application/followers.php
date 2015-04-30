<?php
require_once 'loginStatus.php';

require_once '../database/db_info.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$id = $_SESSION['id'];

//same thing as following.php except with people following the user

//Deals with POST data that allows you to follow back
if($_POST){
    if(isset($_POST['tofollowID'])){
        if($_POST['tofollowID']){
            $followeeID = validate($_POST['tofollowID']);
            $query = "INSERT into Follows(followerID,followeeID) VALUES ('$id','$followeeID')";
            $result=$conn->query($query);
            if (!$result) die($conn->error);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Followers</title>
    <?php require_once 'includes.php' ?>
</head>
<body>
    <?php require_once 'navBar.php' ?>
    <?php
    //Find followers of you
    $query = "SELECT Users.display_name, Users.username, Users.id FROM Follows, Users WHERE Follows.followeeID = '$id' AND Users.id = Follows.followerID";
    $result = $conn->query($query);
    if (!$result) die($conn->error);

    $rows = $result->num_rows;
    echo "<div style='margin-left:10px;'>";
    if ($rows) {
        $msg = $rows == 1 ? 'This is the 1 person following you!' : 'These are the ' . $rows . ' people following you!';
        echo '<p>'.$msg.'</p>';
        echo '<table style="border-collapse:separate;border-spacing:10px 10px;">';
        for ($i = 0; $i < $rows; ++$i) {
			$result->data_seek($i);
			$display_name = $result->fetch_assoc()['display_name'];
			$result->data_seek($i);
			$username = $result->fetch_assoc()['username'];
            $result->data_seek($i);
			$followerID = $result->fetch_assoc()['id'];
            echo '<tr><td><a href=\'profile.php?profID='.$followerID.'\'>'.$display_name.' ('.$username.')'.'</a></td>';
            
            //Look to see if you are following them back
            $query = "SELECT EXISTS(SELECT 1 FROM Follows WHERE followerID='$id' AND followeeID='$followerID')";
            $result2 = $conn->query($query);
            if (!$result2) {
                die($conn->error);
            } else {
                //if you aren't create a button that lets you
                $row = $result2->fetch_array(MYSQLI_NUM);
                $result2->close();
                if (!$row[0]) {
                    echo "<form method=\"post\"><input type='hidden' name='tofollowID' value='$followerID'/>";
                    echo "<td><button type='submit' class='btn btn-default'>Follow Back</button></td></form>";
                }
                echo "</tr>";
            }
        }
        echo '</table>';
    }
    else {
        //no followers
        echo "You have no followers.";
    }
    echo "</div>";
    $result->close();
    $conn->close();
    ?>
</body>
</html>

<?php

function validate($data) {
  return htmlspecialchars(stripslashes(trim($data)));
}

?>