<?php
session_start();
?>
<!DOCTYPE html>
<html>

<body>
    <?php
    // Echo session variables that were set on previous page
    echo "Favorite player is " . $_SESSION["fav_player"] . ".<br>";
    echo "Favorite series is " . $_SESSION["fav_series"] . ".";
    ?>
</body>

</html>