<?php
include_once "top.php";
$uid=$_SESSION['userid'];


$total=0;
$result=mysqli_query($conn,"select * from orderplaced join product on orderplaced.pid=product.id  where uid=$uid order by orderplaced.id desc");
?>

<!-- content start -->
<div class="container-fluid px-4">   
            <!-- table section start -->
            <div class="row py-2">
                
            
                <h4 class="mx-2 fs-3 mb-3 py-2 bg-success" style="color: #130f40;"><i class="fa-solid fa-cart-shopping"></i>My Orders</h4>
                <div class="col">
                <table class="table">
                    <caption></caption>
                    <thead>
                        <tr class="bg-success" style="color:#130f40;">
                            <th scope="col" class="serial">#</th>
                            <th scope="col">ProductId</th>
                            <th scope="col">ProductName</th>
                            <th scope="col">Image</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Date</th>
                            
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
                           $price=$row['bill'];
                           $qty=$row['qty'];
                           $date=$row['ordered_date']; 

                         ?>
                        <tr>
                        <th scope="row" class="serial"><?php echo $i?></th>
                            <td><?php echo $pid?></td>
                            <td ><?php echo $name?></td>
                            <td><div style="width: 100px; height: auto;"><img class="img-fluid rounded" src="../img/product_img/<?php echo $image?>" /></div></td>
                            <td><span>&#8377</span><?php echo $price?></td>
                            <td><?php echo $qty?></td>
                            <td><?php echo $date ?></td>
                        </tr> 
                        
                    <?php $i++; }?>
                </tbody>
            </table>
                
        </div>

    </div>
            <!-- table section end -->
</div>

<?php include_once "footer.php"?>