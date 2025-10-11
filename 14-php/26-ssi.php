<?php

    $tittle = "26 - SSI";
    $descripcion = "Learn how to use Server Side Includes (SSI) in PHP.";

include 'template/header.php';
    echo '<section>';

    echo '<p>Server Side Includes (SSI) are a server-side scripting language used for including content from one file into another.</p>';
    echo '<p>To use SSI, you need to have the following line in your .htaccess file:</p>';
    echo '<pre>Options +Includes<br>AllowOverride All</pre>';
    echo '<p>Then, you can include files using the following syntax:</p>';
    echo '<pre><!--#include virtual="/path/to/file.php" --></pre>';

    echo '</section>';

include 'template/footer.php'; ?>

