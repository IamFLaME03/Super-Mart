<?php
include_once "../shared/connection.php";

unset($_SESSION['user_login']);
unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
header('location:../index.php');
die;

?>