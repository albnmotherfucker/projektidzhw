<?php
include 'config.php';
include 'navbaradmin.php';

if (isset($_POST['submit'])) {
    $insertSql = "INSERT INTO stores_staff () VALUES ()";
    mysqli_query($conn, $insertSql);

    $lastInsertId = mysqli_insert_id($conn);

    for ($i = 1; $i <= 10; $i++) {
        $staffImgName = "staff_img$i";
        $staffImg = isset($_FILES[$staffImgName]['name']) ? $_FILES[$staffImgName]['name'] : '';
        $staffImgTmpName = isset($_FILES[$staffImgName]['tmp_name']) ? $_FILES[$staffImgName]['tmp_name'] : '';

        if (!empty($staffImg)) {
            $uploadPath = "uploaded_staff_images/$staffImg";
            move_uploaded_file($staffImgTmpName, $uploadPath);

            // Update the database with the image name in the appropriate column
            $updateImgSql = "UPDATE stores_staff SET img$i = '$staffImg' WHERE id = $lastInsertId";
            mysqli_query($conn, $updateImgSql);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stili.css">
</head>
<body>
    <div class="admin-product-form-container">
        <form class="FORM" action="staff_img.php" method="post" enctype="multipart/form-data">
            <h3>Staff Image Upload</h3>

            <label for="staff_img1">Staff Image 1:</label>
            <input type="file" name="staff_img1" id="staff_img1"  class="box">
            <br>

            <label for="staff_img2">Staff Image 2:</label>
            <input type="file" name="staff_img2" id="staff_img2" class="box">
            <br>

            <label for="staff_img3">Staff Image 3:</label>
            <input type="file" name="staff_img3" id="staff_img3" class="box">
            <br>

            <label for="staff_img4">Staff Image 4:</label>
            <input type="file" name="staff_img4" id="staff_img4"  class="box">
            <br>

            <label for="staff_img5">Staff Image 5:</label>
            <input type="file" name="staff_img5" id="staff_img5" class="box">
            <br>

            <label for="staff_img6">Staff Image 6:</label>
            <input type="file" name="staff_img6" id="staff_img6" class="box">
            <br>

            <label for="staff_img7">Staff Image 7:</label>
            <input type="file" name="staff_img7" id="staff_img7" class="box">
            <br>

            <label for="staff_img8">Staff Image 8:</label>
            <input type="file" name="staff_img8" id="staff_img8" class="box">
            <br>

            <label for="staff_img9">Staff Image 9:</label>
            <input type="file" name="staff_img9" id="staff_img9" class="box">
            <br>

            <label for="staff_img10">Staff Image 10:</label>
            <input type="file" name="staff_img10" id="staff_img10" class="box">
            <br>

            <input type="submit" class="btn" value="Upload Staff Images" name="submit">
        </form>

        <style>
            label {
                display: block;
                margin-bottom: 10px;
                margin-left: 0; 
            }
            
            .FORM {
                color: black;
            }
            
            .FORM LABEL { 
                font-size: 20px;
                padding: 0px;
            }
        </style>
    </div>
</body>
</html>
