<?php
session_start();
$_SESSION['admin_login']=false;

include_once "../shared/connection.php";
include_once "../shared/functions.php";
$msg='';
if(isset($_POST['submit'])){
    $adminname=get_safe_value($conn, $_POST["username"]);
    $password=get_safe_value($conn, $_POST["password"]);

    $login_pass=md5($password);
    $res=mysqli_query($conn, "select * from admin_users where username='$adminname' and password='$login_pass'");
    $count=mysqli_num_rows($res);
    if($count==0){
        $msg="Please enter correct login details";
    }
    else{
        $row=mysqli_fetch_assoc($res);
        $_SESSION['admin_login']=true;
        $_SESSION['admin_id']=$row['id'];
        $_SESSION['admin_username']=$row['username'];
        $_SESSION['admin_type']=$row['usertype'];
        $_SESSION['admin_status']=$row['status'];
        header('location:categories.php');
        die;
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login |Supermart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../shared/flag-icon-min.css">
    <link rel="stylesheet" href="../shared/font-awesome.min.css">
    <link rel="stylesheet" href="../shared/style.css">
</head>
<body class="bg-secondary">
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-12 col-sm-7 m-auto">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-bold text-center text-bg-primary mx-0 py-2">Wellcome, Admin</h2>
                        <form action="" method="post">
                            <label for="">Username</label>
                            <input type="text" name="username" id="" class="form-control my-2" placeholder="Username" required>
                            <label for="">Password</label>
                            <input type="password" name="password" id="" class="form-control my-2" placeholder="Password" required>
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary px-5">Login</button>
                                <a href="#" class="nav-link pt-3 text-success">Don't have an account ? Sign in</a>
                            </div>
                        </form>
                        <div class="text-danger text-center mt-2"><?php echo $msg ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>