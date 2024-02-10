<?php
include_once "top.php";
include_once "../shared/functions.php";
$product_id=mysqli_real_escape_string($conn, $_GET['product_id']);
$qty_error=mysqli_real_escape_string($conn, $_GET['error']);
$get_product=get_product($conn,'','',$product_id);

$msg=get_safe_value($conn, $_GET['msg']);
?>

    <div class="container ">
        <div class="row mt-4 py-4 px-5 bglightgrey">
            <div class="col-md-5">
                <img src="../img/product_img/<?php echo $get_product['0'] ['pimage']?>" alt="image" class="w-100 img-fluid img-thumbnail">
            </div>
            <div class="col-md-7">
                
                <p class="bestchoice text-center">Best Choice</p>
                <h2 style="color: #130f40;"><?php echo $get_product['0'] ['pname']?></h2>
                <p class="fs-6 text-secondary "><?php echo $get_product['0'] ['pshort_details']?></p>
                <div class="d-flex">
                <p class="price fs-4" style="color: #130f40;"><span>&#8377</span><?php echo $get_product['0'] ['pprice']?></p>
                <p class="fs-5 text-decoration-line-through text-secondary me-auto"><span>&#8377</span><?php echo $get_product['0'] ['pmrp']?></p>
                </div>
        <?php 
            $cart_show='yes';
            $productsoldqty= productsoldqtybypid($conn, $get_product['0'] ['id']);
            if($productsoldqty>=$get_product['0'] ['pqty']){
                $stock='Out of stock';
                $cart_show='';
            }else{
                $stock='In Stock';
            }
        ?>
                <p class="fw-bold">Avaibility:<?php echo $stock ?></p>
                
            <form action="addtocart.php" method="post">
                
                <input type="hidden" name="pid" value="<?php echo $product_id?>">
                <input type="hidden" name="pprice" value="<?php echo $get_product['0'] ['pprice']?>">
                <?php 
                    if($cart_show!=''){
                ?>
                <label for="qty" class="fwbold">Quantity:</label>
                <input type="number" name="qty" min="1" style="width: 50px; text-align: center;" value="1">
                <div class="text-success fw-bold mt-2"><?php echo $msg; ?></div>
                <div class="text-danger fw-bold mt-2"><?php echo $qty_error; ?></div>
                <div>
                    <input type="submit" name='submit' class="btn btn-default btn-warning text-white my-2" value="Add to Cart">
                </div>
                <?php } ?>
            </form>
                <div class="fw-bold">About this item:</div>
                <p class="fs-6 text-secondary ">  <?php echo $get_product['0'] ['pdetails']?></p>
            </div>
        </div>
    </div>


<?php include_once "footer.php"?>
    
