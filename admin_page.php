<?php

include 'config.php';
include 'navbaradmin.php';

class AdminPage
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addProduct()
    {
        if (isset($_POST['add_product'])) {
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_FILES['product_image']['name'];
            $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
            $product_image_folder = 'uploaded_img/' . $product_image;

            if (empty($product_name) || empty($product_price) || empty($product_image)) {
                $message[] = 'Please fill out all fields';
            } else {
                // Get the user's ID from the session or wherever you store it
                $createdBy = 1; // Replace with the actual user's ID

                $insert = "INSERT INTO products(name, price, image, created_at, created_by) VALUES('$product_name', '$product_price', '$product_image', NOW(), $createdBy)";
                $upload = mysqli_query($this->conn, $insert);

                if ($upload) {
                    move_uploaded_file($product_image_tmp_name, $product_image_folder);
                    $message[] = 'New product added successfully';

                    header('Location: ' . $_SERVER['PHP_SELF']);
                    exit();
                } else {
                    $message[] = 'Could not add the product';
                }
            }
        }
    }

    public function deleteProduct()
    {
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            mysqli_query($this->conn, "DELETE FROM products WHERE id = $id");
            header('location:admin_page.php');
            exit();
        }
    }

    public function displayProducts()
    {
        $select = mysqli_query($this->conn, "SELECT * FROM products");
        return $select;
    }

    public function showMessage()
    {
        if (isset($message)) {
            foreach ($message as $message) {
                echo '<span class="message">' . $message . '</span>';
            }
        }
    }
}

$adminPage = new AdminPage($conn);

$adminPage->addProduct();
$adminPage->deleteProduct();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>
   <link rel="stylesheet" href="stili.css">
</head>
<body>

<?php
if (isset($message)) {
   foreach ($message as $message) {
      echo '<span class="message">' . $message . '</span>';
   }
}
?>

<div class="container">
   <div class="admin-product-form-container">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
         <h3>add a new product</h3>
         <input type="text" placeholder="enter product name" name="product_name" class="box">
         <input type="number" placeholder="enter product price" name="product_price" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="add product">
      </form>
   </div>

   <?php
   $select = mysqli_query($conn, "SELECT * FROM products");
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>product image</th>
            <th>product name</th>
            <th>product price</th>
            <th>created at</th> <!-- New column -->
            <th>created by</th> <!-- New column -->
            <th>action</th>
         </tr>
         </thead>
         <?php while ($row = mysqli_fetch_assoc($select)) { ?>
            <tr>
               <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
               <td><?php echo $row['name']; ?></td>
               <td>€<?php echo $row['price']; ?>/-</td>
               <td><?php echo $row['created_at']; ?></td> <!-- New column -->
               <td><?php echo $row['created_by']; ?></td> <!-- New column -->
               <td>
                  <a href="admin_update.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
                  <a href="admin_page.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
               </td>
            </tr>
         <?php } ?>
      </table>
   </div>
</div>

<div class="footer">
   <link rel="stylesheet" href="style.css">
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
