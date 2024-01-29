<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'db_cart';
$conn = mysqli_connect('localhost', 'root', '', 'cart_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM projekticaption ORDER BY id DESC LIMIT 1");

if ($result) {
    $row = $result->fetch_assoc();
    $latestCaption_id1 = $row['caption_id1'];
    $latestCaption_id2 = $row['caption_id2'];
} else {
    die("Error fetching captions: " . $conn->error);
}

$result = $conn->query("SELECT * FROM sliderimage ORDER BY id DESC LIMIT 1");

if ($result) {
    $row = $result->fetch_assoc();
    $image1 = $row['img1'];
    $image2 = $row['img2'];
    $image3 = $row['img3'];
    $image4 = $row['img4'];
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
    
    <section class="container">
        <style>
            .slider-wrapper img {
                width: 100%;
                height: 100%;
            }
        </style>
    
        <div class="slider-wrapper">
            <div class="slider">
                <h1 id="helmi" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;"><?php echo $latestCaption_id1; ?></h1>
                
                <img id="slide-1" src="<?php echo $image1; ?>" alt="Image 1" />
                <img id="slide-2" src="<?php echo $image2; ?>" alt="Image 2" />
                <img id="slide-3" src="<?php echo $image3; ?>" alt="Image 3" />
            </div> 
            <div class="slider-nav">
                <a href="#slide-1"></a>
                <a href="#slide-2"></a>
                <a href="#slide-3"></a>
            </div>
        </div>
    </section>

    <div class="Pastaj">
        <div class="row">
            <div class="text-col">
                <h2 id="caption_id2"><?php echo $latestCaption_id2; ?></h2>
            </div>
            <div class="img-col">
                <a href="produktet.php"><img src="<?php echo $image4; ?>" ></a>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br> 

    <div class="faq">
        <h2>Frequently asked questions</h2>
        <ul class="acc">
            <li>
                <input type="radio" name="acc" id="first">
                <label for="first">Ku gjindemi ne?</label>
                <div class="content">
                    <p>Ne gjindemi në 3 vende kryesore:</p>
                    <p>Lokacioni i parë është në Bulevardin Nënë Tereza, Prishtina. Mund të gjeni më shumë informacione duke klikuar në <a href="https://maps.app.goo.gl/6zTp6uYUvM9eYvCR9">Bulevardi Nënë Tereza</a>.</p>
                    <p>Lokacioni i dytë është në Aktash. Informacione të mëtejshme mund t'i gjeni duke klikuar në <a href="https://maps.app.goo.gl/S27vvTBCGRVKX39P9">Aktashi</a>.</p>
                    <p>Lokacioni i tretë është në Prishtina Mall. </p> <a href="https://maps.app.goo.gl/19XLkYo9bNnKBpPX6">Prishtina Mall</a>
                </div>
            </li>
            <li>
                <input type="radio" name="acc" id="second">
                <label for="second">Cilat janë karakteristikat kryesore të kostumeve që ofron biznesi juaj?</label>
                <div class="content">
                    <p>
                        Ne ofrojmë këmisha të cilat kombinojnë elegancën klasike me stilin e modern. Për ne, çelësi i kostumeve është puna e kujdesshme në detaje, 
                        përdorimi i materialeve të larta dhe një gamë e gjerë dizajnesh që përshtaten për çdo ngjarje. Nga këmishat klasike deri te trendet e fundit, koleksionet tona shfaqin një bashkim të sofistikuar dhe të rehatshëm. 
                        Këmisha unike me ngjyra dhe motive, i japin një shenjë stil ndryshe. Ne besojmë në një përvojë blerje personale, 
                        duke siguruar që klientët tanë të ndihen të vetësigurt dhe të dalluar në zgjedhjet e tyre. Zbuloni kostumin perfekt për çdo moment tek ne!
                    </p>
                </div>
            </li>
            <li>
                <input type="radio" name="acc" id="third">
                <label for="third">Ç'kostum do të sugjeronit për trupin tim dhe rastin tim?</label>
                <div class="content">
                    <p>
                        Zbuloni kostume të personalizuara për fizikun tuaj dhe rastin në Lucioano. 
                        Nga stil slim-fit për elegancë moderne te stilet klasike për sharm të përgjithshëm, kemi kostumin perfekt për çdo moment. 
                        Dukejini sfilatë, ndihuni me vetëbesim - bleni tek ne sot.
                    </p>
                </div>
            </li>
            <li>
                <input type="radio" name="acc" id="fourth">
                <label for="fourth">Për çfarë dallon Lucioano nga dyqanet e tjera të kostumeve?</label>
                <div class="content">
                    <p>
                        Luciano dallon për përkushtimin tonë ndaj cilësisë dhe shërbimit të shkëlqyer. 
                        Ne vlerësojmë stilin, përpikmërinë, dhe ofrojmë një përvojë blerje unike që përshtatet çdo klienti.
                    </p>
                </div>
            </li>
        </ul>

        <div>
            <small id="small">Sign up with your email to get started.</small>
            <form class="email-signup" action="signup.php">
                <button type="submit">Get Started</button>
            </form>
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