<?php
session_start();

if(isset($_POST['order_pay_btn'])){
 $order_status = $_POST['order_status'];
 $order_total_price = $_POST['order_total_price'];

}









?>



<?php include('layouts/header.php');?>

<!-- payment-->

 <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">payment</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container text-center ">

      <?php if(isset($_SESSION['total']) && $_SESSION['total'] !=0) { ?>
            <p> total payment: XAF <?php  echo $_SESSION['total'];?></p>
            <input class="btn btn-primary" type="submit" value="pay now"/>


      <?php } else  if(isset($_POST['order_status']) && $_POST['order_status'] == "not paid") {?>
            <p> Total payment: XAF <?php echo $_POST['order_total_price']; ?> </p>
            <input class="btn btn-primary" type="submit" value="pay now"/>


            <?php } else{ ?>

       
                <p> you dont have and order</P>

              <?php } ?>

     

    </div>
</section>



<?php include('layouts/footer.php');?>
