<?php

@include 'config.php';

class ProductPage {
    private $conn;
    private $productsPerPage;

    public function __construct($conn, $productsPerPage) {
        $this->conn = $conn;
        $this->productsPerPage = $productsPerPage;
    }

    public function getProducts() {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $startIndex = ($page - 1) * $this->productsPerPage;

        $result = mysqli_query($this->conn, "SELECT * FROM products LIMIT $startIndex, $this->productsPerPage");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function displayPagination() {
        $totalProducts = mysqli_num_rows(mysqli_query($this->conn, "SELECT * FROM products"));
        $totalPages = ceil($totalProducts / $this->productsPerPage);

        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<a href="produktet.php?page=' . $i . '">' . $i . '</a> ';
        }
    }

    public function closeConnection() {
        mysqli_close($this->conn);
    }
}

$productsPerPage = 24;
$conn = mysqli_connect('localhost', 'root', '', 'cart_db');

$productPage = new ProductPage($conn, $productsPerPage);
$products = $productPage->getProducts();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link rel="stylesheet" href="style.css">
    <?php include 'header.php'?>
    <style>
        .product img {
            width: 200px;
            height: 200px;
        }
    </style>
</head>

<body>
    

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
        $productPage->displayPagination();
        ?>
    </div>

    <style>
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination a {
        text-decoration: none;
        padding: 7px 10px;
        margin: 0 5px;
        border: 1px solid #000;
        border-radius: 5px;
        background-color: #fff;
        
    }
</style>


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

<?php
$productPage->closeConnection();
?>
