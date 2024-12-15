<?php


include('connection.php');


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

 $stmt = $conn->prepare("SELECT * FROM products WHERE product_category='watches' LIMIT 4");

$stmt->execute();


$coats_products = $stmt->get_result();


if ($coats_products->num_rows > 0) {
    
} else {
    echo "No watches found.";
}
?>




