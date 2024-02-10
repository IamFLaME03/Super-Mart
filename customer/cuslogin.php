<?php 
include_once "../shared/connection.php";
include_once "../shared/functions.php";
$cat_res=mysqli_query($conn, "select * from categories where status=1");
$cat_arr=array();
while($row=mysqli_fetch_assoc($cat_res)){
    $cat_arr[]=$row;
}



$msg='';
session_start();
$_SESSION['userlogin']=false;
if(isset($_POST['submit'])){

    $uemail=$_POST['uemail'];
    $upass=$_POST['pass'];

    $login_pass=md5($upass);
    $result=mysqli_query($conn,"select * from users where uemail='$uemail' and upassword='$login_pass'");
    $row_count=mysqli_num_rows($result);
    if($row_count==0){
        $msg="invalid credentails";
    }else{
        $row=mysqli_fetch_assoc($result);

        $_SESSION['userlogin']=true;
        $_SESSION['userid']=$row['id'];
        $_SESSION['username']=$row['uname'];
        $_SESSION['useremail']=$row['uemail'];
        header("location:index.php");
    }
}
?>    
<!-- top -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login|SuperMart|Elecrtronic,fashion,sports,books available </title>
    <link rel="stylesheet" href="../shared/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>

    <!-- navbar -->
    <div class="d-flex justify-content-between">
    <p class="fs-6 fw-bold mb-0 py-1 px-0 px-md-2 bg-warning" style="color: #130f40;">WELCOME TO SUPERMART</p>
        <div class="icons mx-2">
           
            <a class="text-decoration-none fw-bold" href="cusregister.php"><img src=" ../img/windo/register.png" alt="">Register</a>
            <a class="text-decoration-none fw-bold" href="../vendor/vendorlogin.php"><img src=" ../img/windo/register.png" alt="">Become a seller</a>
        </div>
    </div>
    
    <!-- navbar2 -->
    <nav class="navbar navbar-expand-lg" id="navbar">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.html" id="logo"><span id="span1">S</span>uper <span>Mart</span></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span><img src=" ./img/windo/menu.png" alt="" width="30px"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
              </li>

             
            <?php
                foreach($cat_arr as $list){?>
                    <li class="nav-item">
                        <a class="nav-link" href="../categories.php?id=<?php echo $list['id'] ?>" > <?php echo $list['categories'] ?></a>
                    </li>
                    <?php
                }?>

              <li class="nav-item">
                <a class="nav-link" href="../contact.php">Contact Us</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="../vendor/vendorlogin.php">Become a seller</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
<!-- top end -->

<div class="container" id="login">
    <div class="row">
        <div class="col-md-5 py-3 py-md-0" id="side1">
            <h3 class="text-center text-warning fw-bold">Welcome Back!</h3>
        </div>
        <div class="col-md-7 py-3 py-md-0 bg-white border-2" id="side2">
            <form method="post">
            <h3 class="text-center text-warning fw-bold">Account login</h3>
            <div class="input2 text-center">
            <input type=" email" name="uemail" placeholder="Email" class="my-4" required>
            <input type="password" name="pass" placeholder="Password" class="mt-3" required>
        </div>
        <!-- <a class="text-decoration-none ms-5 ps-5" href="cus_changepassword.php">Forgot Password?</a> -->
            <div class="text-center mt-3">
                <button type="submit" name="submit" class="text-white btn btn-warning">Login</button>
            </div>
            <p class="text-center fw-bold mt-3">Don't have an Acoount?<a href="cusregister.php">Click Here</a></p>
            </form>
            <div class="text-center text-danger"><?php echo $msg; ?></div>
        </div>
    </div>
</div>


<?php
    include_once "footer.php"
?>

    