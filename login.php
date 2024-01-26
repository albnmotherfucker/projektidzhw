<?php

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
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function authenticate($username, $password) {
        $row = $this->user->getUserByUsernameOrEmail($username);

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
}
$conn = mysqli_connect('localhost', 'root', '', 'cart_db');
$database = new Database('localhost', 'root', '', 'cart_db');
$conn = $database->getConnection();

$user = new User($conn);
$authentication = new Authentication($user);

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
