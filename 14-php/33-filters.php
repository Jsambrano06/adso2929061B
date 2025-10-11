<?php

$tittle = "33 - Filters";
$descripcion = "Learn how to use filters in PHP.";

include 'template/header.php';

echo '<section>';
echo '<h2>Filtro de Ciudad y Edad</h2>';

// Mostrar formulario
echo '<form method="post" action="">';
echo '<label for="city">Ciudad:</label><br>';
echo '<input type="text" name="city" id="city" required placeholder="Ejemplo: Manizales"><br><br>';

echo '<label for="age">Edad:</label><br>';
echo '<input type="number" name="age" id="age" min="0" required><br><br>';

echo '<input type="submit" value="Verificar">';
echo '</form>';

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitizar y validar ciudad (solo sanitizar porque no hay filtro de validación para texto libre)
    $cityRaw = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $city = mb_strtolower(trim($cityRaw)); // Minusculas y trim para comparación

    // Validar edad como entero
    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);

    if ($age === false || $age < 0) {
        echo "<p style='color:red;'>Edad inválida.</p>";
    } else {
        if ($city === 'manizales') {
            if ($age >= 18) {
                echo "<p style='color:green;'>Aceptado: Vives en Manizales y tienes $age años.</p>";
            } else {
                echo "<p style='color:red;'>No aceptado: Debes tener al menos 18 años.</p>";
            }
        } else {
            echo "<p style='color:red;'>No aceptado: No vives en Manizales.</p>";
        }
    }
}

echo '</section>';

include 'template/footer.php';
?>
