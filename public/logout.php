<?php
$_SESSION['logged_in'] = false;
$_SESSION['role'] = null;
session_start();
session_unset();
session_destroy();
header('Location: index.php');
exit();

