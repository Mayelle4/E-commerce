<?php
include('server/connection.php');

// Pagination setup
$limit = 8; // Number of products per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Default filter values
$category = isset($_POST['category']) ? $_POST['category'] : 'all';
$price = isset($_POST['price']) ? (int)$_POST['price'] : 1000;

// Base query and filter setup
$query = "SELECT * FROM products WHERE 1=1";
$params = [];
$types = "";

// Apply category filter
if ($category !== 'all') {
    $query .= " AND product_category = ?";
    $params[] = $category;
    $types .= "s";
}

// Apply price filter
if ($price < 1000) {
    $query .= " AND product_price <= ?";
    $params[] = $price;
    $types .= "i";
}

// Add pagination
$query .= " LIMIT ?, ?";
$params[] = $start;
$params[] = $limit;
$types .= "ii";

// Prepare and execute query
$stmt = $conn->prepare($query);
if (!empty($types)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$products = $stmt->get_result();

// Count total products for pagination
$countQuery = "SELECT COUNT(*) as total FROM products WHERE 1=1";
$countParams = [];
$countTypes = "";

// Apply filters to count query
if ($category !== 'all') {
    $countQuery .= " AND product_category = ?";
    $countParams[] = $category;
    $countTypes .= "s";
}
if ($price < 1000) {
    $countQuery .= " AND product_price <= ?";
    $countParams[] = $price;
    $countTypes .= "i";
}

$countStmt = $conn->prepare($countQuery);
if (!empty($countTypes)) {
    $countStmt->bind_param($countTypes, ...$countParams);
}
$countStmt->execute();
$totalResult = $countStmt->get_result();
$total = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($total / $limit);
?>

<?php include('layouts/header.php'); ?>

<!-- Search and Filters Section -->
<section class="my-5">
    <div class="container">
        <div class="row">
            <!-- Filters Sidebar -->
            <div class="col-lg-3 col-md-4 col-sm-12 mt-5">
                <div class="search-filters">
                    <h4>Search Products</h4>
                    <hr>
                    <form action="shop.php" method="POST">
                        <p><strong>Category</strong></p>
                        <div class="form-check">
                            <input class="form-check-input" value="all" type="radio" name="category" id="category_all" <?php echo ($category === 'all') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="category_all">All</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="shoes" type="radio" name="category" id="category_shoes" <?php echo ($category === 'shoes') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="category_shoes">Shoes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="coats" type="radio" name="category" id="category_coats" <?php echo ($category === 'coats') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="category_coats">Coats</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="watches" type="radio" name="category" id="category_watches" <?php echo ($category === 'watches') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="category_watches">Watches</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="bags" type="radio" name="category" id="category_bags" <?php echo ($category === 'bags') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="category_bags">Bags</label>
                        </div>

                        <p class="mt-4"><strong>Price</strong></p>
                        <input type="range" name="price" value="<?php echo $price; ?>" class="form-range w-100 " min="1" max="1000" id="priceRange">
                        <div class="d-flex justify-content-between">
                            <span>1</span>
                            <span>1000</span>
                        </div>
                        <button type="submit" name="search" class="btn btn-primary mt-4 w-50">Search</button>
                    </form>
                </div>
            </div>

          <!-- Shop Section -->
<div id="shop" class="col-lg-9 col-md-8 col-sm-12 mt-5">
  <div class="text-center mb-9">
    <h3>Our Products</h3>
    <hr>
    <p>Here you can check out our products</p>
  </div>
  <div class="row mx-auto container">
    <?php while ($row = $products->fetch_assoc()) { ?>
      <!-- Product Card -->
      <div class="col-lg-3 col-md-6 col-sm-12 text-center mb-4">
        <div class="product" onclick="window.location.href='single_product.html';">
          <img class="img-fluid mb-3" src="assets/images/<?php echo $row['product_image1']; ?>" />
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
          <h4 class="p-price">XAF<?php echo $row['product_price']; ?></h4>
          
            <a class="btn btn_success" href="<?php echo 'single-product.php?product_id=' . $row['product_id']; ?>">Buy Now</a>
         
        </div>
      </div>
    <?php } ?>
  </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination mt-5 justify-content-center">
                        <?php if ($page > 1) { ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a></li>
                        <?php } ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                            <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php } ?>
                        <?php if ($page < $totalPages) { ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a></li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>

<?php include('layouts/footer.php'); ?>
