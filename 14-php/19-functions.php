<?php

    $tittle = "19 - Functions";
    $descripcion = "A block of code designed to perform a specific, reusable task";

include 'template/header.php';
    echo '<section>';

    function showInfo() {
        echo "<p><b>Welcome</b> John Wick</p>";
        echo "<p>This is a web page. </p>";
    }

    showInfo();
    showInfo();


include 'template/footer.php'; ?>
