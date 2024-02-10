<?php
include_once "top.php";
include_once "shared/functions.php";
$product_id=mysqli_real_escape_string($conn, $_GET['product_id']);
$get_product=get_product($conn,'','',$product_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container ">
        <div class="row mt-4 py-4 px-5 bglightgrey">
            <div class="col-md-5">
                <img src="img/product_img/<?php echo $get_product['0'] ['pimage']?>" alt="image" class="w-100 img-fluid img-thumbnail">
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
                <label for="qty">Quantity:</label>
                <select class="text-center" name="qty" id="qty">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                </select>
                <?php 
                    if($cart_show!=''){
                ?>
                <div>
                    <a href="customer/cuslogin.php" type="button" class="btn btn-default btn-warning text-white my-2">Add to Cart</a>
                </div>
                <?php } ?>
                <div class="fw-bold">About this item:</div>
                <p class="fs-6 text-secondary ">  <?php echo $get_product['0'] ['pdetails']?></p>
            </div>
        </div>
    </div>

<?php include_once "footer.php"?>


    



