<?php
    
    include_once "top.php";
    isAdmin();
    if(isset($_GET['type']) && $_GET['type']!=''){
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
            mysqli_query($conn, "update categories set status='$status' where id='$id'");
        }

//delete operation
        if($type=='delete'){
            $id=get_safe_value($conn, $_GET['id']);
            mysqli_query($conn, "delete from categories where id='$id'");
        }

//edit operation
    }    

    $res=mysqli_query($conn, "select * from categories order by categories asc");
    
?>

        <!-- content start -->
        <div class="container-fluid px-4">   
            
            <!-- table section start -->
            <div class="row my-5">
                <h4 class="fs-4 mb-3">Categories</h4>
                <h3 class="fs-5 mb-3 text-decoration-underline"><a class="text-success" href="manage_categories.php">Add Categories</a></h3>
                <div class="col">
                <table class="table">
                
                    <thead>
                        <tr>
                            <th scope="col" class="serial">#</th>
                            <th scope="col">Id</th>
                            <th scope="col">Catagories</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i=1;
                        while($row=mysqli_fetch_assoc($res)){?>
                        <tr>
                            <th scope="row" class="serial"><?php echo $i?></th>
                            <td><?php echo $row['id']?></td>
                            <td><?php echo $row['categories']?></td>
                            <td>
                            <?php 
                            //  status 
                                if($row['status']==1){
                                    echo " <a href='?type=status&operation=deactive&id=".$row['id']."' class='btn btn-success'> Active</a> &nbsp;";
                                }else{
                                echo " <a href='?type=status&operation=active&id=".$row['id']."' class='btn btn-warning'>Deactive</a>&nbsp; ";
                                }
                             //  edit
                                echo " <a href='manage_categories.php?id=".$row['id']."' class='btn btn-info'>Edit</a>&nbsp; ";
                               
                             //  delete
                                echo " <a href='?type=delete&id=".$row['id']."' class='btn btn-danger'>Delete</a>&nbsp; ";
                               
                            ?>
                            </td>
                        </tr> 
                        <?php $i++; }?>
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