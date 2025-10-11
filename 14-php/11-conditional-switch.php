<?php

    $tittle = "11 - Conditional SWITCH";
    $descripcion = "Perform conditional operations on variables";

include 'template/header.php';
    echo '<section>';

    echo $days = date("D");
?>
<?php
switch ($days) {
    case 'Mon':
        echo '<p>Today is Monday!</p>';
        break;
    case 'Tue':
        echo '<p>Today is Tuesday!</p>';
        break;
    case 'Wed':
        echo '<p>Today is Wednesday!</p>';
        break;
    case 'Thu':
        echo '<p>Today is Thursday!</p>';
        break;
    case 'Fri':
        echo '<p>Today is Friday!</p>';
        break;
    default:
        echo '<p>Happy weekend</p>';
}
?>
<?php

include 'template/footer.php'; ?>
