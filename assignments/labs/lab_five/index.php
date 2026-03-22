<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/style.css" rel="stylesheet">
    <title>Upload an Image-Lab 5</title>
</head>

<body>
    <h1>Upload a Profile Picture</h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data">

        <label for="image">Choose an image:</label>
        <input type="file" name="image" id="image" required>
        <button type="submit">Upload Image</button>
 
    </form>
</body>

</html>