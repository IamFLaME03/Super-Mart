<?php
    include_once "top.php";
    isAdmin();
    if(isset($_GET['type']) && $_GET['type']!=''){
        $type=get_safe_value($conn,$_GET['type']);
//delete-Block operation
        if($type=='delete'){
            $id=get_safe_value($conn, $_GET['id']);
            mysqli_query($conn, "delete from users where id='$id'");
        }
    }    
    $res=mysqli_query($conn, "select * from users order by id desc");
    
?>

        <!-- content start -->
        <div class="container-fluid px-4">   
            
            <!-- table section start -->
            <div class="row my-5">
                <h4 class="fs-4 mb-3">users</h4>
                <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="serial">#</th>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Date</th>
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
                            <td><?php echo $row['uname']?></td>
                            <td><?php echo $row['uemail']?></td>
                            <td><?php echo $row['umobile']?></td>
                            <td><?php echo $row['created_date']?></td>
                            <td><?php 
                             //  delete
                                echo " <a href='?type=delete&id=".$row['id']."' class='btn btn-danger'>Block</a>&nbsp; ";
                            ?></td>
                        </tr> 
                        <?php }?>
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