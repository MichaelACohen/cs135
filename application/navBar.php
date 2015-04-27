<?php

$menu = array(
	'home' => array('text' => 'Home', 'url' => 'home.php'),
	'profile' => array('text' => 'My Profile', 'url' => 'profile.php'),
	'following' => array('text' => 'Following', 'url'=>'following.php'),
	'followers' => array('text' => 'Followers', 'url'=> 'followers.php'),
	'logout' => array('text' => 'Log Out', 'url' => 'logout.php')
);

$curURL = $_SERVER['PHP_SELF'];

?>
<style>
	.selected {
		background-color:black;
	}
	.selected:hover {
		background-color:black !important;
	}
</style>

<nav class="navbar navbar-default" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <?php
      	$selected = (isset($curURL) && strpos($curURL, $menu['home']['url'])) ? 'selected' : null;
      	echo "<a class='navbar-brand {$selected}' href='{$menu['home']['url']}'>{$menu['home']['text']}</a>";
      ?>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
      	<?php
      		foreach($menu as $key => $val) {
      			if ($key != 'home' && $key != 'logout') {
      				$selected  = (isset($curURL) && strpos($curURL, $val['url'])) ? 'selected' : null;
					echo "<li><a href='{$val['url']}' class='{$selected}'>{$val['text']}</a></li>";
      			}
      		}
      	?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><p class="navbar-text">Logged in as <?php echo $_SESSION['displayName']; ?></p></li>
        <?php
        	$selected = (isset($curURL) && strpos($curURL, $menu['logout']['url'])) ? 'selected' : null;
        	echo "<li><a href='{$menu['logout']['url']}'>Logout</a></li>"
        ?>
      </ul>
    </div>
  </div>
</nav>