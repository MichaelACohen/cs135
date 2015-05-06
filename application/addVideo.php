<?php
require_once 'loginStatus.php';
require_once '../database/db_info.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
$id = $_SESSION['id'];
$error = "";
//add videos to user profile
if ($_POST) {
    if (isset($_POST['youtubeID'])) {
            $youtubeID = $_POST['youtubeID'];
            if (validYoutubeID($youtubeID)) {
                //look to see if video already is in database
                $query="SELECT vid FROM Videos WHERE youtubeID='$youtubeID'";
                $result=$conn->query($query);
                if (!$result) die($conn->error);
                $result->data_seek(0);
                $vid = $result->fetch_assoc()['vid'];
                if($vid == null){
                //if not already there, add it.
                    $query = "INSERT INTO Videos (youtubeID) VALUES ('$youtubeID')";
                    $conn->query($query);
                    $vid = $conn->insert_id;
                }
                //We do not want duplicate videos on a user's profile, so we look to see if it is there
                $query="SELECT videoID FROM VideoFeed WHERE userID='$id' AND videoID='$vid'";
                $result = $conn->query($query);
                if (!$result) die($conn->error);
                $rows=$result->num_rows;
                if(!$rows){
                //if it is not there, we can add it
                    $query = "INSERT INTO VideoFeed (userID, videoID) VALUES ('$id', '$vid')";
                    $result = $conn->query($query);
                    if (!$result) die($conn->error);
                    if(isset($_POST['hashtag'])){
                    //see if we need to add a new hashtag mapping
                        $hashtag=validate($_POST['hashtag']);
                        $query= "SELECT hid FROM Hashtags WHERE tag='$hashtag'";
                        $result=$conn->query($query);
                        if (!$result) die($conn->error);
                        $result->data_seek(0);
                        $hid = $result->fetch_assoc()['hid'];
                        //if it already exists, we pair the hashtag and the video
                        if($hid != null){   
                        $query= "INSERT INTO VideoHashtags (videoID, hashtagID) VALUES ('$vid','$hid')";
                        $result = $conn->query($query);
                        }
                        else{
                        //if the hashtag is not created, then make it and pair it with the video in VdeoHashtags
                            $query = "INSERT INTO Hashtags (tag) VALUES ('$hashtag')";
                            $result = $conn->query($query);
                            if (!$result) die($conn->error);
                            $hid = $conn->insert_id;
                            $query= "INSERT INTO VideoHashtags (videoID, hashtagID) VALUES ('$vid','$hid')";
                            $result = $conn->query($query);
                            if (!$result) die($conn->error);
                        }
                    }
                }     
            }else {
                $error = "Sorry, that is not a valid Youtube video ID.";
            }   
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Video</title>
    <?php require_once 'includes.php' ?>
    
    <style>
    <!--Make the website look uniform--->
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
            width: 40%;
            float:left;
            background-color:#F5F5F5; 
            height: 170px;     
        }
        #middle {
            width: 20%;
            float: left;
            background-color:#F5F5F5;
            height: 170px;
        }
        #right {
            width:40%;
            float:left;
            background-color:#F5F5F5;
            height: 170px;
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
                $('#left').height($('#middle').height());
                $('#right').height($('#middle').height());
            });
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

    <div id="top"> <h4>Add a youtube video to your profile below!</h4><br></div>
    <div id="left"> </div>
    <div id="middle">
    <?php
        //add new video option
        echo "<form class='form-inline' method='post'>";
        echo "<label for='videoIDinput'>New video</label><input style='margin-left:5px;' 
            class='form-control' type='text' id='videoIDinput' name='youtubeID' placeholder='Youtube video ID...'>";
        echo "<label for='hashtag'>Hashtag #</label><input style='margin-left:5px;' 
            class='form-control' type='text' id='hashtaginput' name='hashtag' placeholder='hashtagtext...'><br>";
        echo "<button type='submit' class='btn btn-default' method='post'>Add</button>";
        echo "</form>";
    ?>
    </div>
    <div id="right"></div>
   
    *Add the ID found at the end of the link to your youtube video
    (ex. the ID for https://www.youtube.com/watch?v=28TAdDu5L6U is 28TAdDu5L6U)
</body>


<?php
function validate($data) {
  return htmlspecialchars(stripslashes(trim($data)));
}

//returns whether the ID is actually a youtube video
function validYoutubeID($id){
    $id = trim($id);
    if (strlen($id) === 11){
        $file = @file_get_contents('http://gdata.youtube.com/feeds/api/videos/'.$id);
        return !!$file;
    }
    return false;
}

?>