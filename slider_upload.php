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

    $imgColumns = array("img1", "img2", "img3", "img4"); // Add "img4" to the array

    $filenames = array();

    for ($i = 1; $i <= 4; $i++) { // Update loop limit to 4
        $fieldName = "image" . $i;

        if (!empty($_FILES[$fieldName]["tmp_name"])) {
            $filename = $_FILES[$fieldName]["name"];

            $filenames[] = $filename;

            move_uploaded_file($_FILES[$fieldName]["tmp_name"], $targetDir . $filename);

            echo "Image $i has been uploaded.<br>";
        } else {
            echo "Error: Image $i was not provided.<br>";
        }
    }

    $checkQuery = "SELECT * FROM sliderimage WHERE id = $rowId";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        $updateQuery = "UPDATE sliderimage SET ";
        for ($j = 0; $j < count($imgColumns); $j++) {
            $updateQuery .= $imgColumns[$j] . " = '" . $filenames[$j] . "'";
            if ($j < count($imgColumns) - 1) {
                $updateQuery .= ", ";
            }
        }
        $updateQuery .= " WHERE id = $rowId";

        if ($conn->query($updateQuery) === TRUE) {
            echo "Images have been updated in the database.<br>";
        } else {
            echo "Error updating record: " . $conn->error . "<br>";
        }
    } else {
        $insertQuery = "INSERT INTO sliderimage (id, " . implode(", ", $imgColumns) . ") VALUES ($rowId, '" . implode("', '", $filenames) . "')";

        if ($conn->query($insertQuery) === TRUE) {
            echo "Images have been added to the database.<br>";
        } else {
            echo "Error inserting record: " . $conn->error . "<br>";
        }
    }
}

$conn->close();
?>
