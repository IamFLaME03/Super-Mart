<?php
include_once "../shared/cusauthguard.php";
include_once "top.php";
include_once "../shared/connection.php";
$uid=$_SESSION['userid'];



if(isset($_GET['type']) && $_GET['type']!=''){
    $type=get_safe_value($conn,$_GET['type']);
//delete from cart
    if($type=='delete'){
        $pid=get_safe_value($conn, $_GET['pid']);
        mysqli_query($conn, "delete from cart where pid='$pid' and uid=$uid");
    }
}

$total=0;
$result=mysqli_query($conn,"select * from cart join product on cart.pid=product.id  where uid=$uid");
?>

<!-- content start -->
<div class="container-fluid px-4">   
            <!-- table section start -->
            <div class="row py-2">
                
            
                <h4 class="mx-2 fs-3 mb-3 py-2 bg-warning" style="color: #130f40;"><i class="fa-solid fa-cart-shopping"></i>My Cart</h4>
                <div class="col">
                <table class="table">
                    <caption></caption>
                    <thead>
                        <tr class="bg-warning" style="color:#130f40;">
                            <th scope="col" class="serial">#</th>
                            <th scope="col">ProductId</th>
                            <th scope="col">ProductName</th>
                            <th scope="col">Image</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Sub-total</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i=1;
                       while($row=mysqli_fetch_assoc($result))
                       {
                           $pid=$row['pid'];
                           $name=$row['pname'];
                           $image=$row['pimage'];
                           $price=$row['pprice'];
                           $qty=$row['qty'];
                       
                           $total=$total+($price*$qty);
                         ?>
                        <tr>
                            <th scope="row" class="serial"><?php echo $i?></th>
                            <td><?php echo $pid?></td>
                            <td ><?php echo $name?></td>
                            <td><div style="width: 100px; height: auto;"><img class="img-fluid rounded" src="../img/product_img/<?php echo $image?>" /></div></td>
                            <td><span>&#8377</span><?php echo $price?></td>
                            <td><?php echo $qty?></td>
                            <td><span>&#8377</span><?php echo $price*$qty ?></td>
                            <td ><div class="btn-group">
                            <?php 
                             //  delete
                                echo " <a href='?type=delete&pid=".$pid."' class='btn btn-danger'>Delete</a>&nbsp; ";
                               
                            ?></div>
                            </td>
                        </tr> 
                        
                    <?php $i++; }?>
                    <tr>
                            <th scope="row"></th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                    </tr> 
                    <tr class="bg-warning" style="color:#130f40;">
                            <th scope="row"></th>
                            <td></td>
                            <td></td>
                            <td>Total Price:</td>
                            <td><span>&#8377</span><?php echo $total?></td>
                            <td><?php if(mysqli_num_rows($result)>0){?>
                                 <div class="d-flex">
                                <a class="text-decoration-none fw-bold text-white btn btn-success " href="orderplaced.php">Order</a>
                                </div> <?php }?>
                            </td>
                            <td></td>
                            <td></td>
                    </tr> 
                </tbody>
            </table>
                
        </div>

    </div>
            <!-- table section end -->
</div>
<?php include_once "footer.php"?>