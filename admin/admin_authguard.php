<?php
if(!isset($_SESSION['admin_login'])){
        echo "Illegal attempt";
        header("location:adminlogin.php");
        die;
    }
    if($_SESSION['admin_login']==false)
    {
        header("location:adminlogin.php");
        die;
    }
    $adminname=$_SESSION['admin_username'];
    $admintype=$_SESSION['admin_type'];
    $adminstatus=$_SESSION['admin_status'];

    ?>
    