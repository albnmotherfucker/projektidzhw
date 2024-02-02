<?php
include 'config.php';
include 'navbaradmin.php';

class ProductManager
{
    private $conn;
    private $message;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addOrUpdateProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
            $targetDir = "uploaded_img/";

            for ($i = 1; $i <= 3; $i++) {
                $imageName = "image$i";
                $captionName = "product_caption$i";

                $image = $_FILES[$imageName]['name'];
                $caption = $_POST[$captionName];

                move_uploaded_file($_FILES[$imageName]['tmp_name'], $targetDir . $image);

                $checkEmptySql = "SELECT COUNT(*) as rowCount FROM stores_locations";
                $checkEmptyResult = mysqli_query($this->conn, $checkEmptySql);

                if (!$checkEmptyResult) {
                    $this->message = "Error checking data: " . mysqli_error($this->conn);
                } else {
                    $row = mysqli_fetch_assoc($checkEmptyResult);
                    $rowCount = $row['rowCount'];

                    if ($rowCount > 0) {
                        $updateSql = "UPDATE stores_locations SET img$i = '$image', caption$i = '$caption'";
                        $result = mysqli_query($this->conn, $updateSql);

                        if (!$result) {
                            $this->message = "Error updating data: " . mysqli_error($this->conn);
                        }
                    } else {
                        $insertSql = "INSERT INTO stores_locations (img$i, caption$i) VALUES ('$image', '$caption')";
                        $result = mysqli_query($this->conn, $insertSql);

                        if (!$result) {
                            $this->message = "Error inserting data: " . mysqli_error($this->conn);
                        }
                    }
                }
            }

            if (empty($this->message)) {
                $this->message = "Data added or updated successfully!";
            }
        }
    }

    public function getMessage()
    {
        return $this->message;
    }
}

$productManager = new ProductManager($conn);
$productManager->addOrUpdateProduct();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin page</title>
    <link rel="stylesheet" href="stili.css">
    <style>
        body {
            color: black;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="admin-product-form-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <label for="img<?php echo $i; ?>">Image <?php echo $i; ?>:</label>
                <input type="file" name="image<?php echo $i; ?>" id="img<?php echo $i; ?>" required class="box">
                <input type="text" placeholder="enter store's caption <?php echo $i; ?>" name="product_caption<?php echo $i; ?>" class="box">
            <?php endfor; ?>

            <input type="submit" class="btn" name="add_product" value="Add Product">
        </form>
    </div>
</div>

<div class="footer">
    <h2>Questions? Call 044-620328</h2>
</div>

</body>
</html>
