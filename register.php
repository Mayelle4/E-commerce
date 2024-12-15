<?php

session_start();
include('server/connection.php');


if(isset($_SESSION['logged_in'])){

  header('location: account.php');
  exit;


}


if (isset($_POST['register'])) {
  
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];

  if ($password !== $confirmPassword) {
    header('location: register.php?error=passwords do not match');
    exit();
  } else if (strlen($password) < 6) {
    header('location: register.php?error=your password must be at least 6 characters');
    exit();
  } else {
    // Check whether there is a user with this email or not 
    $stmt1 = $conn->prepare("SELECT COUNT(*) FROM users WHERE user_email = ?");
    $stmt1->bind_param('s', $email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->store_result();
    $stmt1->fetch();
    $stmt1->close();

    // If there is a user already registered with this email
    if ($num_rows != 0) {
      header('location: register.php?error=user with this email already exists');
      exit();
    } else {
      // Create a new user
      $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)");
      $hashedPassword = md5($password); // Hash the password
      $stmt->bind_param('sss', $name, $email, $hashedPassword);


        //if account was created succefully
      if ($stmt->execute()) {
        $user_id = $stmt->insert_id;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $name;
        $_SESSION['logged_in'] = true;
        header('location: account.php?register_success=your account was registered successfully');
      } else {
        header('location: register.php?error=could not create an account at the moment');
      }
      $stmt->close();
    }
  }


}




?>




<?php include('layouts/header.php');?>


<!--register-->

<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">register</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container ">
        <form id="register-form" method="POST" action="register.php">
          <p  style="color: red;"><?php if (isset($_GET['error'])) {echo $_GET['error'];}?></P>

            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="register-name" name="name" placeholder="name" required/>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="register-email" name="email" placeholder="email" required/>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="text" class="form-control" id="register-password" name="password" placeholder="password" required/>
            </div>
            
            <div class="form-group">
                <label>confirm Password</label>
                <input type="text" class="form-control" id="register- confirmPassword" name="confirmPassword" placeholder="confirmPassword" required/>
            </div>

            <div class="form-group">
                <input type="submit" class="btn" id="register-btn" name="register" value="register"/>
            </div>

            <div class="form-group">
                <a id="login-url"  href=" login.php" class="btn"> Do you have  account? Login</a>
            </div>

        </form>
    </div>
</section>






<?php include('layouts/footer.php');?>