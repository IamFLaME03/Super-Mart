<?php
include_once "top.php";
$uid=$_SESSION['userid'];
$msg='';
if(isset($_POST['submit'])){
    $address=get_safe_value($conn, $_POST['address']);
    $state=get_safe_value($conn, $_POST['state']);
    $pincode=get_safe_value($conn, $_POST['pincode']);
    
    $res=mysqli_query($conn,"select * from cart join product on cart.pid=product.id  where uid=$uid");
    while($row=mysqli_fetch_assoc($res))
                        {   
                            $total=0;
                            $cartid=$row['cartid'];
                            $pid=$row['pid'];
                            $price=$row['pprice'];
                            $qty=$row['qty'];
                            $total=$price*$qty;
                            $admin_earn=$total*0.1;
                            $vendor_earn=$total*0.9;
                            mysqli_query($conn, "insert into orderplaced(cartid,uid,pid,qty,vendor_earn,admin_earn,bill,address,state,pincode) values('$cartid','$uid','$pid','$qty','$vendor_earn','$admin_earn','$total','$address','$state','$pincode')");
                            mysqli_query($conn, "delete from cart where cartid=$cartid");
                        }
    $msg="Ordered Successfull";
}


?>
<div class="container" id="login">
    <form action="" method="post" ><div class="row">
        <div class="col-md-5 py-3 py-md-0" id="side1">
            <h3 class="text-center text-warning">
                <input type="submit" name="submit" class="fs-3 fw-bold btn btn-warning p-3" style="color:#130f40;" value="Click to Order">
            </h3>
        </div>

        <div class="col-md-7 py-3 py-md-0" id="side2">
            <h3 class="text-center">Location Details</h3>
            <div class="input2 text-center align-items-center">
                <input type="text" name="address" placeholder="Full Address" required class="my-3">
                <input type="text" name="state" placeholder="State" required class="mb-3">
                <input type="number" name="pincode" placeholder="Pincode" required class="mb-3">
            </div>
            <div class="text-success text-center mt-2"><?php echo $msg; ?></div>
        </div>
        
        
    </form>
    
    </div>

    <?php include_once "footer.php"?>