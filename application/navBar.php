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
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<?php
				$id = $_SESSION['id'];
				foreach($menu as $key => $val) {
					if ($key != 'logout') {
						$selected  = (isset($curURL) && strpos($curURL, $val['url']) && (isset($_GET['profID']) ? ($id == $_GET['profID'] ? true : false) : true)) ? 'active' : null;
						echo "<li class='{$selected}'><a href='{$val['url']}'>{$val['text']}</a></li>";
					}
				}
				?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><p class="navbar-text">Logged in as <?php echo $_SESSION['displayName']; ?></p></li>
				<?php
				echo "<li><a href='{$menu['logout']['url']}'>Logout</a></li>"
				?>
			</ul>
		</div>
	</div>
</nav>