<?php

include 'config.php';
include 'navbaradmin.php';

class AdminForm {
    private $captionFormAction = 'proces_caption.php';
    private $imageFormAction = 'slider_upload.php';

    public function renderCaptionForm() {
        ?>
        <form action="<?php echo $this->captionFormAction; ?>" method="post">
            <h3>Submit Caption</h3>
            <label for="caption_id1">Caption ID 1:</label>
            <input type="text" id="caption_id1" placeholder="Write the first caption" name="caption_id1" class="box">
            <br>
            <label for="caption_id2">Caption ID 2:</label>
            <input type="text" id="caption_id2" placeholder="Write the second caption" name="caption_id2" required class="box">
            <br>
            <input type="submit" class="btn" name="Submit" value="Submit">
        </form>
        <?php
    }

    public function renderImageForm() {
        ?>
        <form class="FORM" action="<?php echo $this->imageFormAction; ?>" method="post" enctype="multipart/form-data">
            <h3>Image Upload</h3>

            <?php
            for ($i = 1; $i <= 4; $i++) {
                ?>
                <label for="image<?php echo $i; ?>">Image <?php echo $i; ?>:</label>
                <input type="file" name="image<?php echo $i; ?>" id="image<?php echo $i; ?>" required class="box">
                <?php
            }
            ?>

            <input type="submit" class="btn" value="Upload Images" name="submit">
        </form>
        <style>
            label {
                display: block;
                margin-bottom: 10px;
                margin-left: 0;
            }

            .FORM {
                color: BLACK;
            }

            .FORM LABEL {
                font-size: 20PX;
                padding: 0px;
            }
        </style>
        <?php
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
    <?php
    $adminForm = new AdminForm();
    $adminForm->renderCaptionForm();
    $adminForm->renderImageForm();
    ?>
</div>

</body>
</html>
