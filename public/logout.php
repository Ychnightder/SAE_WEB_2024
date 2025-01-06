<?php
session_start();
unset($_SESSION["userCurrent"]);
session_unset();
session_destroy();
header('Location:   index.php');
exit();