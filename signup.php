<?php
if(isset($_POST['submit'])){
    include "connection.php";
    $username = $_POST['user'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $cpassword = $_POST['cpass'];
    
    $sql= "select * from users where username = '$username'";
    $result = mysqli_query($conn, $sql);
    $count_user = mysqli_num_rows($result);
    $sql = "select * from users where email='$email'";
    $result = mysqli_query($conn,$sql);
    $count_email = mysqli_num_rows($result);
    
    if($count_user==0 || $count_email==0){
        if($password==$cpassword){
            $hash = password_hash($password,PASSWORD_DEFAULT);
            $sql = "insert into users(username, email,password) values('$username','$email', '$hash')";
            $result = mysqli_query($conn,$sql);

        }
        else{
            echo'<script>
            alert(" passwords do not match!!!");
            window.location.href = "signup.php";
            </script>';
        }
    }
    else{
        echo'<script>
        alert("us   !!!");
        window.location.href = "index.php";
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
        <h1>Signup Form</h1>
        <form name="form" action="signup.php" method="POST">
            <label>Enter Username</label>
            <input type="text" id="user" name="user" required><br><br>
            <label>Enter Email</label>
            <input type="email" id="email" name="email" required><br><br>
            <label>Enter Password</label>
            <input type="password" id="pass" name="pass" required><br><br>
            <label>Retype Password</label>
            <input type="password" id="cpass" name="cpass" required><br><br>
            <input type="submit" id ="btn" value ="Signup" name = "submit"/>
        </form>
    </div>

     </body>
</html>