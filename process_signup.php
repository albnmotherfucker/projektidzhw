<?php
$Name = isset($_POST['Name']) ? filter_var($_POST['Name'], FILTER_SANITIZE_STRING) : "";
$Email = isset($_POST['Email']) ? filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL) : "";
$Password = isset($_POST['Password']) ? $_POST['Password'] : ""; 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "erjoni2";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$stmt = mysqli_prepare($conn, "INSERT INTO erjoni3 (Name, Email, Password) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sss", $Name, $Email, $Password);

if (mysqli_stmt_execute($stmt)) {
    header("Location: projekti.php");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
