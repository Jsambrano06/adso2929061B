<?php

    $tittle = "28 - Upload Files";
    $descripcion = "Learn how to upload files in PHP.";

include 'template/header.php';
    echo '<section>';

    echo '<h2>Upload Files</h2>';
    echo '<form action="" method="post" enctype="multipart/form-data">';
    echo '<input type="file" name="fileToUpload" id="fileToUpload">';
    echo '<input type="submit" value="Upload File" name="submit">';
    echo '</form>';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    echo '</section>';



include 'template/footer.php'; ?>

