<?php
require_once 'loginStatus.php';
require_once '../database/db_info.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$id = $_SESSION['id'];

if($_GET){
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

if($_POST){
    if($_POST['vidurl']){
        $url = validate($_POST['vidurl']);
        $query = "SELECT * FROM Videos WHERE url='$url'";
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
                $query = "INSERT INTO Videos (vid,url) Values (null,'$url')";
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
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile</title>
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
            
            //$id = $_SESSION['id'];
            $query = "SELECT * FROM VideoFeed WHERE userID='$id'";
            $result = $conn->query($query);
            if (!$result) {
                die($conn->error);
            } else {
                $rows = $result->num_rows;
                if ($rows) {
                    for ($i = 0; $i < $rows; ++$i) {
                        $result->data_seek($i);
                        $videoID = $result->fetch_assoc()['videoID'];
                        $query = "SELECT * FROM Videos WHERE vid='$videoID'";
                        $result2 = $conn->query($query);
                        if (!$result2) {
                            die($conn->error);
                        } else {
                            $rows2 = $result2->num_rows;
                            if ($rows2) {
                                for ($j = 0; $j < $rows2; ++$j) {
                                    $result2->data_seek($j);
                                    $url=$result2->fetch_assoc()['url'];
                                }
                                echo '<div class="videoWrapper"> <iframe width="420" height="315"
                                    src="https://www.youtube.com/embed/'.$url;
                                echo'" frameborder="0" allowfullscreen></iframe>';
                                echo "<form method=\"post\"><input type='hidden' name='deleteID' value='$videoID'/>";
                                echo "<input type='submit' value='Delete'/></form></div>";
                            }
                            
                        }
                        $result2->close();
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
