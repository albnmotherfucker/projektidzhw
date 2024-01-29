<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'cart_db';

$conn = mysqli_connect('localhost', 'root', '', 'cart_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $caption_id1 = $_POST["caption_id1"];
    $caption_id2 = $_POST["caption_id2"];

    $caption_id1 = $conn->real_escape_string($caption_id1);
    $caption_id2 = $conn->real_escape_string($caption_id2);

  
    $deleteQuery = "DELETE FROM projekticaption WHERE caption_id1 = '$caption_id1' OR caption_id2 = '$caption_id2'";
    $conn->query($deleteQuery);

  
    $sql = "INSERT INTO projekticaption (caption_id1, caption_id2) VALUES ('$caption_id1', '$caption_id2')";

    if ($conn->query($sql) === TRUE) {
        echo "Caption successfully submitted!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
`