<?php

$menu = array(
	'home' => array('text' => 'Home', 'url' => 'home.php'),
	'profile' => array('text' => 'My Profile', 'url' => '#'),
	'following' => array('text' => 'Following', 'url'=>'#'),
	'followers' => array('text' => 'Followers', 'url'=> '#')
);

function generateNavBar($items) {
	$html = "<nav class='navbar'>\n";
	foreach($items as $key => $item) {
		$html .= "<a href='{$item['url']}'>{$item['text']}</a>\n";
	}
	//$html .= "<span>Logged in as " . $_SESSION['username'] . "</span>";
	$html .= "</nav>";
	return $html;
}

echo generateNavBar($menu);

?>