<?php

    $tittle = "32 - Exceptions";
    $descripcion = "Learn how to handle exceptions in PHP.";

include 'template/header.php';
    echo '<section>';

    try {
        throw new Exception("An error occurred");
    } catch (Exception $e) {
        echo "Caught exception: " . $e->getMessage();
    }


    echo '</section>';

include 'template/footer.php'; ?>
