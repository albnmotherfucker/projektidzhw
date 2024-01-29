<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'cart_db';
$conn = mysqli_connect('localhost', 'root', '', 'cart_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $targetDir = "uploaded_img";
    $uploadOk = 1;

    $rowId = 1;

    for ($i = 1; $i <= 3; $i++) {
        $fieldName = "image" . $i;
        $targetFile = $targetDir . basename($_FILES[$fieldName]["name"]);
        
        if (!empty($_FILES[$fieldName]["tmp_name"])) {
            $columnName = "img" . $i;
            $filename = $_FILES[$fieldName]["name"];
            
          
            $updateQuery = "UPDATE sliderimage SET $columnName = '$filename' WHERE id = $rowId";

            if ($conn->query($updateQuery) === TRUE) {
                echo "Image $i has been uploaded and added to the database.<br>";
            } else {
                echo "Error updating record for Image $i: " . $conn->error . "<br>";
            }
            
            
            move_uploaded_file($_FILES[$fieldName]["tmp_name"], $targetDir . $filename);
        } else {
            echo "Error: Image $i was not provided.<br>";
        }
    }
}

$conn->close();
?>
