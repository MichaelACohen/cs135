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
    if(isset($_POST['toFollow'])){
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
    if(isset($_POST['unfollowID'])){
        if($_POST['unfollowID']){
            $unfollowID = validate($_POST['unfollowID']);
            $query = "DELETE FROM Follows WHERE followeeID='$unfollowID' AND followerID='$id'";
            $conn->query($query);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Following</title>
    <?php require_once 'includes.php' ?>
</head>
<body>
	<?php require_once 'navBar.php' ?>           
    <?php 
        $query = "SELECT Users.display_name, Users.id ,Users.username FROM Follows, Users WHERE Follows.followerID = '$id' AND Users.id = Follows.followeeID";
        $result = $conn->query($query);
        if (!$result) die($conn->error);

        $rows = $result->num_rows;
        echo '<div style=\'margin-left:10px;>\'';
        if ($rows) {
            $msg = $rows == 1 ? 'This is the 1 person you are following!' : 'These are the ' . $rows . ' people you are following!';
            echo '<p>'.$msg.'</p>';
            echo '<table style=\'border-collapse:separate;border-spacing:10px 10px;\'>';
            for ($i = 0; $i < $rows; ++$i) {
        		$result->data_seek($i);
        		$display_name = $result->fetch_assoc()['display_name'];

        		$result->data_seek($i);
        		$username = $result->fetch_assoc()['username'];
                $result->data_seek($i);
                $followeeID=$result->fetch_assoc()['id'];
                //display all the info in a table or something
                echo '<tr><td><a href=\'profile.php?profID='.$followeeID.'\'>'.$display_name.'</a>('.$username.')</td>';
                echo "<form method='post'><input type='hidden' name='unfollowID' value='$followeeID'>";
                echo '<td><button class=\'btn btn-default\' type=\'submit\'>Unfollow</button></td></form></tr>';
            }
            echo '</table>';
        } else {
            echo 'You are not following anyone!';
        }
        echo '</div>';

$result->close();
$conn->close();
     
?>
        <form style="margin:5px;" method="post" >
            <table style="border-collapse:separate;border-spacing:10px 10px;">
                <div class='form-group' style='display:inline-block;'>
                    <tr>
                        <td style='display:inline-block;margin-top:5px;'>Enter username of user to follow:</td>
                        <td><div class='form-group'><input name='toFollow' class='form-control'></div></td>
                        <td><div class='form-group'><button type='submit' class='btn btn-default' method='post'>Follow</button></div></td>
                    </tr>
                </div>
            </table>
        </form>

</body>
</html>


<?php

function validate($data) {
  return htmlspecialchars(stripslashes(trim($data)));
}

?>