<?php

    $tittle = "16 - Loop Do While";
    $descripcion = "Repeats a code block while condition is true";

include 'template/header.php';
    echo '<section>';

        $i = 1;

        do {
            if($i % 2 == 0) 
            echo "<p style='padding: 0.4rem 0.6rem; border: 1px solid #0006'> $i </p>";
            $i++;
        } while ($i <= 20);


include 'template/footer.php'; ?>
