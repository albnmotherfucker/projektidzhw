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
      <form action="about_upload.php" method="post">
         <h3>Submit Caption</h3>
         <label for="caption_id1">Caption ID 1:</label>
         <input type="text" id="caption1" placeholder="Write the first caption" name="caption1"  class="box">
         <br>
         <label for="caption_id2">Caption ID 2:</label>
         <input type="text" id="caption2" placeholder="Write the second caption" name="caption2"  class="box">
         <br>   
         <label for="caption_id1">Caption ID 1:</label>
         <input type="text" id="caption3" placeholder="Write the first caption" name="caption3"  class="box">
         <br>
         <label for="caption_id2">Caption ID 2:</label>
         <input type="text" id="caption4" placeholder="Write the second caption" name="caption4"  class="box">
         <br>
         <label for="caption_id2">Caption ID 2:</label>
         <input type="text" id="caption5" placeholder="Write the second caption" name="caption5"  class="box">
         <br>
         <input type="submit" class="btn" name="Submit" value="Submit">
      </form>
      
        <form class="FORM" action="about_upload_img.php" method="post" enctype="multipart/form-data">
            <h3>Image Upload</h3>

            <label for="image">Image 1:</label>
            <input type="file" name="image" id="image" required class="box">

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
