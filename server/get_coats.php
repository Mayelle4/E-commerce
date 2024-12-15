<?php

// include('connection.php');

// // Prepare and execute the query
// $stmt = $conn->prepare("SELECT * FROM products WHERE product_category='coats' LIMIT 4");
// $stmt->execute();

// // Assign the result to $coats_products using '=' instead of '=='
// $coats_products = $stmt->get_result();

include('connection.php');


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

 $stmt = $conn->prepare("SELECT * FROM products WHERE product_category='coats' LIMIT 4");

$stmt->execute();


$coats_products = $stmt->get_result();


if ($coats_products->num_rows > 0) {
    
} else {
    echo "No clothes found.";
}
?>




