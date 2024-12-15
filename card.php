<?php
session_start();

// Function to calculate the total
function calculatetotalcart() {
    $total = 0;

    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as $key => $value) {
            $price = $value['product_price'];
            $quantity = $value['product_quantity'];
            $total += $price * $quantity;
        }
    }

    // If the cart is empty, set total to 0
    $_SESSION['total'] = $total;
}

// Handle adding to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'];

        if (isset($_SESSION['cart'])) {
            $product_array_ids = array_column($_SESSION['cart'], "product_id");

            if (!in_array($product_id, $product_array_ids)) {
                $product_array = array(
                    'product_id' => $product_id,
                    'product_name' => $_POST['product_name'],
                    'product_price' => $_POST['product_price'],
                    'product_image' => $_POST['product_image'],
                    'product_quantity' => $_POST['product_quantity']
                );
                $_SESSION['cart'][$product_id] = $product_array;
            } else {
                echo '<script>alert("Product is already in the cart.");</script>';
            }
        } else {
            $product_array = array(
                'product_id' => $product_id,
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_quantity' => $_POST['product_quantity']
            );
            $_SESSION['cart'][$product_id] = $product_array;
        }

        calculatetotalcart(); // Update total after adding a product

    } elseif (isset($_POST['edit_quantity'])) {
        $product_id = $_POST['product_id'];
        $product_quantity = $_POST['product_quantity'];

        // Update the quantity in the session
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['product_quantity'] = $product_quantity;
        }

        calculatetotalcart(); // Update total after editing quantity

    } elseif (isset($_POST['remove_product'])) {
        $product_id = $_POST['product_id'];
        unset($_SESSION['cart'][$product_id]);

        calculatetotalcart(); // Update total after removing product
    }
}

// Initialize total if cart already has items on page load
if (!isset($_SESSION['total'])) {
    calculatetotalcart();
}

?>

<?php include('layouts/header.php');?>

<!-- Cart Section -->
<section class="cart container my-5 py-5">
    <div class="container mt-5">
        <h2 class="font-weight-bold">Your Cart</h2>
        <hr class="">
    </div>
    <table class="mt-5 pt-5">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>

        <?php 
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            foreach ($_SESSION['cart'] as $key => $value) {
        ?>
            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/images/<?php echo $value['product_image']; ?>" alt="Product Image" />
                        <div>
                            <p><?php echo $value['product_name']; ?></p>
                            <small><span>XAF</span><?php echo $value['product_price']; ?></small>
                            <br>
                            <form method="POST" action="card.php">
                                <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />
                                <input type="submit" name="remove_product" class="remove-btn" value="Remove" />
                            </form>
                        </div>
                    </div>
                </td>
                <td>
                    <form method="POST" action="card.php">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                        <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>" min="1"/>
                        <input type="submit" class="edit-btn" value="Edit" name="edit_quantity"/>
                    </form>
                </td>
                <td>
                    <span>XAF</span>
                    <span class="product_price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
                </td>
            </tr>
        <?php 
            }
        } else { 
        ?>
            <tr>
                <td colspan="3" class="text-center">No items in cart.</td>
            </tr>
        <?php } ?>
    </table>

    <div class="cart-total">
        <table>
            <tr>
                <td>Total</td>
                <td>XAF <?php echo isset($_SESSION['total']) ? $_SESSION['total'] : 0; ?></td>
            </tr>
        </table>
    </div>

    <div class="checkout-container">
        <form method="POST" action="checkout.php">
            <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout">
        </form>
    </div>
</section>

<?php include('layouts/footer.php'); ?>
