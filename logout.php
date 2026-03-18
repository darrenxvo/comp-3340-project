<?php
// logout.php
session_start();
session_unset(); // Clears session variables
session_destroy(); // Kills the session
header("Location: index.php");
exit;
?>