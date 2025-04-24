<?php
session_start();
ob_start();

/* session_destroy(); */

/* $_SESSION['user_id'] = null;
$_SESSION['user_name'] = null;
$_SESSION['user_email'] = null; */

unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
unset($_SESSION['user_email']);

header("Location: ../index.php");
