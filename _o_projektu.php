<?php
$soubor = "o_projektu-text.txt";
file_put_contents($soubor, $_POST["novyObsah"]);

$location = "Location: editor.php?response='Data byla úspěšně uložena.'";
header($location);

?>