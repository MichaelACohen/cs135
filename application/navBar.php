<?php

$menu = array(
	'home' => array('text' => 'Home', 'url' => 'home.php'),
	'profile' => array('text' => 'My Profile', 'url' => 'profile.php'),
	'following' => array('text' => 'Following', 'url'=>'following.php'),
	'followers' => array('text' => 'Followers', 'url'=> 'followers.php'),
	'logout' => array('text' => 'Log Out', 'url' => 'logout.php')
);

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

?>