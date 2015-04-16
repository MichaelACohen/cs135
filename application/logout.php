<?php 
session_start();
 
session_unset();
session_destroy();

echo "<center> You have successfully logged out. To sign in under a different account 
<a href='login.php'> Click Here </a></center>";
?>