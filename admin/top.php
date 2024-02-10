<?php
    session_start();
    include_once "admin_authguard.php";
    include_once "../shared/connection.php";
    include_once "../shared/functions.php";

?>    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="shared/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Admin Panel |Supermart</title>
</head>
<body class="bg-lightgray">
    <div class="d-flex" id="wrapper">
        <!-- sidebar start -->
        <div class="bg-admindark" id="sidebar-wrapper">

        <div class="sidebar-heading text-center py-4 text-white fs-4 fw-semibold text-uppercase border-bottom border-white">
            <i class="fas fa-cart-shopping me-2 " ></i>  SUPER MART
        </div>

        <div class="list-group list-group-flush my-4" id="sidebarlinks">
            <a href="product.php" class="list-group-item list-group-item-action">
                <i class="fas fa-project-diagram me-2"></i>Products
            </a>
            <?php if($_SESSION['admin_type']!='vendor'){?>
                <a href="order.php" class="list-group-item list-group-item-action ">
                    <i class="fa-solid fa-cart-shopping me-2"></i>Orders
                </a>
            <?php }
            else if($_SESSION['admin_type']=='vendor'){  ?>
                <a href="order_vendorview.php" class="list-group-item list-group-item-action ">     
                    <i class="fa-solid fa-cart-shopping me-2"></i>Orders
                </a>
            <?php } ?>
                
    <?php if($_SESSION['admin_type']!='vendor'){?>
                <a href="categories.php" class="list-group-item list-group-item-action ">
                    <i class="fa-solid fa-magnifying-glass me-2"></i>Dashboard
                </a>
                <a href="users.php" class="list-group-item list-group-item-action">
                    <i class="fas fa-users me-2"></i>Users
                </a>
                <a href="contact_us.php" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-user me-2"></i>Contact us
                </a>
    <?php }?>
        </div>
        </div>
        <!-- sidebar end -->
        <!-- page content start -->
        <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-align-left fs-4 me-3 " id="menu-toggle"></i>
                <h2 class="fs-2 m-0">Admin Panel</h2>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item-dropdown">
                        <a href="#" class="nav-link dropdown-toggle fw-bold" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user me-2"></i>Wellcome, <?php echo $adminname; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" id="adminaccDrop" aria-labelledby="navbarDropdown">
                            <li><a href="adminpass_change.php" class="dropdown-item">Change Password</a></li>
                            <li><a href="adminlogout.php" class="dropdown-item">logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        
    
