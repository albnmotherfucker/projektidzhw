<?php

class StorePage {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getLatestStore() {
        $storeSql = "SELECT id, img1, caption1, img2, caption2, img3, caption3 FROM stores_locations ORDER BY id DESC LIMIT 1";
        $storeResult = $this->conn->query($storeSql);

        if ($storeResult && $storeResult->num_rows > 0) {
            return $storeResult->fetch_assoc();
        } else {
            return null;
        }
    }

    public function getLatestStaffImages() {
        $staffImages = array();
        $staffSql = "SELECT * FROM stores_staff ORDER BY id DESC LIMIT 1";
        $staffResult = mysqli_query($this->conn, $staffSql);

        if ($row = mysqli_fetch_assoc($staffResult)) {
            for ($i = 1; $i <= 10; $i++) {
                $staffImages[$i] = $row["img$i"];
            }
        }
        mysqli_free_result($staffResult);

        return $staffImages;
    }

    public function render() {
        $storeInfo = $this->getLatestStore();
        $staffImages = $this->getLatestStaffImages();

        $this->renderHeader();
        $this->renderStores($storeInfo);
        $this->renderStaffIntroduction();
        $this->renderStaffImages($staffImages);
        $this->renderFooter();
    }

    private function renderHeader() {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="stylestores.css">
            <link rel="stylesheet" href="style.css">
            <?php include 'header.php'?>
        </head>
        <body>
            <div class="titulli">
                <p  >Our Stores</p>
            </div>
            <div class="stores">
        <?php
    }

    private function renderStores($storeInfo) {
        if ($storeInfo) {
            echo '<div>';
            echo '<img src="' . $storeInfo['img1'] . '" alt="">';
            echo '<div class="store-info">';
            echo '<a>' . $storeInfo['caption1'] . '</a>';
            echo '</div>';
            echo '</div>';

            echo '<div>';
            echo '<img src="' . $storeInfo['img2'] . '" alt="">';
            echo '<div class="store-info">';
            echo '<a>' . $storeInfo['caption2'] . '</a>';
            echo '</div>';
            echo '</div>';

            echo '<div>';
            echo '<img src="' . $storeInfo['img3'] . '" alt="">';
            echo '<div class="store-info">';
            echo '<a>' . $storeInfo['caption3'] . '</a>';
            echo '</div>';
            echo '</div>';
        } else {
            echo 'No stores found.';
        }
    }

    private function renderStaffIntroduction() {
        ?>
            </div>
            <div class="titulli">
                <p> Our Staff</p>
            </div>
            <div class="store-intro">
                <p>Welcome to our world of quality and style. Our stores, nestled in diverse communities, offer an inviting experience where modern aesthetics meet timeless elegance.
                    <br>Explore curated products reflecting our commitment to excellence, guided by our knowledgeable staff.
                </p>
            </div>
            <div class="staffcontainer">
        <?php
    }

    private function renderStaffImages($staffImages) {
        echo '<div class="staff1">';
        for ($i = 1; $i <= 2; $i++) {
            echo '<img src="uploaded_staff_images/' . $staffImages[$i] . '" alt="Image ' . $i . '" />';
        }
        echo '</div>';

        echo '<div class="staff2">';
        for ($i = 3; $i <= 4; $i++) {
            echo '<div><img src="uploaded_staff_images/' . $staffImages[$i] . '" alt=""></div>';
        }
        echo '</div>';

        echo '<div class="staff3">';
        for ($i = 5; $i <= 6; $i++) {
            echo '<div><img src="uploaded_staff_images/' . $staffImages[$i] . '" alt=""></div>';
        }
        echo '</div>';

        echo '<div class="staff2">';
        for ($i = 7; $i <= 8; $i++) {
            echo '<div><img src="uploaded_staff_images/' . $staffImages[$i] . '" alt=""></div>';
        }
        echo '</div>';

        echo '<div class="staff1">';
        for ($i = 9; $i <= 10; $i++) {
            echo '<div><img src="uploaded_staff_images/' . $staffImages[$i] . '" alt=""></div>';
        }
        echo '</div>';
    }

    private function renderFooter() {
        ?>
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
        <?php
    }
}

include 'config.php';

$storePage = new StorePage($conn);
$storePage->render();

$conn->close();

?>
