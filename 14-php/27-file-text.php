<?php

    $tittle = "27 - File and Text Handling";
    $descripcion = "Learn how to work with files and text in PHP.";

include 'template/header.php';
    echo '<section>';

    echo '<h2>File Handling</h2>';
    $filename = 'example.txt';
    // Create or open the file
    $file = fopen($filename, "a+") or die("Unable to open file!");
    fwrite($file, "Hello, World!\n");
    fclose($file);
    echo '<h2>Text Handling</h2>';
    $text = "Hello, World!";
    echo '<p>' . $text . '</p>';
    echo '<p>String length: ' . strlen($text) . '</p>';
    echo '<p>Uppercase: ' . strtoupper($text) . '</p>';

include 'template/footer.php'; ?>

