<?php
    include_once "top.php";
    isAdmin();
    $categories='';
    $msg='';
    if(isset($_GET['id']) && $_GET['id']!=''){
        $id=get_safe_value($conn, $_GET['id']);
        $res=mysqli_query($conn, "select * from categories where id='$id'");
        
        $check=mysqli_num_rows($res);
        if($check>0){
            $row=mysqli_fetch_assoc($res);
            $categories=$row['categories'];
        }
        else{
            header('location:categories.php');
            die;
        }
    }

    if(isset($_POST['submit'])){
        $categories=get_safe_value($conn, $_POST['categories']);
        $res=mysqli_query($conn, "select * from categories where categories='$categories'");
        
        $check=mysqli_num_rows($res);
        if($check>0){
            $msg="categories already exist";
        }
        else{
            if(isset($_GET['id']) && $_GET['id']!=''){
                mysqli_query($conn, "update categories set categories='$categories' where id='$id'");
            }else{
                mysqli_query($conn, "insert into categories(categories,status) values('$categories','1')");
            }
            header('location:categories.php');
            die;
        }
        
    }
    
    
?>
    
        <!-- content start -->
        <div class="container-fluid px-5 bg-light py-4"> 
            <div class="row bg-white border-2 border-bottom">
                <h3 class="fs-4">Manage Categories</h3>
            </div>  
            <div class="row pt-3">
                <form method="post">
                    <div class="form-group">
                        <label for="categories">Categories</label>
                        <input type="text" class="form-control" name="categories" placeholder="Enter Category name" required value="<?php echo $categories;?>">
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