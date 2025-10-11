<?php

    $tittle = "17 - Loop For";
    $descripcion = "Repeats a code block for a specified number of iterations";

include 'template/header.php';
    echo '<section>';

        for($i = 1; $i <= 40; $i++){
            if($i % 5 == 0) {
                echo "<p style='padding: 0.4rem 0.6rem; border: 2px solid #0006'> $i </p>";
                if($i == 25) continue;
                if($i == 30) break;
            }
    }

include 'template/footer.php'; ?>
