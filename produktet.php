<?php
@include 'config.php';

$productsPerPage = 24;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$startIndex = ($page - 1) * $productsPerPage;

$result = mysqli_query($conn, "SELECT * FROM products LIMIT $startIndex, $productsPerPage");
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product Page</title>
   <link rel="stylesheet" href="style.css">
   <style>
      .product img {
         width: 200px;
         height: 200px;
      }
   </style>
</head>

<body>
   <div class="header" id="myHeader" style="background-color: black;">
      <nav>
         <a href="projekti.html"><img src="luciano_main-350x120 (1).png" class="logo"></a>
         <div>
            <a href="produktet.php"><button>Products</button></a>
            <a href="about.php"><button>About Us</button></a>
            <a href="signup.php"><button>Sign Up</button></a>
         </div>
      </nav>
   </div>

   <div class="visit">
      <p style="font-size: 25px; margin-left: 35px;">Discover our collection</p>
   </div>

   <div class="product-container">
      <?php
      foreach ($products as $product) {
      ?>
         <div class="product">
            <img src="<?php echo 'uploaded_img/' . $product['image']; ?>" alt="Product Image">
            <div class="kocka">
               <h3><?php echo $product['name']; ?></h3>
               <p>Price: <?php echo $product['price']; ?>€</p>
            </div>
         </div>
      <?php
      }
      ?>
   </div>

   <div class="pagination">
      <?php
      $totalProducts = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products"));
      $totalPages = ceil($totalProducts / $productsPerPage);

      for ($i = 1; $i <= $totalPages; $i++) {
         echo '<a href="produktet.php?page=' . $i . '">' . $i . '</a> ';
      }
      ?>
   </div>
   <div class="footer">
        <h2>Questions? call 044-620328</h2>
        <div class="row">
            <div class="col">
                <a href="#">FAQ</a>
                <a href="#">Investor Relations</a>
                <a href="#">Privacy</a>
                <a href="#">Speed test</a>
            </div>
            <div class="col">
                <a href="#">Help Center</a>
                <a href="#">Jobs</a>
                <a href="#">Cookies Preferences</a>
                <a href="#">Legal Notices</a>
            </div>
            <div class="col">
                <a href="#">Account</a>
                <a href="#">Ways to buy</a>
                <a href="#">Information</a>
                <a href="#">Only in Lucioano</a>
            </div>
            <div class="col">
                <a href="#">Media center</a>
                <a href="#">Terms of use</a>
                <a href="#">Contact us</a>
            </div>
        </div>
    </div>
   
</body>

</html>