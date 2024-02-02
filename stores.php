<?php
include 'navbar.php';
include 'config.php';

// Fetching store locations
$storeSql = "SELECT id, img1, caption1, img2, caption2, img3, caption3 FROM stores_locations ORDER BY id DESC LIMIT 1";
$storeResult = $conn->query($storeSql);

$staffImages = array();
$staffSql = "SELECT * FROM stores_staff ORDER BY id DESC LIMIT 1";
$staffResult = mysqli_query($conn, $staffSql);

if ($row = mysqli_fetch_assoc($staffResult)) {
    for ($i = 1; $i <= 10; $i++) {
        $staffImages[$i] = $row["img$i"];
    }
}

mysqli_free_result($staffResult);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stylestores.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="titulli">
        <p>Our Stores</p>
    </div>
    <div class="stores">
        <?php
        if ($storeResult) {
            if ($storeResult->num_rows > 0) {
                $row = $storeResult->fetch_assoc();
                echo '<div>';
                echo '<img src="' . $row['img1'] . '" alt="">';
                echo '<div class="store-info">';
                echo '<a>' . $row['caption1'] . '</a>';
                echo '</div>';
                echo '</div>';

                echo '<div>';
                echo '<img src="' . $row['img2'] . '" alt="">';
                echo '<div class="store-info">';
                echo '<a>' . $row['caption2'] . '</a>';
                echo '</div>';
                echo '</div>';

                echo '<div>';
                echo '<img src="' . $row['img3'] . '" alt="">';
                echo '<div class="store-info">';
                echo '<a>' . $row['caption3'] . '</a>';
                echo '</div>';
                echo '</div>';
            } else {
                echo 'No stores found.';
            }
        } else {
            die("Error in SQL query: " . $conn->error);
        }

        $conn->close();
        ?>
    </div>
    <div class="Titulli">
        <p> Our Staff</p>
    </div>
    <div class="store-intro">
        <p>Welcome to our world of quality and style. Our stores, nestled in diverse communities, offer an inviting experience where modern aesthetics meet timeless elegance.
            <br>Explore curated products reflecting our commitment to excellence, guided by our knowledgeable staff.
        </p>
    </div>
    <div class="staffcontainer">
        <div class="staff1">
            <img src="uploaded_staff_images/<?php echo $staffImages[1]; ?>" alt="Image 1" />
            <img src="uploaded_staff_images/<?php echo $staffImages[2]; ?>" alt="Image 2" />
        </div>

        <div class="staff2">
            <div><img src="uploaded_staff_images/<?php echo $staffImages[3]; ?>" alt=""></div>
            <div><img src="uploaded_staff_images/<?php echo $staffImages[4]; ?>" alt=""></div>
        </div>

        <div class="staff3">
            <div><img src="uploaded_staff_images/<?php echo $staffImages[5]; ?>" alt=""></div>
            <div><img src="uploaded_staff_images/<?php echo $staffImages[6]; ?>" alt=""></div>
        </div>

        <div class="staff2">
            <div><img src="uploaded_staff_images/<?php echo $staffImages[7]; ?>" alt=""></div>
            <div><img src="uploaded_staff_images/<?php echo $staffImages[8]; ?>" alt=""></div>
        </div>

        <div class="staff1">
            <div><img src="uploaded_staff_images/<?php echo $staffImages[9]; ?>" alt=""></div>
            <div><img src="uploaded_staff_images/<?php echo $staffImages[10]; ?>" alt=""></div>
        </div>
    </div>

    <div class="footer">
        <h2>Questions? Call 044-620328</h2>
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
