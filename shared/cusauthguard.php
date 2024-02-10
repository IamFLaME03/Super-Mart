<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .auth-parent
        {
            display:flex;
            justify-content:space-around;
        }
    </style>
</head>
<body>
    
</body>
</html>
<?php
    session_start();
    if(!isset($_SESSION['userlogin']))
    {
        header('location:../customer/cuslogin.php');
        die;
    }
    if($_SESSION['userlogin']==false)
    {
        header('location:../customer/cuslogin.php');
        die;
    }

    $userid=$_SESSION['userid'];
    $username=$_SESSION['username'];
    $useremail=$_SESSION['useremail'];
    // echo "<div class='auth-parent'>
    //     <div>$userid</div>
    //     <div>$username</div>
    //     <div>$useremail</div>
    //     </div>";

?>