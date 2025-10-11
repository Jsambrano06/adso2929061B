<?php

    $tittle = "31 - Send Mail";
    $descripcion = "Learn how to send emails in PHP.";

include 'template/header.php';
    echo '<section>';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $to = $_POST['to'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $headers = "From: webmaster@example.com";

        if (mail($to, $subject, $message, $headers)) {
            echo "Email sent successfully!";
        } else {
            echo "Failed to send email.";
        }
    }

    echo '<form action="" method="post">';
    echo '<input type="email" name="to" placeholder="Recipient Email" required>';
    echo '<input type="text" name="subject" placeholder="Subject" required>';
    echo '<textarea name="message" placeholder="Message" required></textarea>';
    echo '<input type="submit" value="Send Email">';
    echo '</form>';


    echo '</section>';

include 'template/footer.php'; ?>

