<?php

$tittle = "32 - Exceptions";
$descripcion = "Learn how to handle exceptions in PHP.";

include 'template/header.php';

echo '<section>';
echo '<h2>Verificación de Edad para Votar</h2>';

// Mostrar formulario para ingresar edad
echo '<form method="post" action="">';
echo '<label for="age">Ingresa tu edad:</label><br>';
echo '<input type="number" name="age" id="age" min="0" required><br><br>';
echo '<input type="submit" value="Verificar">';
echo '</form>';

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $age = (int) $_POST['age'];

    try {
        if ($age < 18) {
            throw new Exception("No puedes votar: Debes tener al menos 18 años.");
        } else {
            echo "<p style='color:green;'>¡Puedes votar! Tienes $age años.</p>";
        }
    } catch (Exception $e) {
        echo "<p style='color:red;'>" . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

echo '</section>';

include 'template/footer.php';
?>
