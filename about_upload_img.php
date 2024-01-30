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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $targetDir = "uploaded_img";
    $uploadOk = 1;

    $columnName = "image";

    if (!empty($_FILES["image"]["tmp_name"])) {
        $filename = $_FILES["image"]["name"];

        move_uploaded_file($_FILES["image"]["tmp_name"], $targetDir . '/' . $filename);


        $insertQuery = "INSERT INTO about_image (id, $columnName) VALUES (NULL, '$filename')";

        if ($conn->query($insertQuery) === TRUE) {
            $message = "Image has been added to the database.<br>";
            header("refresh:2; url=about_admin.php");
        } else {
            $message = "Error inserting record: " . $conn->error . "<br>";
        }
    } else {
        $message = "Error: Image was not provided.<br>";
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