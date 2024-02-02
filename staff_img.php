<?php
include 'config.php';
include 'navbaradmin.php';

class StaffImageUploader
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function uploadStaffImages()
    {
        if (isset($_POST['submit'])) {
            $insertSql = "INSERT INTO stores_staff () VALUES ()";
            mysqli_query($this->conn, $insertSql);

            $lastInsertId = mysqli_insert_id($this->conn);

            for ($i = 1; $i <= 10; $i++) {
                $staffImgName = "staff_img$i";
                $staffImg = isset($_FILES[$staffImgName]['name']) ? $_FILES[$staffImgName]['name'] : '';
                $staffImgTmpName = isset($_FILES[$staffImgName]['tmp_name']) ? $_FILES[$staffImgName]['tmp_name'] : '';

                if (!empty($staffImg)) {
                    $uploadPath = "uploaded_staff_images/$staffImg";
                    move_uploaded_file($staffImgTmpName, $uploadPath);

                    $updateImgSql = "UPDATE stores_staff SET img$i = '$staffImg' WHERE id = $lastInsertId";
                    mysqli_query($this->conn, $updateImgSql);
                }
            }
        }
    }
}

$staffImageUploader = new StaffImageUploader($conn);
$staffImageUploader->uploadStaffImages();
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

            <?php for ($i = 1; $i <= 10; $i++): ?>
                <label for="staff_img<?= $i ?>">Staff Image <?= $i ?>:</label>
                <input type="file" name="staff_img<?= $i ?>" id="staff_img<?= $i ?>" class="box">
                <br>
            <?php endfor; ?>

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
