<?php
session_start();
include('server/connection.php');

// Ensure user is logged in to access this page
if (!isset($_SESSION['logged_in'])) {  
  header('location: login.php');   
  exit;  
}

// Logout functionality
if (isset($_GET['logout'])) {
  if (isset($_SESSION['logged_in'])) {
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    header('location: login.php');
    exit;
  }
}


if(isset($_POST['change_password'])){

    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $user_email = $_SESSION['user_email'];

    // Check if the passwords match
    if ($password !== $confirmPassword) {
        header('location: account.php?error=passwords do not match');
        exit();
    } else if (strlen($password) < 6) {
        header('location: account.php?error=your password must be at least 6 characters');
        exit();
    } else {
        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
        
        // Check if the statement was prepared successfully
        if ($stmt) {
            $hashed_password = md5($password); 
            $stmt->bind_param('ss', $hashed_password, $user_email);

            // Execute the statement and check for success
            if ($stmt->execute()) {
                header('location: account.php?modifiepassword_success=password updated successfully');
                exit();
            } else {
                header('location: account.php?error=could not update password');
                exit();
            }

            $stmt->close(); 
        } else {
            
            header('location: account.php?error=failed to prepare statement');
            exit();
        }
    }
}



//get orders
 if(isset($_SESSION['logged_in'])){

     $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=? ");
    $stmt->bind_param('i', $user_id);

    $stmt->execute();


    $orders = $stmt->get_result();
 }
?>


 <?php include('layouts/header.php');?>

    <!--Account-->
    <section class="my-5 py-5">
        <div class="row container mx-auto">
            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
            <p class="text-center" style="color:green"> <?php   if (isset($_GET['register_success'])) {echo $_GET['register_success'];}?></p>
            <p class="text-center" style="color:green"> <?php   if (isset($_GET['login_success'])) {echo $_GET['login_success'];}?></p>
                <h3 class="font-weight-bold">Account info </h3>
                    <hr class="mx-auto">
                    <div class="account-info">
                        <p>Name<span><?php if(isset($_SESSION['user_name'])) {echo $_SESSION['user_name'] ;} ?></span></p>
                        <p>Email<span><?php if(isset($_SESSION['user_email'])) {echo $_SESSION['user_email'] ;} ?></span></p>
                        <p><a href="#orders" id="orders-btn">Your orders</a></p>
                        <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
                    </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <form id="account-form" method="POST"  action="account.php">
                  <p class="text-center" style="color:red"> <?php   if (isset($_GET['error'])) {echo $_GET['error'];}?></p>
                  <p class="text-center" style="color:green"> <?php   if (isset($_GET['modifiepassword_success'])) {echo $_GET['modifiepassword_success'];}?></p>
                    <h3>Change Password</h3>
                    <hr class="mx-auto">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="account-password" name="password" placeholder="Password" required/>
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Confirm Password" required/>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Change Password"  name="change_password" class="btn" id="change-pass-btn">
                    </div>
                </form>
            </div>
        </div>
    </section>



<!--order-->

<session id="orders"  class="orders container my-5 py-3">
  <div class="container mt-2">
    <h2 class="font-weigth-bold  text-center">Your Orders</h2>
    <hr class="mx-auto">
 </div>

  <table class="mt-5 pt-5 mx-auto">
      <tr>
          <th>order id</th>
          <th>order cost</th>
          <th>order status</th>
          <th>order Date</th>
          <th>order Details</th>
      </tr>

      <?php   while ($row = $orders->fetch_assoc()) { ?>

      <tr>
         <td>
          <!-- <div class= "product-info"> -->
            <!-- <img src="assets/images/feature1.jpeg"> -->
            <!--<div>-->
                <!--<p class="mt-3"><?php echo $row['order_id'] ; ?></p>-->
            <!--</div>-->
          <!-- </div>-->
          <span><?php echo $row['order_id'];?></span>
         </td>

         <td>
           <span><?php echo $row['order_cost'];?></span>
         </td>

         <td>
           <span><?php echo $row['order_status'];?></span>
         </td>

       <td>
           <span><?php echo $row['order_date'];?></span>
         </td>

         <td>
    <form method="GET" action="order_details.php">
        <input type="hidden" name="order_status" value="<?php echo $row['order_status']; ?>" />
        <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>" />
        <button type="submit" class="btn order-details-btn" name="order_details_btn" value="details">Details</button>
    </form>
</td>


  </tr> 
  <?php } ?>

 </table>
</session>
   




<?php include('layouts/footer.php');?>
  