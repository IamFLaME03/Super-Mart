<?php
    include_once "top.php";
    //vendors can see,delete only their's products but admin have power to see,delete all products 
    $condition1='';
    $condition2='';
    if( $_SESSION['admin_type']=='vendor'){
        $condition1="     and product.added_by=' ".$_SESSION['admin_id']." '     ";
        $condition2="     and added_by=' ".$_SESSION['admin_id']." '     ";
    }     

    
    if(isset($_GET['type']) && $_GET['type']!='') {
        $type=get_safe_value($conn,$_GET['type']);
// active-deactive formation
        if($type=='status'){
            $operation=get_safe_value($conn, $_GET['operation']);
            $id=get_safe_value($conn, $_GET['id']);
            if($operation=='active'){
                $status=1;
            }else{
                $status=0;
            }
            mysqli_query($conn, "update product set status='$status' where id='$id' $condition2");
        }

//delete operation
        if($type=='delete'){
            $id=get_safe_value($conn, $_GET['id']);
            mysqli_query($conn, "delete from product where id='$id' $condition2");
        }
    }

   

    $res=mysqli_query($conn, "select product.*,categories.categories from product,categories where product.categories_id=categories.id $condition1 order by product.id desc");
    
?>

        <!-- content start -->
        <div class="container-fluid px-4">   
            <!-- table section start -->
            <div class="row my-5">
                <h4 class="fs-4 mb-3">Products</h4>
                <h3 class="fs-5 mb-3 text-decoration-underline"><a class="text-success" href="manage_products.php">Add Products</a></h3>
                <div class="col">
                <table class="table">
                        <tr>
                            <th scope="col" class="serial">#</th>
                            <th scope="col">Id</th>
                            <th scope="col">Category</th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">MRP</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">RemainsQty</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i=1;
                        
                        while($row=mysqli_fetch_assoc($res)){
                            $pqty=$row['pqty'];
                            $soldqty=productsoldqtybypid($conn,$pqty);
                            $remains_qty=$pqty-$soldqty;
                            ?>
                        <tr>


                            <th scope="row" class="serial"><?php echo $i?></th>
                            <td><?php echo $row['id']?></td>
                            <td><?php echo $row['categories']?></td>
                            <td class="max"><?php echo $row['pname']?></td>
                            <td><div style="width: 100px; height: auto;"><img class="img-fluid rounded" src="../img/product_img/<?php echo $row['pimage']?>" /></div></td>
                            <td><?php echo $row['pmrp']?></td>
                            <td><?php echo $row['pprice']?></td>
                            <td><?php echo $row['pqty']?></td>
                            <td><?php echo $remains_qty?></td>
                            <td ><div class="btn-group">
                            <?php 
                            //  status 
                                if($row['status']==1){
                                    echo " <a href='?type=status&operation=deactive&id=".$row['id']."' class='btn btn-success'> Active</a> &nbsp;";
                                }else{
                                echo " <a href='?type=status&operation=active&id=".$row['id']."' class='btn btn-warning'>Deactive</a>&nbsp; ";
                                }
                             //  edit
                                echo " <a href='manage_products.php?id=".$row['id']."' class='btn btn-info'>Edit</a>&nbsp; ";
                               
                             //  delete
                                echo " <a href='?type=delete&id=".$row['id']."' class='btn btn-danger'>Delete</a>&nbsp; ";
                               
                            ?></div>
                            </td>
                        </tr> 
                <?php   $i++;
                        $remains_qty=0;
                    }?>
                    </tbody>
                </table>
                
                </div>

            </div>
            <!-- table section end -->
        </div>
        </div>
        <!-- content end -->
        <!-- page content end -->
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script>
    var leftwrapper =document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function(){
        leftwrapper.classList.toggle("toggled");
    }
</script>
</body>
</html>