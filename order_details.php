<?php

include('server/connection.php');

// Check if required GET parameters are set
if (isset($_GET['order_details_btn']) && isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $order_status = $_GET['order_status'];
    
    // Prepare and execute SQL statement
    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $order_details_result = $stmt->get_result();

    // Fetch results as an associative array
    $order_details_array = $order_details_result->fetch_all(MYSQLI_ASSOC);

    // Calculate the total price
    $order_total_price = calculateTotalOrderPrice($order_details_array);

} else {
    // Redirect to login page if parameters are missing
    header('Location: login.php');
    exit;
}

// Function to calculate total order price
function calculateTotalOrderPrice($order_details_array) {
    $total = 0;
    foreach ($order_details_array as $row) {
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];
        $total += $product_price * $product_quantity;
    }
    return $total;
}
?>

<?php include('layouts/header.php'); ?>

<!-- ORDER DETAILS -->
<section id="orders" class="orders container my-5 py-3">
    <div class="container mt-5">
        <h2 class="font-weight-bold text-center">Your Orders</h2>
        <hr class="mx-auto">
    </div>

    <!-- Orders Table -->
    <table class="mt-5 pt-5 table mx-auto">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order_details_array as $row) { ?>
                <tr>
                    <td>
                        <div class="product-info d-flex align-items-center">
                            <img src="assets/images/<?php echo $row['product_image']; ?>" alt="Product Image" class="product-img">
                            <p class="product-name ms-3 mb-0"><?php echo $row['product_name']; ?></p>
                        </div>
                    </td>
                    <td>XAF <?php echo $row['product_price']; ?></td>
                    <td><?php echo $row['product_quantity']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Payment Button -->
    <?php if ($order_status == "not paid") { ?>
        <form style="float: right;" method="POST" action="payment.php">
            <input type="hidden" name="order_total_price" value="<?php echo $order_total_price; ?>" />
            <input type="hidden" name="order_status" value="<?php echo $order_status; ?>" />
            <input type="submit" name="order_pay_btn" class="btn btn-primary" value="Pay Now" />
        </form>
    <?php } ?>
</section>

<?php include('layouts/footer.php'); ?>
