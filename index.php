<?php include('layouts/header.php');?>





      <!--HOME-->
      <section id="home">
        <div class="container">
            <h5>NEW ARRIVALS</h5>
            <h1><span>Best Prices</span>  This Season</h1>
            <p>Eshop offers the best product for the most affordable prices</p>
            <button>Shop Now</button>
        </div>
      </section>


     

      <!-- banner-->
<section id="banner1" class="my-5 py-5">
  <div class="container">
    <h4>WHAT WE CAN OFFER</h4>
    <h1>Discover Our Product <br> UP to 50% OFF</h1>
    <button class="text-uppercase">shop now</button>
  </div>
</section>

      <!-- <section id="brand">
        <div class="container">
            <div class="row">
                <img class="img-fluid col-lg-3  col-md-6 col-sm-12" src="assets/images/brand4.jpeg"/>
                <img class="img-fluid col-lg-3  col-md-6 col-sm-12" src="assets/images/brand3.jpeg"/>
                <img class="img-fluid col-lg-3  col-md-6 col-sm-12" src="assets/images/brand2.jpeg"/>
                <img class="img-fluid col-lg-3  col-md-6 col-sm-12" src="assets/images/brand1.jpeg"/>
            </div> -->


            <!--NEW-->

            <section id="new" class="w-100">
                <div class="row p-0 m-0">
                    <!--one-->
                    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                            <img class="img-fluid" src="assets/images/image3.jpeg"/>
                            <div class="details">
                                <h2>Extremely Awesome Shoes</h2>
                                <button class="text-uppercase">Shop Now</button>
                            </div>
                        </div>
        
            
                    <!--two-->
                    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                            <img class="img-fluid" src="assets/images/image4.jpeg"/>
                            <div class="details">
                                <h2>50% OFF watches</h2>
                                <button class="text-uppercase">Shop Now</button>
                            </div>
                        </div>
                    
            
                    <!--three-->
                    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                            <img class="img-fluid" src="assets/images/image5.jpeg"/>
                            <div class="details">
                                <h2>Awesome Jacket</h2>
                                <button class="text-uppercase">Shop Now</button>
                            </div>
                        </div>
                    </div>
                
            </section>
      

</section> 



<!-- Feature Section -->

<section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
          <h3>Our Featured</h3>
          <hr>
          <p>Here you can check our new featured product</p>
        </div>
        <div class="container">
          <div class="row">
      <?php include('server/get_featured_product.php') ?>
      <?php while($row = $featured_products-> fetch_assoc()) {?>

      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/images/<?php echo $row ['product_image1'] ;   ?>">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name"><?php echo $row ['product_name'] ;   ?></h5>
        <h4 class="p-price">XAF <?php echo $row ['product_price'] ;   ?></h4>
        <a href="single-product.php?product_id=<?php echo $row['product_id']; ?>" class="buy-btn">Buy Now</a>

      </div>




      <?php } ?>
 </section>





<!-- banner-->

<section id="banner" class="my-5 py-5">
  <div class="container">
    <h4>MID SEASONS SALE</h4>
    <h1>Autumn collection <br> UP to 30% OFF</h1>
    <button class="text-uppercase">shop now</button>
  </div>
</section>


<!-- clothes-->


<section id="featured" class="my-5 ">
  <div class="container text-center mt-5 py-5">
    <h3>Dresses & Coats</h3>
    <hr>
    <p>Here you can check our amazing clothes</p>
  </div>
  <div class="row mx-auto container-fluid">
    <!-- Include the coats products -->
    <?php include('server/get_coats.php'); ?>
    <?php while ($row = $coats_products->fetch_assoc()) { ?>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/images/<?php echo $row['product_image1']; ?>" />
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
        <h4 class="p-price">XAF <?php echo $row['product_price']; ?></h4>
        <a href="single-product.php?product_id=<?php echo $row['product_id']; ?>" class="buy-btn">Buy Now</a>
      </div>
    <?php } ?>
  </div>
</section>
 

<!-- watches-->
<section id="featured" class="my-5 ">
  <div class="container text-center mt-5 py-5">
    <h3>watches</h3>
    <hr>
    <p>Here you can check our best watches</p>
  </div>
  <div class="row mx-auto container-fluid">
  <?php include('server/get_watches.php'); ?>
  <?php while ($row = $coats_products->fetch_assoc()) { ?>
    <!-- Product 1 -->
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/images/<?php echo $row['product_image1']; ?>">
      <div class="star">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
        <h4 class="p-price">XAF <?php echo $row['product_price']; ?></h4>
        <a href="single-product.php?product_id=<?php echo $row['product_id']; ?>" class="buy-btn">Buy Now</a>
      </div>
    <?php } ?>
    </div>
    </section>

    <!-- Product 2 -->
    <!-- <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/images/watches1 (2).jpeg">
      <div class="star">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name">watches</h5>
      <h4 class="p-price">XAF100</h4>
      <button class="buy-btn">Buy Now</button>
    </div> -->

    <!-- Product 3 -->
    <!-- <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/images/watches1 (3).jpeg">
      <div class="star">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name">watches</h5>
      <h4 class="p-price">XAF100</h4>
      <button class="buy-btn">Buy Now</button>
    </div> -->

    <!-- Product 4 -->
    <!-- <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/images/watches1 (4).jpeg">
      <div class="star">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name">watches</h5>
      <h4 class="p-price">XAF100</h4>
      <button class="buy-btn">Buy Now</button>
    </div>
  </div> -->



<!-- shoes-->
<section id="featured" class="my-5 ">
  <div class="container text-center mt-5 py-5">
    <h3>Shoes</h3>
    <hr>
    <p>Here you can check our amazing Shoes</p>
  </div>
  <div class="row mx-auto container-fluid">
    <!-- Product 1 -->
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/images/shoes1 (1).jpeg ">
      <div class="star">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name">Shoes</h5>
      <h4 class="p-price">XAF100</h4>
      <button class="buy-btn">Buy Now</button>
    </div>

    <!-- Product 2 -->
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/images/shoes1 (2).jpeg">
      <div class="star">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name">Shoes</h5>
      <h4 class="p-price">XAF100</h4>
      <button class="buy-btn">Buy Now</button>
    </div>

    <!-- Product 3 -->
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/images/shoes1 (3).jpeg">
      <div class="star">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name">Shoes</h5>
      <h4 class="p-price">XAF100</h4>
      <button class="buy-btn">Buy Now</button>
    </div>

    <!-- Product 4 -->
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/images/shoes1 (4).jpeg">
      <div class="star">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name">Shoes</h5>
      <h4 class="p-price">XAF100</h4>
      <button class="buy-btn">Buy Now</button>
    </div>
  </div>
</section>




<?php include('layouts/footer.php');?>