<?php
require_once 'loginStatus.php';
require_once '../database/db_info.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$id = $_SESSION['id'];
$display_name = $_SESSION['displayName'];
$username = "";

if($_POST){
    if($_POST['vidurl']){
        $url = validate($_POST['vidurl']);
        $query = "SELECT * FROM Videos WHERE youtubeID='$url'";
        $result = $conn->query($query);
        if (!$result) {
            die($conn->error);
        } else {
           $rows = $result->num_rows;
            if ($rows) {
                //video already exist link it to id in Videofeed
                $result->data_seek(0);
                $videoID = $result->fetch_assoc()['vid'];
                $query = "SELECT EXISTS(SELECT 1 FROM VideoFeed WHERE userID='$id' AND videoID='$videoID')";
                $result2 = $conn->query($query);
                if (!$result2) {
                    die($conn->error);
                } else {
                    $row = $result2->fetch_array(MYSQLI_NUM);
                    $result2->close();
                    if (!$row[0]) {
                        $query = "INSERT INTO VideoFeed (userID,videoID) Values ($id, $videoID)";
                        $result3 = $conn->query($query);
                        if (!$result3) {die($conn->error);}
                    }
                }

                //$result2->close();
            }
            else {
                //put video in Videos
                $query = "INSERT INTO Videos (vid,youtubeID) Values (null,'$url')";
                $result2 = $conn->query($query);
                $insertid = $conn->insert_id;
                if (!$result2) {die($conn->error);}
                //put video in Videofeed
                $query = "INSERT INTO VideoFeed (userID,videoID) Values ($id, $insertid)";
                $result3 = $conn->query($query);
                if (!$result) {die($conn->error);}
//                $result2->close();
//                $result3->close();
            }
        }
        $result->close();
   }
} else if($_GET){
    if($_GET['profID']){
        $profID=validate($_GET['profID']);
        $id=$profID;
        $query = "SELECT display_name, username FROM Users WHERE id='$id'";
        $result = $conn->query($query);
        if (!$result) {
            die($conn->error);
        } else {
           $rows = $result->num_rows;
            if ($rows) {
                $result->data_seek(0);
                $display_name = $result->fetch_assoc()['display_name'];
                $result->data_seek(0);
                $username = $result->fetch_assoc()['username'];
            }
            $result->close();
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile</title>
    <?php require_once 'includes.php' ?>
    <style>
        #vidList {
            text-align:center;
        }
        .videoWrapper {
            position: relative;
            padding-top: 25px;
        }
    </style>
</head>
<body>
    <?php require_once 'navBar.php' ?>
    <?php
        if ($id == $_SESSION['id']){
             echo 
             "Here is your profile, ".$_SESSION['displayName']."<br>"
            ."<form method=\"post\">"
            ."<table>"
              ."<tr>"
                ."<td><input type=\"text\" name=\"vidurl\"/></td>"
                ."<td>Add Video ID from Youtube</td>"
                ."</tr>"
            ."</table>"
            ."<input type=\"submit\"/>"
            ."</form>"
            ."<div id=\"vidList\">";
        }
        else{
            echo "<center><h4> Welcome to ".$display_name." (".$username.")'s profile</h4></center> <div id=\"vidList\">";
        }
        $BASE_URL = "https://www.youtube.com/embed/";
        //orders by most recent
        $query = "SELECT youtubeID,vid FROM Videos, VideoFeed WHERE userID='$id' AND Videos.vid=VideoFeed.videoID ORDER BY datetime desc";
        $result = $conn->query($query);
        if (!$result) {
            die($conn->error);
        } else {
            $rows = $result->num_rows;
            if ($rows) {
                for ($i = 0; $i < $rows; ++$i) {
                    $result->data_seek($i);
                    $youtubeID = $result->fetch_assoc()['youtubeID'];
                    $result->data_seek($i);
                    $videoID=$result->fetch_assoc()['vid'];
                    $url = $BASE_URL . $youtubeID;
                    echo "<div class='videoWrapper'>";
                    echo "<iframe width='420' height='315' src='$url' frameborder='0' allowfullscreen></iframe>";
                    if($_SESSION['id']==$id){
                        echo "<form method=\"post\"><input type='hidden' name='deleteID' value='$videoID'/>";
                        echo "<input type='submit' value='Delete'/></form>";
                    }
                    echo "</div>";
                }
            }
        }
        $result->close();
        $conn->close();
    ?>
            
    </div>
    </body>

<?php
function validate($data) {
  return htmlspecialchars(stripslashes(trim($data)));
}
?>
