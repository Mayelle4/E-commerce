<?php 

include ('server/connection.php');

if (isset($_GET['product_id'])){

  $product_id= $_GET['product_id'];


$stmt = $conn->prepare("SELECT * FROM products WHERE product_id=? LIMIT 1");
$stmt->bind_param("i", $product_id);

$stmt->execute();


$product = $stmt->get_result();



  //no product id//

}else{
  header('location:index.php');
}




?>


<?php include('layouts/header.php');?>


<!-- single product -->
 

    <section class="container single-product my-5 pt-5 text-black">
        <div class="row mt-5">

<?php while ($row=$product->fetch_assoc()){ ?>

          <div class="col-lg-6 col-md-6 col-sm-12">
            <img class="img-fluid w-100 pb-1" src="assets/images/<?php echo $row['product_image1'];?>" id="mainImg" />
      
            <div class="small-img-group d-flex">
              <div class="small-img-col">
                <img src="assets/images/<?php echo $row['product_image2'];?>" width="100%" class="small-img" />
              </div>
              <div class="small-img-col">
                <img src="assets/images/<?php echo $row['product_image2'];?>" width="100%" class="small-img" />
              </div>
              <div class="small-img-col">
                <img src="assets/images/<?php echo $row['product_image3'];?>" width="100%" class="small-img" />
              </div>
              <div class="small-img-col">
                <img src="assets/images/<?php echo $row['product_image4'];?>" width="100%" class="small-img" />
              </div>
            </div>
          </div>


    <div class="col-lg-6  col-md-6 col-12" style="margin-top: 90px;">
    <h6>Men/Shoes</h6>
     <h3 class="py-3"><?php echo $row['product_name'];?></h3>
    <h2>XAF<?php echo $row['product_price'];?></h2>

    <form method="POST" action="card.php">
        <input type="hidden" name="product_id" value="<?php echo $row['product_id'];?>"/>
        <input type="hidden" name="product_image" value="<?php echo $row['product_image1'];?>"/>
        <input type="hidden" name="product_name" value="<?php echo $row['product_name'];?>"/>
        <input type="hidden" name="product_price" value="<?php echo $row['product_price'];?>"/>
        <input type="number" name="product_quantity" value="1"/>
        <button class="add-buy-btn" type="submit" name="add_to_cart">Add To Card</button>
    </form>

    <h4 class="mt-5 mb-5">Product details</h4>
    <span><?php echo $row['product_description'];?> </span>
   
</div>



        <?php }?>

        </div>
      </section>



<!-- related product -->

<section id="related-product" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>Related Product</h3>
    <hr>
  </div>
  <div class="row mx-auto container-fluid">
    <!-- Product 1 -->
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/images/featurea.jpeg">
      <div class="star">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name">Sport Shoes</h5>
      <h4 class="p-price">XAF100</h4>
      <button class="buy-btn">Buy Now</button>
    </div>

    <!-- Product 2 -->
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/images/featureb.jpeg">
      <div class="star">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name">Sport Shoes</h5>
      <h4 class="p-price">XAF100</h4>
      <button class="buy-btn">Buy Now</button>
    </div>

    <!-- Product 3 -->
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/images/feature1.jpeg">
      <div class="star">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name">Sport Shoes</h5>
      <h4 class="p-price">XAF100</h4>
      <button class="buy-btn">Buy Now</button>
    </div>

    <!-- Product 4 -->
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/images/featured.jpeg">
      <div class="star">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name">Sport Shoes</h5>
      <h4 class="p-price">XAF100</h4>
      <button class="buy-btn">Buy Now</button>
    </div>
  </div>
</section>

      




    <script>
     var mainImg = document.getElementById("mainImg");
      var smallImg = document.getElementsByClassName("small-img");


for(let i=0; i<4; i++){
    smallImg[i].onclick = function(){
        mainImg.src = smallImg[i].src;
      }
}
    

    </script>

<?php include('layouts/footer.php');?>
  

