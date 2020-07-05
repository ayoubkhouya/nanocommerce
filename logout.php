<?php
session_start();
unset($_SESSION['nanouser']);
unset($_SESSION['nanoadmin']);
header('location: index.php');
?>