<?php
include_once "connection.php";
function pr($arr){
    echo '<pre>';
    print_r($arr);
}
function prx($arr){
    echo '<pre>';
    print_r($arr);
}

function get_safe_value($conn,$str){
    if($str!=''){
    return mysqli_real_escape_string($conn, $str);
    }
}

function get_product($conn,$limit='',$cat_id='',$product_id=''){
    $sql="select * from product where status=1 ";
    if($cat_id!=''){
        $sql.=" and categories_id=$cat_id";
    }
    if($product_id!=''){
        $sql.=" and id=$product_id";
    }
    $sql.=" order by id desc";
    if($limit!=''){
        $sql.=" limit $limit"; 
    }
    $res=mysqli_query($conn, $sql);
    $data=array();
    while($row=mysqli_fetch_assoc($res)){
        $data[]=$row;
    }
    return $data;
}

function isAdmin(){
    if($_SESSION['admin_type']=="vendor"){
        header('location:product.php');
        die;
    }
}

function productsoldqtybypid($conn,$pid){
    $sql="select sum(qty) as sqty from orderplaced where pid=$pid ";
    $res=mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($res);
    return $row['sqty'];
}
function productqtybypid($conn,$pid){
    $sql="select pqty from product where id=$pid ";
    $res=mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($res);
    return $row['pqty'];
}

?>