<?php
require_once 'loginStatus.php';
require_once '../database/db_info.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
$id = $_GET ? ($_GET['profID'] ? $_GET['profID'] : $_SESSION['id']) : $_SESSION['id'];
$error = "";
if ($_POST) {
    //if comment
    if (isset($_POST['comment'])) {
        $comment = $_POST['comment'];
        $vid = $_POST['vid'];
        $commenter = $_SESSION['id'];
        $query = "INSERT INTO Comments (videoOwner, commenter, videoID, message) VALUES ('$id', '$commenter', '$vid', '$comment')";
        $result = $conn->query($query);
        if (!$result) die($conn->error);
    //if like
    } else if (isset($_POST['unlike'])) {
        //$like = 1 if like, 0 if unlike
        $like = !$_POST['unlike'];
        $vid = $_POST['id'];
        $liker = $_SESSION['id'];
        if ($like) {
            $query = "INSERT INTO Likes (videoOwner, liker, videoID) VALUES ('$id', '$liker', '$vid')";
            $result = $conn->query($query);
            if (!$result) die($conn->error);
        } else {
            $query = "DELETE FROM Likes WHERE videoOwner = '$id' AND liker = '$liker' AND videoID = '$vid'";
            $result = $conn->query($query);
        }
    } else if (isset($_POST['youtubeID'])) {
        $youtubeID = $_POST['youtubeID'];
        if (validYoutubeID($youtubeID)) {
            $query = "INSERT INTO VideoFeed (userID, videoID) VALUES ('$id', '$youtubeID')";
            $conn->query($query);
        } else {
            $error = "Sorry, that is not a valid Youtube video ID.";
        }
    }
}
$query = "SELECT * FROM Videos, VideoFeed WHERE Videos.vid=VideoFeed.videoID AND VideoFeed.userID='$id' ORDER BY VideoFeed.datetime desc";
$result = $conn->query($query);
if (!$result) die($conn->error);
//data structure to store information
//about the videos being displayed
//and their corresponding likes/comments
$videos = array();
$rows = $result->num_rows;
//for each video
for ($i = 0; $i < $rows; ++$i) {
    $result->data_seek($i);
    $vid = $result->fetch_assoc()['vid'];
    $result->data_seek($i);
    $youtubeID = $result->fetch_assoc()['youtubeID'];
    array_push($videos, array('vid' => $vid, 'yid' => $youtubeID));
    $likeQuery = "SELECT Users.display_name, Users.username, Likes.liker FROM Users, Likes WHERE Likes.videoOwner='$id' AND videoID='$vid' AND Likes.liker=Users.id";
    $result2 = $conn->query($likeQuery);
    if (!$result2) die($conn->error);
    $likes = array();
    $rows2 = $result2->num_rows;
    //for each like
    for ($j = 0; $j < $rows2; ++$j) {
        $result2->data_seek($j);
        $displayName = $result2->fetch_assoc()['display_name'];
        $result2->data_seek($j);
        $username = $result2->fetch_assoc()['username'];
        $result2->data_seek($j);
        $liker = $result2->fetch_assoc()['liker'];
        array_push($likes, array('id' => $liker, 'display_name' => $displayName, 'username' => $username));
    }
    $videos[$i]['likes'] = $likes;
    $commentQuery = "SELECT Users.display_name, Users.username, Comments.commenter, Comments.message FROM Users, Comments WHERE Comments.videoOwner='$id' AND videoID='$vid' AND Comments.commenter=Users.id ORDER BY Comments.datetime";
    $result3 = $conn->query($commentQuery);
    if (!$result3) die($conn->error);
    $comments = array();
    $rows3 = $result3->num_rows;
    //for each comment
    //MAKE SURE COMMENTER IS GETTING PROPER VALUE
    for ($k = 0; $k < $rows3; ++$k) {
        $result3->data_seek($k);
        $displayName = $result3->fetch_assoc()['display_name'];
        $result3->data_seek($k);
        $username = $result3->fetch_assoc()['username'];
        $result3->data_seek($k);
        $commenter = $result3->fetch_assoc()['commenter'];
        $result3->data_seek($k);
        $message = $result3->fetch_assoc()['message'];
        array_push($comments, array('id' => $commenter, 'display_name' => $displayName, 'username' => $username, 'message' => $message));
    }
    $videos[$i]['comments'] = $comments;    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile</title>
    <?php require_once 'includes.php' ?>
    <style>
        #header {
            width:100%;
            height:50px;
            top:0;
        }
        #top {
            width:100%;
            height: 50px;
            line-height:50px;
            text-align:center;
        }
        #top span {
            display: inline-block;
            vertical-align: middle;
            line-height: normal;
        }
        #left {
            width: 30%;
            float:left;
            background-color:#F5F5F5;      
        }
        #middle {
            width: 40%;
            float: left;
            background-color:#F5F5F5;
        }
        #right {
            width:30%;
            float:left;
            background-color:#F5F5F5;
        }
        .video {
            background-color:#E6E6FA;
        }
        .numLikes {
            margin-left:5px;
        }
        .comments {
            width: 100%;
            height: 150px;
            overflow:auto;
            margin-bottom: 20px;
        }
        .commentHeader {
            background-color:white;
        }
        .postComment {
            margin: 5px;
        }
        .commentText {
            width:100%;
        }
        #middle iframe {
            width: 100%;
            height: 315px;
            margin-bottom:-5px;
            /* to create a gap between video and comments: margin-bottom: 10px;*/
        }
        #error {
            color:red;
            margin-bottom:-10px;
        }
    </style>
    <script src="../javascripts/jquery.autoresize.js"></script>
    <script>
        $(function() {
            $(".commentText").each(function() {
                $(this).autoResize();
            });
        });
        $(document).ready(function() {
            $('#left').height($('#middle').height());
            $('#right').height($('#middle').height());
            //vertically-center text to left on video
            var height = $('#abc').height();
            $('#blah').css('margin-top', height/2);
        });
        function openWindow(names) {
            newWindow = window.open("", null, "height=200,width=400,status=yes,toolbar=no,menubar=no,location=no");
            newWindow.document.write("<h2>Likes</h2><ul>");
            for (var i = 0; i < names.length; i++) {
                newWindow.document.write("<li>" + names[i].display_name + " (" + names[i].username + ")</li>");
            }
            newWindow.document.write("</ul>");
        }
    </script>
