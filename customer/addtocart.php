<?php
include_once "../shared/cusauthguard.php";
include_once "../shared/connection.php";
include_once "../shared/functions.php";

$uid=$_SESSION['userid'];
$msg='';
if(isset($_POST['submit'])){
    $addpid=get_safe_value($conn, $_POST['pid']);
    $addpprice=get_safe_value($conn, $_POST['pprice']);
    $pqty=mysqli_real_escape_string($conn, $_POST['qty']);

    //check available quantities
    $productsoldqty= productsoldqtybypid($conn, $addpid);
    $productqty= productqtybypid($conn, $addpid);
    $qty_error='';
    $pending_qty=$productqty-$productsoldqty;
    if($pqty>$pending_qty){
        $qty_error="$pending_qty no. of items available";
        header('location:product.php?product_id='."$addpid".'&error='."$qty_error".'&msg= ');
    }else{



    //check if product already exist

    $check=mysqli_num_rows(mysqli_query($conn, "select * from cart where uid='$uid' and pid='$addpid'"));
    if($check>0){
        //update qty
        mysqli_query($conn, "update cart set qty='$pqty' where uid='$uid'");
        $msg="Updated into cart Successfully";
    }else{
        mysqli_query($conn, "insert into cart(uid,pid,price,qty) values('$uid','$addpid','$addpprice','$pqty')");
        $msg="Added into cart Successfully";
    }
    header("location:product.php?msg=$msg&product_id=$addpid&error=");
    die;
}
    }
?>



