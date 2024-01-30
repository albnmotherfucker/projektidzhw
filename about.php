<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'db_cart';
$conn = mysqli_connect('localhost', 'root', '', 'cart_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM about ORDER BY id DESC LIMIT 1");

if ($result) {
    $row = $result->fetch_assoc();
    $latestCaption1 = $row['caption1'];
    $latestCaption2 = $row['caption2'];
    $latestCaption3 = $row['caption3'];
    $latestCaption4 = $row['caption4'];
    $latestCaption5 = $row['caption5'];
} else {
    die("Error fetching captions: " . $conn->error);
}

$result = $conn->query("SELECT * FROM about_image ORDER BY id DESC LIMIT 1");

if ($result) {
    $row = $result->fetch_assoc();
    $image = $row['image'];

} else {
    die("Error fetching images: " . $conn->error);
}

$conn->close();




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="java.js" defer></script>
</head>

<body>
    <div class="header" id="myHeader">
        <nav>
            <a href="projekti.php"><img src="luciano_main-350x120 (1).png" class="logo"></a>
            <div>
                <a href="produktet.php"><button>Products</button></a>
                <a href="about.php"><button>About Us</button></a>
                <a href="login.php"><button>Log In</button></a>
            </div>
        </nav>
    </div>

    <div class="fotoabout">
    <img src="uploaded_img/<?php echo $image; ?>" alt="image">  
    </div>

    <div class="tekstiabout">
        <section id="sectionabout">
            <a id="aboutluciano">About Luciano</a>
            <br><br><br><br>
            <p><?php echo $latestCaption1; ?></p>
            <br><br>
            <h3>Unveiling Elegance</h3>
            <p><?php echo $latestCaption2; ?></p>
            <br><br>
            <h3>Unveiling Elegance</h3>
            <p><?php echo $latestCaption3; ?></p>
            <br><br>
            <h3>Unveiling Elegance</h3>
            <p><?php echo $latestCaption4; ?></p>
            <br><br>
            <h3>Unveiling Elegance</h3>
            <p><?php echo $latestCaption5; ?></p>
            <br><br>
        </section>
    </div>

    <div class="footer">
        <h2>Questions? call 048-620328</h2>
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

    <hr>
</body>

</html>
