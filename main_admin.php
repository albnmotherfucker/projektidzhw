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
         <input type="text" id="caption_id2" placeholder="Write the second caption" name="caption_id2" class="box">
         <br>
         
         <input type="submit" class="btn" name="Submit" value="Submit">
      </form>
   </div>
</div>

</body>
</html>
