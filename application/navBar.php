<?php

$menu = array(
	'home' => array('text' => 'Home', 'url' => 'home.php'),
	'profile' => array('text' => 'My Profile', 'url' => 'profile.php'),
	'following' => array('text' => 'Following', 'url'=>'following.php'),
	'followers' => array('text' => 'Followers', 'url'=> 'followers.php'),
	'logout' => array('text' => 'Log Out', 'url' => 'logout.php')
);

/*
function generateNavBar($items) {
	$html = "<nav class='navbar'>\n";
	foreach($items as $key => $item) {
		$html .= "<a href='{$item['url']}'>{$item['text']}</a>\n";
	}
	$html .= "<span style='float:right'>Logged in as " . $_SESSION['displayName'] . "</span>";
	$html .= "</nav>";
	return $html;
}

echo generateNavBar($menu);
*/

?>

<nav class="navbar navbar-default" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href=<?php echo "{$menu['home']['url']}"?>><?php echo "{$menu['home']['text']}" ?></a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
          <li><a href=<?php echo "{$menu['profile']['url']}"?>><?php echo "{$menu['profile']['text']}"?></a></li>
          <li><a href=<?php echo "{$menu['following']['url']}"?>><?php echo "{$menu['following']['text']}"?></a></li>
          <li><a href=<?php echo "{$menu['followers']['url']}"?>><?php echo "{$menu['followers']['text']}"?></a></li>
          <li><a href=<?php echo "{$menu['logout']['url']}"?>><?php echo "{$menu['logout']['text']}"?></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><p class="navbar-text">Logged in as <?php echo $_SESSION['displayName']; ?></p></li>
      </ul>
    </div>
  </div>
</nav>