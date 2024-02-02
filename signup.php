<?php
class SignUp {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function handleSignUp() {
        if(isset($_POST['submit'])){
            $username = $_POST['user'];
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $cpassword = $_POST['cpass'];
            
            $sql= "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($this->conn, $sql);
            $count_user = mysqli_num_rows($result);
            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($this->conn, $sql);
            $count_email = mysqli_num_rows($result);
            
            if($count_user == 0 || $count_email == 0){
                if($password == $cpassword){
                    $role = "user";
                    
                    if($username == "erjon" && $password == "erjonbosi"){
                        $role = "admin1";
                    } elseif($username == "rion" && $password == "rionmuti"){
                        $role = "admin2";
                    }
    
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    
                    $sql = "INSERT INTO users(username, email, password, role) VALUES('$username','$email', '$hash', '$role')";
                    $result = mysqli_query($this->conn, $sql);
                    
                    if($result){
                        $this->redirectWithMessage("Hi $username! Signup is successful!", "projekti.php");
                    } else {
                        $this->redirectWithMessage("Signup failed. Please try again.", "signup.php");
                    }
                }
                else{
                    $this->redirectWithMessage("Passwords do not match!!!", "signup.php");
                }
            }
            else{
                $this->redirectWithMessage("Account already exists!!!", "signup.php");
            }
        }
    }

    private function redirectWithMessage($message, $location) {
        echo '<script>
                alert("' . $message . '");
                window.location.href = "' . $location . '";
            </script>';
        exit();
    }
}

include "connection.php"; 

$signUpHandler = new SignUp($conn);
$signUpHandler->handleSignUp();
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
