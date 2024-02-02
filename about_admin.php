<?php
include 'config.php';
include 'navbaradmin.php';

class AdminProductForm {
    public function render() {
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
                <?php $this->renderCaptionForm(); ?>
                <?php $this->renderImageUploadForm(); ?>
                <style>
                    label {
                        display: block;
                        margin-bottom: 10px;
                        margin-left: 0; 
                    }
                    .FORM{
                        color: BLACK;
                    }
                    .FORM LABEL{ 
                        font-size: 20PX;
                        padding: 0px;
                    }
                </style>
            </div>
        </body>
        </html>
        <?php
    }
    private function renderCaptionForm() {
        ?>
        <form action="about_upload.php" method="post">
            <h3>Submit Caption</h3>
            <?php $this->renderCaptionInput('caption1', 'Write the first caption'); ?>
            <?php $this->renderCaptionInput('caption2', 'Write the second caption'); ?>
            <?php $this->renderCaptionInput('caption3', 'Write the first caption'); ?>
            <?php $this->renderCaptionInput('caption4', 'Write the second caption'); ?>
            <?php $this->renderCaptionInput('caption5', 'Write the second caption'); ?>
            <input type="submit" class="btn" name="Submit" value="Submit">
        </form>
        <?php
    }
    private function renderCaptionInput($id, $placeholder) {
        ?>
        <label for="<?php echo $id; ?>"><?php echo ucfirst($id); ?>:</label>
        <input type="text" id="<?php echo $id; ?>" placeholder="<?php echo $placeholder; ?>" name="<?php echo $id; ?>"  class="box">
        <br>
        <?php
    }
    private function renderImageUploadForm() {
        ?>
        <form class="FORM" action="about_upload_img.php" method="post" enctype="multipart/form-data">
            <h3>Image Upload</h3>
            <?php $this->renderImageInput('image', 'Image 1:', true); ?>
            <input type="submit" class="btn" value="Upload Images" name="submit">
        </form>
        <?php
    }
    private function renderImageInput($name, $label, $required) {
        ?>
        <label for="<?php echo $name; ?>"><?php echo $label; ?></label>
        <input type="file" name="<?php echo $name; ?>" id="<?php echo $name; ?>" <?php echo $required ? 'required' : ''; ?> class="box">
        <?php
    }
}
$adminProductForm = new AdminProductForm();
$adminProductForm->render();
?>
