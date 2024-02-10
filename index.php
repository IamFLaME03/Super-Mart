<?php
include_once "top.php";
include_once "shared/functions.php";


?>


<!-- home content -->
<section class="home">
    <div class="content">
      <h1> <span>Electronic Products</span>
        <br>
        Up To <span id="span2">50%</span> Off
      </h1>
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta, saepe.
        <br>Lorem ipsum dolor sit amet consectetur.
      </p>
      <div class="btn"><button>Shop Now</button></div>

    </div>
    <div class="img">
      <img src=" ./img/windo/background.png" alt="">
    </div>
  </section>
    <!-- home content -->


    <!-- product card-->
    <div class="container" id="product-cards">
      <h1 class="text-center">New Arrivals</h1>

      <div class="row align-items-stretch" style="margin-top: 30px;">
      <?php
        $get_product=get_product($conn);
        foreach($get_product as $list){
          ?>

          <div class="col-md-3 py-3 py-md-0">
            <div class="card">
              <a href="product.php?product_id=<?php echo $list['id']?>&msg=&error="><img class="img-fluid" src="img/product_img/<?php echo $list['pimage']?>" alt=""></a>
              <div class="card-body">
                <h3 class="text-center  " ><a class="fs-4 text-decoration-none" style="color: #130f40;" href="#"><?php echo $list['pname']?></a></h3>

                <p class="fs-6 text-secondary"><?php echo $list['pshort_details']?></p>

                <div class="d-flex">
                <h2 class="fs-4"><span>&#8377</span><?php echo $list['pmrp']?></h2>
                  <h4 class="fs-5 text-decoration-line-through text-secondary me-auto"><span>&#8377</span><?php echo $list['pprice']?></h4>
                  <span><li class="fa-solid fa-cart-shopping"></li></span>
                
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      
      </div>
    </div>
    <!-- product card-->

    <!-- banner -->
    <section class="banner">
      <div class="content">
        <h1> <span>Electronic Gadget</span>
          <br>
          Up To <span id="span2">50%</span> Off
        </h1>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta, saepe.
          <br>Lorem ipsum dolor sit amet consectetur.
        </p>
        <div class="btn"><button>Shop Now</button></div>
  
      </div>
      <div class="img">
        <img src=" ./img/windo/image1.png" alt="">
      </div>
    </section>
    <!-- banner -->



    <!-- offer -->
    <div class="container" id="offer">
      <div class="row">
        <div class="col-md-3 py-3 py-md-0">
          <i class="fa-solid fa-cart-shopping"></i>
          <h3>Free Shipping</h3>
          <p>On order over $5000</p>
        </div>
        <div class="col-md-3 py-3 py-md-0">
          <i class="fa-solid fa-rotate-left"></i>
          <h3>Free Returns</h3>
          <p>Within 30 days</p>
        </div>
        <div class="col-md-3 py-3 py-md-0">
          <i class="fa-solid fa-truck"></i>
          <h3>Fast Delivery</h3>
          <p>World Wide</p>
        </div>
        <div class="col-md-3 py-3 py-md-0">
          <i class="fa-solid fa-thumbs-up"></i>
          <h3>Big choice</h3>
          <p>Of products</p>
        </div>
      </div>
    </div>
    <!-- offer -->
    
    <?php include_once "footer.php"?>
