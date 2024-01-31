<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'cart_db';

$conn = mysqli_connect($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ""; 

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
        header("refresh:2;url=about_admin.php");
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
    
    <script>
       
    </script>
</body>
</html>
