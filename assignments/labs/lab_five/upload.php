<?php

// Array to store all validation errors
$errors = [];

$uploadFolder = "uploads/";

$file = $_FILES['image'];

//checks if image was uploaded, error message if not
if (!isset($_FILES['image'])) {
    $errors[] = "No file was uploaded.";

} else {
    if($file["error"] != UPLOAD_ERR_OK) {
        $errors[] = "There was an error uploading the image";
    }

    $allowedTypes = ["image/jpeg", "image/png", "image/webp"];

    //if theres no uploads errors checks mime type.
    if(empty($errors)) {
        $mimeType = mime_content_type($file['tmp_name']);

        if(!in_array($mimeType, $allowedTypes)) {
            $errors[] = "Invalid file type. Please upload a JPEG, PNG, or WebP image.";
        }
    }

    //sets max file at 2MB
    $maxSize = 2 * 1024 * 1024;

    if($file["size"] > $maxSize) {
        $errors[] = "File is too large. Max size 2MB.";
    }
}

//if any errors, diplay them and stop script

if(!empty($errors)) {
    echo "<h2> Upload Failed</h2>";
    echo "<ul>";

    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }

    echo "</ul>";
    exit;
}

//get the file extension
$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
//creates a unique filename so uploaded files don't overwrite
$safeFileName = uniqid('img_', true) . '.' . strtolower($extension);

//Destination folder
$destination = __DIR__ . "uploads/" . $safeFileName;
$imgPath = 'uploads/' . $safeFileName;

if (!move_uploaded_file($file['tmp_name'], $destination)) {
    echo "<p>Failed to save the uploaded file.</p>";
    exit;
}

echo "<h1>Image uploaded successfully!</h1>";
echo "<img src='$imgPath' alt='Uploaded Image' style='max-width:300px; display: block; margin-top: 0.5rem;'>";
?>