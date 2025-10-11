<?php
$tittle = "25 - Challenge Dates";
$descripcion = "Show today's date and calculate how many years you have";

include 'template/header.php';

echo '<section>';
echo "<h2>Today's Date</h2>";
echo "<p>" . date('d-m-Y') . "</p>";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['birthdate'])) {
    $birthdate = $_POST['birthdate'];
    $birth = new DateTime($birthdate);
    $today = new DateTime();

    if ($birth > $today) {
        echo "<h2>Invalid Date</h2>";
        echo "<p>The date you entered is in the future. You haven't been born yet!</p>";
    } else {
        $diff = $today->diff($birth);
        $formatted_birth = $birth -> format('d-m-Y');
        echo "<h2>Your Age</h2>";
        echo "<p>If you were born on " . $formatted_birth . ", you are " . $diff->y . " years old.</p>";
    }
}
?>
<form method="post" action="">
    <label for="birthdate">Enter your birth date:</label>
    <input type="date" id="birthdate" name="birthdate" max="<?= date('d-m-Y') ?>" required>
    <input type="submit" value="Calculate">
</form>
<?php
echo '</section>';
include 'template/footer.php';
?>
