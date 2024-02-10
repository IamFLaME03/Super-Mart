<?php
include_once "../shared/connection.php";
include_once "../shared/functions.php";
$cat_res=mysqli_query($conn, "select * from categories where status=1");
$cat_arr=array();
while($row=mysqli_fetch_assoc($cat_res)){
    $cat_arr[]=$row;
}


$msg='';
$result='';
if(isset($_POST['submit'])){
    $uname=get_safe_value($conn,$_POST['uname']);
    $uemail=get_safe_value($conn,$_POST['uemail']);
    $umobile=get_safe_value($conn,$_POST['umobile']);
    $pass1=get_safe_value($conn,$_POST['pass1']);
    $pass2=get_safe_value($conn,$_POST['pass2']);
    
//check validation
    if (strlen($uname)<3 || strlen($uname)>20) {
        $msg="Username must be between 3 to 20 Characters";
    }elseif($pass1 != $pass2){
        $msg="Password and confirm-password does not matched";
    }elseif (strlen($pass1)<4) {
        $msg="Password must be 4 Characters";
    }else{
        $check_email="select * from users where uemail='$uemail'";
        $check=mysqli_query($conn,$check_email);
        $res=mysqli_fetch_assoc($check);
        if($res>0){
            $msg="Email Already registred";
        }else{           
//store into database
            $pass=md5($pass1);
            $status=mysqli_query($conn,"insert into admin_users(username,email,mobile,password,usertype) values('$uname','$uemail','$umobile','$pass','vendor')");
            if($status){
                $result="Successfully Registared";
            }else{
                echo $msg="Registartion Failed, Please enter valid details";
                echo mysqli_error($conn);
            }
        }
    }
}

?>
<!-- topstart -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Registartion|SuperMart|Elecrtronic,fashion,sports,books available </title>
    <link rel="stylesheet" href="../shared/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>

    <!-- navbar -->
    <div class="d-flex justify-content-between">
    <p class="fs-6 fw-bold mb-0 py-1 px-0 px-md-2 bg-warning" style="color: #130f40;">WELCOME TO SUPERMART</p>
        <div class="icons mx-2">
            <a class="text-decoration-none fw-bold" href="../customer/cuslogin.php"><img src=" ../img/windo/register.png" alt="" >Login</a>
            <a class="text-decoration-none fw-bold" href="../customer/cusregister.php"><img src=" ../img/windo/register.png" alt="">Register</a>
            <a class="text-decoration-none fw-bold" href="vendorlogin.php"><img src=" ../img/windo/register.png" alt="">Become a seller</a>
        </div>
    </div>
    
    <!-- navbar2 -->
    <nav class="navbar navbar-expand-lg" id="navbar">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.html" id="logo"><span id="span1">S</span>uper <span>Mart</span></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span><img src=" ../img/windo/menu.png" alt="" width="30px"></span>
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
                <a class="nav-link" href="vendorlogin.php">Become a seller</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
<!-- top end -->


   <div class="container" id="login">
    <form action="" method="post" ><div class="row">
        <div class="col-md-5 py-3 py-md-0" id="side1">
            <h3 class="text-center text-warning">Become a Seller</h3>
        </div>
        <div class="col-md-7 py-3 py-md-0" id="side2">
            <h3 class="text-center">Create Account</h3>
            <div class="input2 text-center">
            
            <input type="text" name="uname" placeholder="User Name" required>
            <input type="text" name="uemail" placeholder="Email" required>
            <input type="number" name="umobile" placeholder="Phone" required>
            <input type="password" name="pass1" placeholder="Password" required>
            <input type="password" name="pass2" placeholder="Retype Password" required>
            </div>
            <div class="text-center mt-3">
                <button type="submit" name="submit" class="text-white btn btn-warning">Register</button>
            </div>
            <p class="text-center fw-bold mt-3">Already have an Acoount?<a href="vendorlogin.php">Click Here</a></p>
            <div class="text-danger text-center mt-2"><?php echo $msg; ?></div>
            <div class="text-success text-center mt-2"><?php echo $result; ?></div>
        </div>
    </form>
    
    </div>
   </div>


<?php
include_once "../customer/footer.php";
?>



