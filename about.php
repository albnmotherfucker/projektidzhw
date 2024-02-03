<?php

class AboutPage {
    private $conn;
    private $latestCaption1;
    private $latestCaption2;
    private $latestCaption3;
    private $latestCaption4;
    private $latestCaption5;
    private $image;

    public function __construct($hostname, $username, $password, $database) {
        $this->conn = mysqli_connect($hostname, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function fetchData() {
        $this->fetchLatestCaptions();
        $this->fetchLatestImage();
    }

    private function fetchLatestCaptions() {
        $result = $this->conn->query("SELECT * FROM about ORDER BY id DESC LIMIT 1");

        if ($result) {
            $row = $result->fetch_assoc();
            $this->latestCaption1 = $row['caption1'];
            $this->latestCaption2 = $row['caption2'];
            $this->latestCaption3 = $row['caption3'];
            $this->latestCaption4 = $row['caption4'];
            $this->latestCaption5 = $row['caption5'];
        } else {
            die("Error fetching captions: " . $this->conn->error);
        }
    }

    private function fetchLatestImage() {
        $result = $this->conn->query("SELECT * FROM about_image ORDER BY id DESC LIMIT 1");

        if ($result) {
            $row = $result->fetch_assoc();
            $this->image = $row['image'];
        } else {
            die("Error fetching images: " . $this->conn->error);
        }
    }

    public function showPage() {
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
                        <a href="stores.php"><button>Stores</button></a>
                        <a href="about.php"><button>About Us</button></a>
                        <a href="login.php"><button>Log In</button></a>
                    </div>
                </nav>
            </div>

            <div class="fotoabout">
                <img src="uploaded_img/<?php echo $this->image; ?>" alt="image">  
            </div>

            <div class="tekstiabout">
                <section id="sectionabout">
                    <a id="aboutluciano">About Luciano</a>
                    <br><br><br><br>
                    <p><?php echo $this->latestCaption1; ?></p>
                    <br><br>
                    <p><?php echo $this->latestCaption2; ?></p>
                    <br><br>
                    <p><?php echo $this->latestCaption3; ?></p>
                    <br><br>
                    <p><?php echo $this->latestCaption4; ?></p>
                    <br><br>
                    <p><?php echo $this->latestCaption5; ?></p>
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
        <?php
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

$aboutPage = new AboutPage('localhost', 'root', '', 'cart_db');
$aboutPage->fetchData();
$aboutPage->showPage();
$aboutPage->closeConnection();
?>
