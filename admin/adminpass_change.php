<?php 
include_once "top.php";

$msg='';
$result='';
if(isset($_POST['submit'])){
    $useremail=$_SESSION['useremail'];
    $pass1=mysqli_real_escape_string($conn,$_GET['pass1']);
    $pass2=mysqli_real_escape_string($conn,$_GET['pass2']);
    //check validation
    if($pass1 != $pass2){
        $msg="Password and confirm-password does not matched";
    }elseif (strlen($pass1)<4) {
        $msg="Password must be 4 Characters";
    }else{
    //update pass into database
            $pass=md5($pass1);
            $status=mysqli_query($conn,"update admin_users set upassword='$pass' where uemail=$useremail ");
            if($status){
                $result="New Password successfully Updated";
            }
        }
    }
?>    

<div class="container-fluid px-5 bg-light py-4"> 
            <div class="row bg-white border-2 border-bottom">
                <h3 class="fs-4">Change Password</h3>
            </div>  
            <div class="row pt-3">
                <form method="post">
                    <div class="form-group">
                        <input type="password" class="form-control mt-2" name="pass1" placeholder="New Password" required>
                        <input type="password" class="form-control my-2" name="pass2" placeholder="Retype-new Password" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary my-3">Change Password</button>
                </form>
                    <div class="text-danger"><?php echo $msg; ?></div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script>
    var leftwrapper =document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function(){
        leftwrapper.classList.toggle("toggled");
    }
</script>
</body>
</html>




    