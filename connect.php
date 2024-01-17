<?php
$Name = isset($_POST['Name']) ? $_POST['Name'] : "";
$Email = isset($_POST['Email']) ? $_POST['Email'] : "";
$Password = isset($_POST['Password']) ? $_POST['Password'] : "";    

$conn = new mysqli( 'localhost' ,'root', '' , 'erjoni2' );
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    $stmt = $conn->prepare("insert into erjoni3(Name, Email, Password)
    values(?,?,?)");
    $stmt->bind_param("sss", $Name, $Email, $Password);
    $stmt->execute();
    $conn->commit();
    echo "registration successful";







?>