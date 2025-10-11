<?php
    $tittle = "22 - Form Get";
    $descripcion = "A simple form that uses the GET method to submit full name and email";

    include 'template/header.php';

    echo '<section>';
?>

<form method="get" action="">
    <label for="fullname">Full Name:</label><br>
    <input type="text" id="fullname" name="fullname"><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email"><br><br>

    <input type="submit" value="Submit">
</form>

<?php
    // Verifica si el formulario fue enviado
    if (isset($_GET['fullname']) || isset($_GET['email'])) {
        $fullname = trim($_GET['fullname']);
        $email = trim($_GET['email']);

        if ($fullname === '' || $email === '') {
            echo "<p style='color:red;'>Please enter both your full name and email.</p>";
        } else {
            $fullname = htmlspecialchars($fullname);
            $email = htmlspecialchars($email);
            echo "<p>Hello, $fullname! We have recorded your email as <strong>$email</strong>.</p>";
        }
    }

    include 'template/footer.php';
?>
