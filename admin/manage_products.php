<?php
    include_once "top.php";
  //vendors can see,delete only their's products but admin have power to see,delete all products 
    $condition1='';
    $condition2='';
    if( $_SESSION['admin_type']=='vendor'){
        $condition1="     and product.added_by=' ".$_SESSION['admin_id']." '     ";
        $condition2="     and added_by=' ".$_SESSION['admin_id']." '     ";
    }
    

    $categories_id='';
    $pname='';
    $pmrp='';
    $pprice='';
    $pqty='';
    $pimage='';
    $pshort_details='';
    $pdetails='';
    $msg='';
    //security pupose
    if(isset($_GET['id']) && $_GET['id']!=''){
        $id=get_safe_value($conn, $_GET['id']);
        $res=mysqli_query($conn, "select * from product where id='$id' $condition1");
        
        $check=mysqli_num_rows($res);
        if($check>0){
            $row=mysqli_fetch_assoc($res);
            $categories_id=$row['categories_id'];
            $pname=$row['pname'];
            $pmrp=$row['pmrp'];
            $pprice=$row['pprice'];
            $pqty=$row['pqty'];
            $pshort_details=$row['pshort_details'];
            $pdetails=$row['pdetails'];
        }
        else{
            header('location:product.php');
            die;
        }
    }

    //main operations
    if(isset($_POST['submit'])){
        $categories_id=get_safe_value($conn, $_POST['categories_id']);
        $pname=get_safe_value($conn, $_POST['pname']);
        $pmrp=get_safe_value($conn, $_POST['pmrp']);
        $pprice=get_safe_value($conn, $_POST['pprice']);
        $pqty=get_safe_value($conn, $_POST['pqty']);
        $pshort_details=get_safe_value($conn, $_POST['pshort_details']);
        $pdetails=get_safe_value($conn, $_POST['pdetails']);
        
        //checking product already exist or not
        $res=mysqli_query($conn, "select * from product where pname='$pname' $condition1");
        $check=mysqli_num_rows($res);
        if($check>0){
            if(isset($_GET['id']) && $_GET['id']!=''){
                $getData=mysqli_fetch_assoc($res);
                if($id==$getData['id']){

                }else{
                    $msg="product already exist";
                }
            }else{
            $msg="product already exist";
            }
        }
            //verify img only in .jpg,.png and .jpeg
            if($_FILES['pimage']['type']!='' && $_FILES['pimage']['type']!='image/png' && $_FILES['pimage']['type']!='image/jpg' && $_FILES['pimage']['type']!='image/jpeg'){
                $msg="Only .png,.jpg or .jpeg image format file allowed";
            }
            //update or add product operation
        if($msg==''){
            if(isset($_GET['id']) && $_GET['id']!=''){
                $pimage=rand(11111,99999).'_'.$_FILES['pimage']['name'];
                move_uploaded_file($_FILES['pimage']['tmp_name'],'../img/product_img/'.$pimage);
                mysqli_query($conn, "update product set categories_id='$categories_id',pname='$pname',pmrp='$pmrp',pprice='$pprice',pqty='$pqty',pimage='$pimage',pshort_details='$pshort_details',pdetails='$pdetails' where id='$id'");
            }else{
                $pimage=rand(11111,99999).'_'.$_FILES['pimage']['name'];
                move_uploaded_file($_FILES['pimage']['tmp_name'],'../img/product_img/'.$pimage);
                mysqli_query($conn, "insert into product(categories_id,pname,pmrp,pprice,pqty,pimage,pshort_details,pdetails,status,added_by) VALUES ('$categories_id','$pname','$pmrp','$pprice','$pqty','$pimage','$pshort_details','$pdetails',1,' ".$_SESSION['admin_id']." ')");
            }

            header('location:product.php');
            die;
        }
        
    }
    
    
?>
    
        <!-- content start -->
        <div class="container-fluid px-5 bg-light py-4"> 
            <div class="row bg-white border-2 border-bottom">
                <h3 class="fs-4">Manage Product</h3>
            </div>  
            <div class="row pt-3">
                <!-- form start -->

                <form method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label for="categories">Categories</label>
                        <select class="form-control custom-select" name="categories_id">
                            <option>Select categories</option>
                            <?php
                                $res=mysqli_query($conn, "select id,categories from categories order by categories asc");
                                while($row=mysqli_fetch_assoc($res)){
                                    if($row['id']==$categories_id){
                                        echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
                                    }
                                    else{
                                    echo "<option value=".$row['id'].">".$row['categories']."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="pname" placeholder="Enter Product name" required value="<?php echo $pname;?>">
                    </div>
  
                    <div class="form-group">
                        <label for="">MRP</label>
                        <input type="text" class="form-control" name="pmrp" placeholder="Enter Product mrp" required value="<?php echo $pmrp;?>">
                    </div>
  
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="text" class="form-control" name="pprice" placeholder="Enter Product Price" required value="<?php echo $pprice;?>">
                    </div>
  
                    <div class="form-group">
                        <label for="">Qty</label>
                        <input type="text" class="form-control" name="pqty" placeholder="Enter Product qty" required value="<?php echo $pqty;?>">
                    </div>
  
                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" class="form-control" name="pimage" required>
                    </div>
  
                    <div class="form-group">
                        <label for="">Short-details</label>
                        <textarea class="form-control" name="pshort_details" placeholder="Enter Product Short-details" required>
                            <?php echo $pshort_details?> 
                        </textarea>
                    </div>
  
                    <div class="form-group">
                        <label for="">Product All-Details</label>
                        <textarea class="form-control" name="pdetails" placeholder="Enter Product details" required>
                            <?php echo $pdetails ?> 
                        </textarea>
                    </div>
   
                    <button type="submit" name="submit" class="btn btn-primary my-3">Submit</button>
                </form>
                <div class="text-danger"><?php echo $msg; ?></div>
            </div>
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