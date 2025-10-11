<?php

    $tittle = "14 - Arrays Multidimensionals";
    $descripcion = "Array that contains other nested arrays";

include 'template/header.php';
    echo '<section>';

    $bicycles = array(
        'Specialized' => array('Enduro', 'Stumpjumper', 'Camber'),
        'Intense'     => array('Carbine', 'Tracer', 'Spider'),
        'Santa cruz'  => array('Nomad', 'Megatower', 'Hightower')
    );

    foreach($bicycles as $key => $value) {
        echo '<h3>' . $key . '</h3>';
        echo "<ul>";
        foreach($value as $refer) {
            echo "<li>" . $refer . "</li>";
        }
        echo '</ul>';
    }

include 'template/footer.php'; ?>
