<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="java.js" defer></script>
    <style>
        body {
            background-color: #000000;
            color: #fff;
        }

        .header {
            background-color: rgba(0, 0, 0, 0);
            border: solid 1;
            position: fixed;
            top: 0;
            width: 100%;
            height: 100px;
            background-size: cover;
            background-position: center;
            padding: 10px 15px;
            transition: all 0.2s ease;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 10px;
        }

        .logo {
            width: 170px;
            cursor: pointer;
            margin-left: 10px;
        }

        .logo:hover {
            transform: scale(1.1);
            transition: all 0.5s ease;
        }

        nav button {
            border: 0;
            outline: 0;
            padding: 8px 16px;
            font-size: 16px;
            border-radius: 10px;
            margin-left: 10px;
            cursor: pointer;
            background-color: transparent;
            color: white;
        }

        nav button:hover {
            background-color: rgb(37, 35, 35);
            color: #ffffff;
            transform: scaleX(15px);
            transition: all 0.5s ease;
        }

        .hamburger-icon {
            font-size: 24px;
            cursor: pointer;
            margin-right: 10px;
            display: none;
        }

        @media only screen and (max-width: 600px) {
            .hamburger-icon {
                display: block;
            }

            nav div {
                display: none;
            }

            nav div.show-nav {
                display: flex;
                flex-direction: column;
                position: absolute;
                top: 80px; 
                right: 0;
                background-color: #000;
                width: 100%;
            }
        }
    </style>
   <script>
    document.addEventListener("DOMContentLoaded", function () {
        var hamburgerIcon = document.querySelector(".header nav .hamburger-icon");
        var buttonsContainer = document.querySelector(".header nav div");

        hamburgerIcon.addEventListener("click", function () {
            buttonsContainer.classList.toggle("show-nav");
        });
    });
</script>

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
        <div class="hamburger-icon">&#9776;</div>
    </nav>
</div>

</body>
</html>
