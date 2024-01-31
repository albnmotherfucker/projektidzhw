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
            // Define default role
            $role = "user";
            
            // Check for specific usernames and passwords to set roles
            if($username == "erjon" && $password == "erjonbosi"){
                $role = "admin1";
            } elseif($username == "rion" && $password == "rionmuti"){
                $role = "admin2";
            }

            // Hash the password
            $hash = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert data into the users table
            $sql = "insert into users(username, email, password, role) values('$username','$email', '$hash', '$role')";
            $result = mysqli_query($conn,$sql);
            
            if($result){
                echo '<script>
                    alert("Hi ' . $username . '! Signup is successful!");
                    window.location.href = "projekti.php";
                </script>';
            } else {
                echo '<script>
                    alert("Signup failed. Please try again.");
                    window.location.href = "signup.php";
                </script>';
            }
        }
        else{
            echo '<script>
                alert("Passwords do not match!!!");
                window.location.href = "signup.php";
            </script>';
        }
    }
    else{
        echo '<script>
            alert("Account already exists!!!");
            window.location.href = "signup.php";
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
    <h1>Sign Up</h1>
    <form name="form" action="signup.php" method="POST">
        <input type="text" id="user" name="user" required placeholder="Enter Username"><br><br>
        <input type="email" id="email" name="email" required placeholder="Enter Email"><br><br>
        <input type="password" id="pass" name="pass" required placeholder="Enter Password"><br><br>
        <input type="password" id="cpass" name="cpass" required pattern=".{8,}" title="Password must be at least 8 characters long" placeholder="Retype Password"><br><br>
        <input type="submit" id="btn" value="Sign Up" name="submit"/>
    </form>
</div>

     </body>
</html>
