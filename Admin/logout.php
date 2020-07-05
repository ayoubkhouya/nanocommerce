<?php
session_start();
session_unset($_SESSION['nanoadmin']);
session_destroy();
header('location: login.php');
?>