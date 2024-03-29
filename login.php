<?php
session_start();
class Database {
    private $conn;

    public function __construct($localhost, $username, $password, $database) {
        $this->conn = new mysqli($localhost, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUserByUsernameOrEmail($username) {
        $username = mysqli_real_escape_string($this->conn, $username);
        $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$username'";
        $result = mysqli_query($this->conn, $sql);

        if (!$result) {
            die("Error executing query: " . mysqli_error($this->conn));
        }

        return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
}

class Authentication {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function authenticate($username, $password) {
        $user = new User($this->conn);
        $row = $user->getUserByUsernameOrEmail($username);
    
        if ($row && password_verify($password, $row['password'])) {
            // Check if the username is 'erjon' or 'rion' and password matches
            if (($username == 'erjon' && $password == 'erjonbosi') || ($username == 'rion' && $password == 'rionmuti')) {
                $role = ($username == 'erjon') ? 'admin1' : 'admin2';
                $this->updateUserRole($row['id'], $role);
                header("Location: admin_page.php?admin=$role");
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
    

    private function updateUserRole($userId, $role) {
        $userId = mysqli_real_escape_string($this->conn, $userId);
        $role = mysqli_real_escape_string($this->conn, $role);
        $sql = "UPDATE users SET role = '$role' WHERE id = '$userId'";
        $result = mysqli_query($this->conn, $sql);

        if (!$result) {
            die("Error updating user role: " . mysqli_error($this->conn));
        }
    }
}

$conn = mysqli_connect('localhost', 'root', '', 'cart_db');
$database = new Database('localhost', 'root', '', 'cart_db');
$conn = $database->getConnection();

$authentication = new Authentication($conn);

if (isset($_POST['submit'])) {
    $authentication->authenticate($_POST['user'], $_POST['pass']);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rioni</title>
    <link rel="stylesheet" href="loginstyle.css"> <?php include "header.php";?>
</head>
<body>
   
    
    <div id="form">
        <h1>Log In</h1>
        <form name="form" action="login.php" method="POST">
            <input type="text" id="user" name="user" required placeholder="Enter Username"><br><br>
            <input type="password" id="pass" name="pass" required placeholder="Enter Password"><br><br>
            <input type="submit" id="btn" value="Log In" name="submit"/>
        </form>

        <p>Don't have an account? </p>
        <br>
        <a id="logi" href="signup.php">Sign Up</a>
    </div>
</body>
</html>