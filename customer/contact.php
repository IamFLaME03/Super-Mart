<?php
include_once "top.php";
$msg='';
if(isset($_POST['submit'])){
  $name=get_safe_value($conn,$_POST['name']);
  $email=get_safe_value($conn,$_POST['email']);
  $mobile=get_safe_value($conn,$_POST['mobile']);
  $comment=get_safe_value($conn,$_POST['comment']);

  mysqli_query($conn, "insert into contact_us(name,email,mobile,comment) values('$name','$email','$mobile','$comment')");
  $msg="Message sent successfully.";
}

?>
     
    <div class="container" >
        
        
            <div >
          <form class="row" style="margin-top: 30px;"  method="post">

            <div class="col-lg-4 py-2 py-lg-0 ">
                <input type="text" name="name" id="" class="form-control fw-bold" placeholder="Name" required>
            </div>

            <div class="col-lg-4 py-2 py-lg-0 ">
                <input type="text" name="email" id=""  class="form-control" placeholder="Email" required>
            </div>

            <div class="col-lg-4 py-2 py-lg-0">
                <input type="text" name="mobile" id=""  class="form-control" placeholder="Phone" required>
            </div>

            <div class=" pt-2 ">
                <textarea name="comment" class="form-control" id="" rows="5" placeholder="Message"></textarea required>
            </div>

            <button type="submit" name="submit" class="text-center mt-4 form-control btn btn-success text-white">Send Message</button>    
        </form></div>
      
      <p class="fs-6 text-center text-primary"><?php echo $msg;?></p>
    </div>

    <a href="#" class="arrow"><i><img src=" ../img/windo/arrow.png" alt=""></i></a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<?php include_once "footer.php"?>