<?php
if(isset($_POST['submit'])){
  include "connection.php";
    $username  = mysqli_real_escape_string($conn, $_POST['user']);
    $password  = mysqli_real_escape_string($conn, $_POST['pass']);
    
    $sql = "select * from users where username  = '$username' or email = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if($row){
    if(password_verify($password, $row['password'])){
      header("Location: welcome.php");
    }
  }
  else{
    echo '<script>
      alert("Invalid username or password!!");
      window.location.href = "login.php"
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
    
    <div id  = "form" ></div>
    <h1>Login form</h1>
    <form name ="form" action ="login.php"  method ="POST">
        <label > Enter Username/Email</label>   
        <input type="text" id = "user" name = "user" required><br><br>
        <label >Enter Password</label>
        <input type="password" id = "pass" name = "pass" required><br><br>   
        <input type="submit" id ="btn" value ="login" name = "submit"/>

   </body>
</html>