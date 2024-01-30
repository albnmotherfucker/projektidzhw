<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'cart_db';

$conn = mysqli_connect($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $caption1 = $conn->real_escape_string($_POST["caption1"]);
    $caption2 = $conn->real_escape_string($_POST["caption2"]);
    $caption3 = $conn->real_escape_string($_POST["caption3"]);
    $caption4 = $conn->real_escape_string($_POST["caption4"]);
    $caption5 = $conn->real_escape_string($_POST["caption5"]);

    $deleteQuery = "DELETE FROM about WHERE caption1 = '$caption1' OR caption2 = '$caption2' OR caption3 = '$caption3' OR caption4 = '$caption4' OR caption5 = '$caption5'";
    $conn->query($deleteQuery);

    
    $sql = "INSERT INTO about (caption1, caption2, caption3, caption4, caption5) VALUES ('$caption1', '$caption2', '$caption3', '$caption4', '$caption5')";

    if ($conn->query($sql) === TRUE) {
        $message = "Caption successfully submitted!";
        header("Location: about_upload.php");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
