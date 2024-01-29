<?php
include 'config.php';
include 'navbaradmin.php';
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
      <form action="proces_caption.php" method="post">
         <h3>Submit Caption</h3>
         <label for="caption_id1">Caption ID 1:</label>
         <input type="text" id="caption_id1" placeholder="Write the first caption" name="caption_id1"  class="box">
         <br>
         <label for="caption_id2">Caption ID 2:</label>
         <input type="text" id="caption_id2" placeholder="Write the second caption" name="caption_id2" required class="box">
         <br>
         
         <input type="submit" class="btn" name="Submit" value="Submit">
      </form>
      
        <form class="FORM" action="slider_upload.php" method="post" enctype="multipart/form-data">
            <h3>Image Upload</h3>

            <label for="image1">Image 1:</label>
            <input type="file" name="image1" id="image1" required class="box">

            <label for="image2">Image 2:</label>
            <input type="file" name="image2" id="image2" required class="box">

            <label for="image3">Image 3:</label>
            <input type="file" name="image3" id="image3" required class="box">

            <input type= "submit" class="btn" value="Upload Images" name="submit">
        </form>
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
</div>

</body>
</html>
