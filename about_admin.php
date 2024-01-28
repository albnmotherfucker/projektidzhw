<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2 style="font-size: 50px;">Submit Caption</h2>
    <form action="proces_caption.php" method="post">
        <label for="caption_id1" >Caption ID 1:</label>
        <input type="text" id="caption_id1" name="caption_id1" required>
        <br>
        <label for="caption_id2">Caption ID 2:</label>
        <input type="text" id="caption_id2" name="caption_id2" required>
        <br>
        
        <button type="submit">Submit</button>
    </form>

</body>
</html>