</head>
<body>
    <div id="header">
    <?php require_once 'navBar.php' ?>
    </div>
    <div id="top">
        <?php
            if ($id != $_SESSION['id']) {
                $query = "SELECT display_name FROM Users WHERE id='$id'";
                $result = $conn->query($query);
                if (!$result) {
                    die($conn->error);
                } else if ($result->num_rows) {
                    $row = $result->fetch_array(MYSQLI_NUM);
                    echo "<span>Welcome to $row[0]'s profile page.</span>";
                }
                $result->close();
            } else {
                if (strlen($error)) {
                    echo "<script>$('#top').height('100px');</script>";
                    echo "<span id='error'>$error</span>";
                }
                echo "<form class='form-inline' method='post'>";
                echo "<div class='form-group'>";
                echo "<label for='videoIDinput'>New video</label><input style='margin-left:5px;' class='form-control' type='text' id='videoIDinput' name='youtubeID' placeholder='Youtube video ID...'>";
                echo "<button type='submit' class='btn btn-default' method='post'>Add</button>";
                echo "</div>";
                echo "</form>";
            }
        ?>
    </div>
    <div id="left"></div>
    <div id="middle">
        <?php
            foreach($videos as $index => $video) {
                displayVideo($index, $video);
            }
        ?>
    </div>
    <div id="right"></div>
</body>

<?php
function validate($data) {
  return htmlspecialchars(stripslashes(trim($data)));
}
function validYoutubeID($id){
    $id = trim($id);
    if (strlen($id) === 11){
        $file = @file_get_contents('http://gdata.youtube.com/feeds/api/videos/'.$id);
        return !!$file;
    }
    return false;
}
function displayVideo($index, $video) {
    $id = $_GET ? ($_GET['profID'] ? $_GET['profID'] : $_SESSION['id']) : $_SESSION['id'];
    $BASE_URL = "https://www.youtube.com/embed/";
    $url = $BASE_URL . $video['yid'];
    echo "<div class='video'>";
    
    echo "<iframe src='$url' frameborder='0' allowfullscreen></iframe>";
    
    $numLikes = sizeof($video['likes']);
    //determine whether the user liked the video already
    $getLikers = function($likeObj) {
        return $likeObj['id'];
    };
    $likers = array_map($getLikers, $video['likes']);
    $likedByUser = in_array($id, $likers);
    $likeButtonText = $likedByUser ? 'Unlike' : 'Like';
    //handle case where only 1 like
    $likes = $numLikes == 1 ? $numLikes . ' Like' : $numLikes . ' Likes';
    $names = array();
    for ($i = 0; $i < sizeof($video['likes']); ++$i) {
        array_push($names, array('display_name' => $video['likes'][$i]['display_name'], "username" => $video['likes'][$i]['username']));
    }
    $names = json_encode($names);
    //need this for the comment text things for some reason
    $idx = $index*2+1;
    echo "<div class='commentHeader'>";
    echo "<form style='display:inline-block;' id='form$index' method='post'>";
    echo "<a href='javascript:;' onclick='$(\"#form$index\").submit();'><span>$likeButtonText</span></a>";
    echo "<input type='hidden' name='unlike' value=$likedByUser>";
    echo "<input type='hidden' name='id' value='{$video['vid']}'>";
    echo "</form>";
    echo "<a class='numLikes' href='javascript:;' onclick='openWindow($names)'><span>$likes</span></a>";
    echo "<a style='float:right;' href='javascript:;' onclick='$(\".comments\")[$index].scrollTop = $(\".comments\")[$index].scrollHeight; $(\".commentText\")[$idx].focus();'><span>Comment</span></a>";
    echo "</div>";
    echo "<div class='comments'>";
    $numComments = sizeof($video['comments']);
    if ($numComments) {
        echo "<table class='table table-condensed'>";
        for ($i = 0; $i < $numComments; ++$i) {
            $display_name = $video['comments'][$i]['display_name'];
            $message = $video['comments'][$i]['message'];
            $commenter = $video['comments'][$i]['id'];
            echo "<tr><td><a href='profile3.php?profID=$commenter'><span>$display_name</span></td><td colspan='2'><span>$message</span></td></tr>";
        }
        echo "</table>";
    }
    echo "<div class='postComment'>";
    echo "<form style='display:inline-block;width:100%;margin:0;padding:0' id='commentForm$index' method='post'>";
    echo "<input type='hidden' name='vid' value='{$video['vid']}'></input>";
    echo "<textarea form='commentForm$index' name='comment' class='commentText' placeholder='Write a comment...'></textarea>";
    echo "<input style='float:right;' type='submit' value='Comment!'></input>";
    echo "</form>";
    echo "</div>";
    echo "</div>";    
    echo "</div>";
}
?>