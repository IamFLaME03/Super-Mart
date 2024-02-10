<?php
    include_once "top.php";
   
    $res=mysqli_query($conn, "select * from orderplaced order by id desc");
    
?>

        <!-- content start -->
        <div class="container-fluid px-4">   
            
            <!-- table section start -->
            <div class="row my-5">
                <h4 class="fs-4 mb-3">Orders</h4>
                <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Id</th>
                            <th scope="col">CustomerId</th>
                            <th scope="col">OrderedDate</th>
                            <th scope="col">Location</th>
                            <th scope="col">pincode</th>
                            <th scope="col">ProductId</th>
                            <th scope="col">Earnings</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total=0;
                        while($row=mysqli_fetch_assoc($res)){
                            $total=$total+$row['admin_earn'];
                            ?>

                        <tr>
                            <th><?php echo $row['id']?></th>
                            <td><?php echo $row['uid']?></td>
                            <td><?php echo $row['ordered_date']?></td>
                            <td><?php echo $row['address']?></td>
                            <td><?php echo $row['pincode']?></td>
                            <td><?php echo $row['pid']?></td>
                            <td class="bg-success text-white fw-bold text-end"><span>&#8377</span><?php echo $row['admin_earn'];?></td>
                            
                        </tr> 
                        
                        <?php }?>
                        <tr>
                            <th ></th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr> 
                        <tr>
                            <th></th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="bg-success text-white">Total Earn:</td>
                            <td class="text-white fw-bold bg-success"><span>&#8377</span><?php echo $total?></td>
                        </tr> 
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