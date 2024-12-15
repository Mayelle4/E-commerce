<?php

session_start();
include('connection.php');

// Check if the user is not logged in

if(!isset($_SESSION['logged_in'])){
    header('location:../checkout.php?message=please login/register to place and order');
        exit;



    
}else{

            // Check if the user is logged in
            if (!isset($_SESSION['user_id'])) {
                header('location: ../login.php');
                exit; // Ensure no further code is executed
            }

            if (isset($_POST['place_order'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $city = $_POST['city'];
                $address = $_POST['address'];
                $order_cost = $_SESSION['total'];
                $order_status = "not paid";
                $user_id = $_SESSION['user_id'];  
                $order_date = date('Y-m-d H:i:s');

                // Prepare the SQL statement
                $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
                
                if ($stmt) {
                    $stmt->bind_param('dsissss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);
                    $stmt_status = $stmt->execute();

                    if(!$stmt_status){
                        header('location:index.php');
                        exit;
                    }

                    
                    $order_id = $stmt->insert_id;

                
                

                // Process each item in the cart
                foreach ($_SESSION['cart'] as $product) {
                    $product_id = $product['product_id'];
                    $product_name = $product['product_name'];
                    $product_price = $product['product_price'];
                    $product_image = $product['product_image'];
                    $product_quantity = $product['product_quantity'];

                    $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date)
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

                    if ($stmt) {
                        $stmt->bind_param('iissiiis', $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);
                        if (!$stmt->execute()) {
                            die("Error executing order item query: " . $stmt->error);
                        }
                    } else {
                        die("Error preparing order item query: " . $conn->error);
                    }
                }

            }

                // Clear the cart
                unset($_SESSION['cart']);

                // Redirect to the payment page
                header('location: ../payment.php?order_status=order_placed_successfully');
            }

}

?>
