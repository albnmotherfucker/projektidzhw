<?php
if(isset($_POST['submit'])){
    include "connection.php";
    
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    
    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($row && password_verify($password, $row['password'])) {
        if ($username == 'erjon' && $password == 'erjonbosi') {
            header("Location: admin_page.php");
            exit();
        } else {
            header("Location: projekti.php");
            exit();
        }
    } else {
        echo '<script>
            alert("Invalid username or password!!");
            window.location.href = "login.php";
        </script>';
    }
} 
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rioni</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>
    <?php include "navbar.php";?>
    
    <div id="form">
        <h1>Log In</h1>
        <form name="form" action="login.php" method="POST">
            <input type="text" id="user" name="user" required placeholder="Enter Username"><br><br>
            <input type="password" id="pass" name="pass" required placeholder="Enter Password"><br><br>
            <input type="submit" id="btn" value="Log In" name="submit"/>
            
        </form>

        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>  

    </div>
</body>
</html>