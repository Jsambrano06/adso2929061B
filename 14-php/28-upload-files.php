<?php

$tittle = "28 - Upload Files";
$descripcion = "Learn how to upload files in PHP.";

include 'template/header.php';

echo '<section>';
echo '<h2>Upload Files</h2>';

// Mostrar el formulario
echo '<form action="" method="post" enctype="multipart/form-data">';
echo '<label for="fileToUpload">Select file:</label><br>';
echo '<input type="file" name="fileToUpload" id="fileToUpload"><br><br>';
echo '<input type="submit" value="Upload File" name="submit">';
echo '</form>';

// Procesar el archivo si se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear carpeta 'uploads/' si no existe
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Ruta final del archivo
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    // Validar que se subió algo
    if (!empty($_FILES["fileToUpload"]["name"])) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $filename = htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
            echo "<p style='color:green;'>The file <strong>$filename</strong> has been uploaded successfully.</p>";

            // Mostrar imagen si es una imagen
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $imageTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (in_array($fileType, $imageTypes)) {
                echo "<p>Preview:</p>";
                echo "<img src='$target_file' alt='$filename' style='max-width:300px;'><br>";
            }
        } else {
            echo "<p style='color:red;'>Sorry, there was an error uploading your file.</p>";
        }
    } else {
        echo "<p style='color:red;'>No file was selected. Please choose a file to upload.</p>";
    }
}

echo '</section>';

include 'template/footer.php';
?>
