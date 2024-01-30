<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'cart_db';
$conn = mysqli_connect('localhost', 'root', '', 'cart_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $targetDir = "uploaded_img";
    $uploadOk = 1;

    $rowId = 1;

    $imgColumns = array("img1", "img2", "img3", "img4",);

    $filenames = array();

    for ($i = 1; $i <= 4; $i++) {
        $fieldName = "image" . $i;

        if (!empty($_FILES[$fieldName]["tmp_name"])) {
            $filename = $_FILES[$fieldName]["name"];

            $filenames[] = $filename;

            move_uploaded_file($_FILES[$fieldName]["tmp_name"], $targetDir . $filename);

            header("refresh:2;url=main_admin.php");
        } else {
            $message = "Error: Image $i was not provided.<br>";
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
            $message = "Images have been updated in the database.<br>";
        } else {
            $message = "Error updating record: " . $conn->error . "<br>";
        }
    } else {
        $insertQuery = "INSERT INTO sliderimage (id, " . implode(", ", $imgColumns) . ") VALUES ($rowId, '" . implode("', '", $filenames) . "')";

        if ($conn->query($insertQuery) === TRUE) {
            $message = "Images have been added to the database.<br>";
        } else {
            $message = "Error inserting record: " . $conn->error . "<br>";
        }
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
