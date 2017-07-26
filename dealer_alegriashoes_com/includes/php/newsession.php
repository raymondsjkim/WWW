<?php

// Include the random string file
require 'includes/php/rand.php'; //../includes/

// Begin a new session
session_start();

// Set the session contents
$_SESSION['captcha_id'] = $str;

echo "newessions.php";
?>