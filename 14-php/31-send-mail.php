<?php

$tittle = "31 - Send Mail (Example)";
$descripcion = "This is a local simulation of sending emails in PHP.";

include 'template/header.php';

echo '<section>';
echo '<h2>Send an Email (Simulated)</h2>';

// Procesar el formulario al hacer POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = trim($_POST['to']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Validar campos
    if (empty($to) || empty($subject) || empty($message)) {
        echo "<p style='color:red;'>All fields are required.</p>";
    } elseif (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color:red;'>Invalid email address.</p>";
    } else {
        // SIMULACIÓN DEL ENVÍO
        echo "<p style='color:green;'>✅ Email simulated successfully! (This is a local test, no email was actually sent.)</p>";

        // Mostrar los datos como ejemplo
        echo "<h3>Message Preview:</h3>";
        echo "<p><strong>To:</strong> " . htmlspecialchars($to) . "</p>";
        echo "<p><strong>Subject:</strong> " . htmlspecialchars($subject) . "</p>";
        echo "<p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>";
    }
}

// Mostrar el formulario
echo '<form action="" method="post">';
echo '<label for="to">To (email):</label><br>';
echo '<input type="email" name="to" id="to" placeholder="Recipient Email" required><br><br>';

echo '<label for="subject">Subject:</label><br>';
echo '<input type="text" name="subject" id="subject" placeholder="Subject" required><br><br>';

echo '<label for="message">Message:</label><br>';
echo '<textarea name="message" id="message" placeholder="Write your message here..." required></textarea><br><br>';

echo '<input type="submit" value="Simulate Send">';
echo '</form>';

echo '</section>';

include 'template/footer.php';
?>
