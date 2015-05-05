<?php
require_once 'loginStatus.php';
require_once '../database/db_info.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
$id = $_SESSION['id'];
?>

<?php

//add videos from home page to profile pafe
if($_POST){
    if(isset($_POST['addID'])){
        $videoID = validate($_POST['addID']);
        $query = "SELECT EXISTS(SELECT 1 FROM VideoFeed WHERE userID='$id' AND videoID='$videoID')";
        $resulta = $conn->query($query);
        if (!$resulta) {die($conn->error);}
        else{
            $resulta->data_seek(0);
            $exists = $resulta->fetch_assoc();
            if($exists){
                $query = "INSERT INTO VideoFeed (userID,videoID) Values ($id, $videoID)";
                $resulta = $conn->query($query);
            }
        }
    }
       //ASK MICHAEL $resulta->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page</title>
    <?php require_once 'includes.php' ?>
    <style>
        #header {
            width:100%;
            height:50px;
            top:0;
        }
        #top {
            width:100%;
            height: 10px;
        }
        #left {
            width: 5%;
            float:left;
            text-align:center;
            background-color:#F5F5F5;      
        }
        #middle {
            width: 90%;
            float: left;
            background-color:#F5F5F5;
        }
        #right {
            width:5%;
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
	<?php require_once 'navBar.php' ?>
        
	<h2>Home Page</h2>
	<p>Welcome to your home page, <?php echo $_SESSION['displayName']; ?>. </p>
    <center>
    <form class='form-inline' method='post'>
        <div class='form-group'>
            <input class='form-control' type='text' name='hashtag' placeholder='Filter by hashtag'>
            <button type='submit' class='btn btn-default'>Search</button>
        </div>
    </form>
    </center>
        <div id="left"></div>
        <div id="middle">
                <center>
                <table class="table table-bordered">
                <?php
<<<<<<< HEAD
                    // select youtube id where you follow the users who have the video in their feed
                    $query = "SELECT DISTINCT Videos.youtubeID, VideoFeed.datetime, Videos.vid, Users.display_name, Follows.followeeID 
                    FROM Videos, VideoFeed, Follows, Users 
                    WHERE Follows.followerID=$id AND VideoFeed.userID=Follows.followeeID 
                    AND Videos.vid=VideoFeed.videoID AND Follows.followeeID=Users.id 
                    ORDER BY VideoFeed.datetime DESC";
=======
                    if ($_POST && isset($_POST['hashtag'])) {
                        $tag = $_POST['hashtag'];
                        $hashtagQuery = "SELECT hid FROM Hashtags WHERE tag='$tag'";
                        $hashtagResult = $conn->query($hashtagQuery);
                        $row = $hashtagResult->fetch_array(MYSQLI_NUM);
                        $hid = $row[0];
                        $hashtagResult->close();
                        $query = "SELECT DISTINCT Videos.youtubeID, VideoFeed.datetime, Videos.vid, Users.display_name, Follows.followeeID
                        FROM Videos, VideoFeed, VideoHashtags, Follows, Users
                        WHERE Follows.followerID=$id AND VideoFeed.userID=Follows.followeeID
                        AND Videos.vid=VideoFeed.videoID AND Follows.followeeID=Users.id AND
                        VideoHashtags.videoID=Videos.vid AND VideoHashtags.hashtagID='$hid'
                        ORDER BY VideoFeed.datetime DESC";
                    } else {
                        $query = "SELECT DISTINCT Videos.youtubeID, VideoFeed.datetime, Videos.vid, Users.display_name, Follows.followeeID 
                        FROM Videos, VideoFeed, Follows, Users
                        WHERE Follows.followerID=$id AND VideoFeed.userID=Follows.followeeID
                        AND Videos.vid=VideoFeed.videoID AND Follows.followeeID=Users.id
                        ORDER BY VideoFeed.datetime DESC";
                    }
>>>>>>> bce5c9ba7f6466f4d515e797f1300da9243f6ab9
                    $result = $conn->query($query);
                    if (!$result) die($conn->error);
                    $rows = $result->num_rows;
                    if ($rows) {
                        for ($i = 0; $i < 9 && $i < $rows; ++$i) {
                            if($i%3==0){echo "<tr>";}
                            $result->data_seek($i);
                            $videoURL = $result->fetch_assoc()['youtubeID'];
                            $result->data_seek($i);
                            $videoID = $result->fetch_assoc()['vid'];
                            $result->data_seek($i);
                            $display_name = $result->fetch_assoc()['display_name'];
                            $result->data_seek($i);
                            $followeeID = $result->fetch_assoc()['followeeID'];
                            $result->data_seek($i);
                            $datetime = $result->fetch_assoc()['datetime'];
                            //video display
                            echo "<th>Posted by <a href='profile.php?profID=".$followeeID."'>".$display_name."</a>";
                            echo "<right><form method=\"post\" style=\"display:inline; float:right;\"><input type='hidden' name='addID' value='$videoID'/>";
                            echo "<input type='submit' value='Add Video'/></form>";
                            echo"<iframe src='https://www.youtube.com/embed/".$videoURL."'frameborder='0' allowfullscreen></iframe>";
                            echo "Posted on ".$datetime."</th></right>";
                            if($i%3==2){echo "</tr>";}
                        }
                    }
                    $result->close();
                    $conn->close();
                    ?>
                </table>
                </center>
                </div>
                <div id="right"></div>
        
</body>
</html>

<?php
function validate($data) {
  return htmlspecialchars(stripslashes(trim($data)));
}
