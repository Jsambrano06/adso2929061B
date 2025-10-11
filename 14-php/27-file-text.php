<?php
    $tittle = "27 - File and Text Handling";
    $descripcion = "Learn how to work with files and text in PHP.";

    include 'template/header.php';

    echo '<section>';

    echo '<h2>File Handling</h2>';

    // Ruta del archivo (dentro de la carpeta "text")
    $filename = 'text/text.html';

    // Crear carpeta si no existe
    if (!file_exists('text')) {
        mkdir('text', 0777, true);
    }

    // Crear o abrir el archivo
    $file = fopen($filename, "a+") or die("Unable to open file!");

    // Escribir en el archivo
    fwrite($file, "Hello, World!\n");

    // Volver al inicio del archivo para leer su contenido
    rewind($file);
    $content = fread($file, filesize($filename));
    fclose($file);

    echo '<p><strong>File content:</strong></p>';
    echo '<pre>' . htmlspecialchars($content) . '</pre>';

    echo '<h2>Text Handling</h2>';
    $text = "Hello, World!";
    echo '<p>' . $text . '</p>';
    echo '<p>String length: ' . strlen($text) . '</p>';
    echo '<p>Uppercase: ' . strtoupper($text) . '</p>';

    include 'template/footer.php';
?>
