<?php

    $tittle = "24 - Date and Time";
    $descripcion = "Learn how to work with date and time in PHP.";

include 'template/header.php';
    echo '<section>';

    date_default_timezone_set('America/Bogota');
    echo "<p>The current date and time is: " . date("Y-m-d H:i:s") . "</p>";
    
    echo '</section>';


    echo '</section>';

include 'template/footer.php'; ?>

