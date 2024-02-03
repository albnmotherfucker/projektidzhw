<?php

@include 'config.php';

class ProductUpdater {
    private $conn;
    private $message = [];

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function updateProduct($id) {
        if (isset($_POST['update_product'])) {
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_FILES['product_image']['name'];
            $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
            $product_image_folder = 'uploaded_img/' . $product_image;

            if (empty($product_name) || empty($product_price) || empty($product_image)) {
                $this->message[] = 'Please fill out all fields!';
            } else {
                $update_data = "UPDATE products SET name='$product_name', price='$product_price', image='$product_image'  WHERE id = '$id'";
                $upload = mysqli_query($this->conn, $update_data);

                if ($upload) {
                    move_uploaded_file($product_image_tmp_name, $product_image_folder);
                    header('location:admin_page.php');
                } else {
                    $this->message[] = 'Error updating product!';
                }
            }
        }
    }

    public function showMessage() {
        if (isset($this->message)) {
            foreach ($this->message as $message) {
                echo '<span class="message">' . $message . '</span>';
            }
        }
    }

    public function fetchProductData($id) {
        $select = mysqli_query($this->conn, "SELECT * FROM products WHERE id = '$id'");
        while ($row = mysqli_fetch_assoc($select)) {
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <h3 class="title">Update the product</h3>
                <input type="text" class="box" name="product_name" value="<?php echo $row['name']; ?>" placeholder="Enter the product name">
                <input type="number" min="0" class="box" name="product_price" value="<?php echo $row['price']; ?>" placeholder="Enter the product price">
                <input type="file" class="box" name="product_image" accept="image/png, image/jpeg, image/jpg">
                <input type="submit" value="Update product" name="update_product" class="btn">
                <a href="admin_page.php" class="btn">Go back!</a>
            </form>
            <?php
        }
    }
}

$productUpdater = new ProductUpdater($conn);
$productUpdater->updateProduct($_GET['edit']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
    $productUpdater->showMessage();
?>

<div class="container">
    <div class="admin-product-form-container centered">
        <?php
        $productUpdater->fetchProductData($_GET['edit']);
        ?>
    </div>
</div>

</body>
</html>

<?php
$productUpdater->closeConnection();
?>
 