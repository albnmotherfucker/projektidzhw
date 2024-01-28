
<div class="header" id="myHeader" >
        <nav>
    <a href="projekti.php"><img src="luciano_main-350x120 (1).png" class="logo"></a> 
            <div>
                <a href="main_admin.php"><button>MAIN PAGE</button></a>
                <a href="admin_page.php"><button>PRODUCTS PAGE</button></a>
                <a href="about_admin.php"><button>ABOUT US</button></a>
            </div>
        </nav>
    </div>
    
    <style>
     * {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
    box-sizing: border-box;
}

body {
    background-color: #000000;
    color: #fff;
}

.header {
    background-color: rgba(0, 0, 0, 0);
    position: fixed;
    top: 0;
    width: 100%;
    height: 100px;
    background-size: cover;
    background-position: center;
    padding: 10px 15px;
    z-index: 10000;
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
    background-color: white;
    color: black;
    transform: scaleX(20px);
    transition: all 0.5s ease;
}

    </style>
    