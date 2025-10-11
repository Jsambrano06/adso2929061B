<?php

    $tittle = "29 - Cookies";
    $descripcion = "Learn how to work with cookies in PHP.";

include 'template/header.php';
    echo '<section>';

    echo '<h2>Cookies</h2>';
    echo '<form action="" method="post">';
    echo '<input type="text" name="cookie_name" placeholder="Cookie Name">';
    echo '<input type="text" name="cookie_value" placeholder="Cookie Value">';
    echo '<input type="submit" value="Set Cookie">';
    echo '</form>';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['cookie_name'];
        $value = $_POST['cookie_value'];
        setcookie($name, $value, time() + 3600);
        echo "Cookie '$name' has been set!";
    }

    echo '</section>';


include 'template/footer.php'; ?>

