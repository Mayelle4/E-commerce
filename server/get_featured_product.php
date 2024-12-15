<?php

include('connection.php');


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$stmt = $conn->prepare("SELECT * FROM products LIMIT 4");

$stmt->execute();


$featured_products = $stmt->get_result();


if ($featured_products->num_rows > 0) {
    
} else {
    echo "No featured products found.";
}

?>
