<?php

$tittle = "33 - Filters";
$descripcion = "Learn how to use filters in PHP.";

include 'template/header.php';

echo '<section>';
echo '<h2>Filtro de Ciudad y Edad</h2>';

// Formulario para ingresar ciudad y edad
echo '<form method="post" action="">';
echo '<label for="city">Ciudad:</label><br>';
echo '<input type="text" name="city" id="city" required placeholder="Ejemplo: Manizales"><br><br>';

echo '<label for="age">Edad:</label><br>';
echo '<input type="number" name="age" id="age" min="0" required><br><br>';

echo '<input type="submit" value="Verificar">';
echo '</form>';

// Procesar formulario al enviar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $city = trim($_POST['city']);
    $age = (int) $_POST['age'];

    // Validar la ciudad con filtro de cadena (sanitize)
    $cityFiltered = filter_var($city, FILTER_SANITIZE_STRING);

    // Convertir a minúsculas para comparación
    $cityLower = mb_strtolower($cityFiltered);

    if ($cityLower === 'manizales') {
        if ($age >= 18) {
            echo "<p style='color:green;'>Aceptado: Vives en Manizales y tienes $age años.</p>";
        } else {
            echo "<p style='color:red;'>No aceptado: Debes tener al menos 18 años.</p>";
        }
    } else {
        echo "<p style='color:red;'>No aceptado: No vives en Manizales.</p>";
    }
}

echo '</section>';

include 'template/footer.php';
?>
