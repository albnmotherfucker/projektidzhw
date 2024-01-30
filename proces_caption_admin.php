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
        $message = "Caption successfully submitted!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: black;
            color: white;
        }

        .message-container {
            padding: 30px;
            background-color: black;
            border: 2px solid white;
            border-radius: 10px;
            font-size: 35px;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <?php echo $message; ?>
    </div>
</body>
</html>