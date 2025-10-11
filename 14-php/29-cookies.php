<?php

$tittle = "29 - Cookies";
$descripcion = "Learn how to work with cookies in PHP.";

include 'template/header.php';

echo '<section>';
echo '<h2>Cookies</h2>';

// Formulario para establecer cookies
echo '<form action="" method="post">';
echo '<label for="cookie_name">Cookie Name:</label><br>';
echo '<input type="text" name="cookie_name" id="cookie_name" placeholder="e.g., username"><br><br>';

echo '<label for="cookie_value">Cookie Value:</label><br>';
echo '<input type="text" name="cookie_value" id="cookie_value" placeholder="e.g., John"><br><br>';

echo '<input type="submit" value="Set Cookie">';
echo '</form>';

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['cookie_name']);
    $value = trim($_POST['cookie_value']);

    if ($name !== '' && $value !== '') {
        setcookie($name, $value, time() + 3600); // Cookie por 1 hora
        echo "<p style='color:green;'>Cookie '<strong>$name</strong>' has been set with value '<strong>$value</strong>'.</p>";
        echo "<p><em>Refresh the page to see it read back.</em></p>";
    } else {
        echo "<p style='color:red;'>Please fill in both the name and the value.</p>";
    }
}

// Mostrar cookies existentes
if (!empty($_COOKIE)) {
    echo '<h3>Existing Cookies:</h3>';
    echo '<ul>';
    foreach ($_COOKIE as $key => $val) {
        echo '<li><strong>' . htmlspecialchars($key) . ':</strong> ' . htmlspecialchars($val) . '</li>';
    }
    echo '</ul>';
} else {
    echo '<p>No cookies are currently set.</p>';
}

echo '</section>';

include 'template/footer.php';
?>
