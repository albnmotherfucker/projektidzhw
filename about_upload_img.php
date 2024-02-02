<?php

class ImageUploader {
    private $conn;
    private $message = "";
    public function __construct($hostname, $username, $password, $database) {
        $this->conn = mysqli_connect($hostname, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    public function uploadImage() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            $targetDir = "uploaded_img";
            $uploadOk = 1;

            $columnName = "image";

            if (!empty($_FILES["image"]["tmp_name"])) {
                $filename = $_FILES["image"]["name"];

                move_uploaded_file($_FILES["image"]["tmp_name"], $targetDir . '/' . $filename);

                $insertQuery = "INSERT INTO about_image (id, $columnName) VALUES (NULL, '$filename')";

                if ($this->conn->query($insertQuery) === TRUE) {
                    $this->message = "Image has been added to the database.<br>";
                    header("refresh:2; url=about_admin.php");
                } else {
                    $this->message = "Error inserting record: " . $this->conn->error . "<br>";
                }
            } else {
                $this->message = "Error: Image was not provided.<br>";
            }
        }
    }

    public function showMessage() {
        return $this->message;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

$imageUploader = new ImageUploader('localhost', 'root', '', 'cart_db');
$imageUploader->uploadImage();

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
        <?php echo $imageUploader->showMessage(); ?>
    </div>
</body>
</html>

<?php
$imageUploader->closeConnection();
?>
