<?php
// require('_tabulka.php');
require('_function_database.php');
$conn = conenect_to_database_kameny();

print_r($_POST);
$jmeno = !empty($_POST["jmeno"]) ? "'" . $_POST["jmeno"] . "'" : "NULL";
$email = !empty($_POST["email"]) ? "'" . $_POST["email"] . "'" : "NULL";
$castka = !empty($_POST["castka"]) ?  $_POST["castka"] : "NULL";
$stara_castka = !empty($_POST["stara_castka"]) ?  $_POST["stara_castka"]  : "NULL";

$visible = isset($_POST["viditelny"]) ? 1 : 0;
$castka = floatval($stara_castka) + floatval($castka);
$castka = "'".$castka . "'";
if (isset($_POST["idd"])) {
    $id = $_POST['idd'];
    $sql = "UPDATE donatori SET jmeno = $jmeno, email= $email, castka = $castka ,visible = $visible WHERE id = $id";

} else {
    $sql = "INSERT INTO donatori (jmeno,email,castka,visible) values ($jmeno, $email, $castka, $visible)";
}
$response = "";
if (mysqli_query($conn, $sql)) {
    $response .= "Data byla úspěšně uložena. ";
} else {
    $response .= "Chyba při ukládání dat: " . mysqli_error($conn);
}
disconenect_to_database($conn);
echo $response;
echo "<br>";
echo $sql;
$location = "Location: editor.php?response=$response";
// header($location);
?>