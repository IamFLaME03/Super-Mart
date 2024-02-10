<?php
include_once "top.php";
include_once "shared/functions.php";
$cat_id=mysqli_real_escape_string($conn, $_GET['id']);
if($cat_id>0){
  $get_product=get_product($conn,'',$cat_id);
}else{
  header('location:index.php');
}
?>

<div class="container" id="product-cards">
      <div class="row align-items-stretch" style="margin-top: 30px;">
      <?php
        
        foreach($get_product as $list){
          ?>

          <div class="col-md-3 py-3 py-md-0">
            <div class="card">
              <a href="product.php?product_id=<?php echo $list['id']?>&msg=&error="><img class="img-fluid" src="img/product_img/<?php echo $list['pimage']?>" alt=""></a>
              <div class="card-body">
                <h3 class="text-center  " ><a class="fs-4 text-decoration-none" style="color: #130f40;" href="#"><?php echo $list['pname']?></a></h3>

                <p class="fs-6 text-secondary"><?php echo $list['pshort_details']?></p>

                <div class="d-flex">
                <h2 class="fs-4"><span>&#8377</span><?php echo $list['pprice']?></h2>
                  <h4 class="fs-5 text-decoration-line-through text-secondary me-auto"><span>&#8377</span><?php echo $list['pmrp']?></h4>
                  <span><li class="fa-solid fa-cart-shopping"></li></span>
                
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      
      </div>
    </div>


<?php include_once "footer.php"?>
