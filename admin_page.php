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
            $product_changer = $_POST['product_changer'];
            $product_image = $_FILES['product_image']['name'];
            $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
            $product_image_folder = 'uploaded_img/' . $product_image;

            if (empty($product_name) || empty($product_price) || empty($product_image) || empty($product_changer)) {
                $message[] = 'Please fill out all fields';
            } else {
                $insert = "INSERT INTO products(name, price, image, changer) VALUES('$product_name', '$product_price', '$product_image', '$product_changer')";
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
         <input type="text" placeholder="enter your name" name="product_changer" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="add product">
      </form>
   </div>

   <?php
   $select = $adminPage->displayProducts();
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
            <tr>
                <th>product image</th>
                <th>product name</th>
                <th>product price</th>
                <th>created at</th> 
                <th>changer</th> 
                <th>action</th>
            </tr>
         </thead>
         <?php while ($row = mysqli_fetch_assoc($select)) { ?>
            <tr>
                <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                <td><?php echo $row['name']; ?></td>
                <td>€<?php echo $row['price']; ?>/-</td>
                <td><?php echo $row['created_at']; ?></td>
                <td><?php echo $row['changer']; ?></td>
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
        <!-- Rest of your footer HTML -->
    </div>
            
</body>
</html>
