<?php
require_once 'loginStatus.php';
require_once '../database/db_info.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$id = $_SESSION['id'];

if($_POST){
    if($_POST['vidurl']){
        $url = validate($_POST['vidurl']);
        $query = "SELECT EXISTS(SELECT 1 FROM Videos WHERE url='$url')";
        $result = $conn->query($query);
        if (!$result) {
            die($conn->error);
        } else {
            $row = $result->fetch_array(MYSQLI_NUM);
            $result->close();

            if ($row[0]) {
            //video already exist link it to id in Videofeed
            
            } else {
            //put video in Videos
            //put video in Videofeed
            }
        }
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
    Here is your profile, <?php echo $_SESSION['displayName'];?>. <br>

    <form method="post">
        <table>
            <tr>
            <td><input type="text" name="vidurl"/></td>
            <td>Add Video URL</td>
            </tr>
        </table>
        <input type="submit"/>
    </form>
    <div id="vidList">
        <div class="videoWrapper">
            <iframe width="420" height="315"
           src="https://www.youtube.com/embed/3aF-ANf4KY8" frameborder="0" allowfullscreen>
            </iframe>
        </div>
        <div class="videoWrapper">
            <iframe width="420" height="315"
           src="https://www.youtube.com/embed/B38wu7wxGjg" frameborder="0" allowfullscreen>
            </iframe>
        </div>
        <?php
            $id = $_SESSION['id'];
            $query = "SELECT * FROM VideoFeed WHERE userID='$id'";
            $result = $conn->query($query);
            if (!$result) {
                die($conn->error);
            } else {
                $rows = $result->num_rows;
                if ($rows) {
                    for ($i = 0; $i < $rows; ++$i) {
                        $result->data_seek($i);
                        $url = $result->fetch_assoc()['url'];
                        echo '<iframe width="420" height="315"
                        src=$id frameborder="0" allowfullscreen></iframe>';
                    }
                }
                $result->close();
                $conn->close();
            }
        ?>
    </div>
</body>

<?php
function validate($data) {
  return htmlspecialchars(stripslashes(trim($data)));
}
?>
