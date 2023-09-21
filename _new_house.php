<?php
require('_function_database.php');
$conn = conenect_to_database_kameny();
$ulice = $_POST['nulice'];
$cislo_domu = $_POST["ncislo_domu"];
$mesto = $_POST["nmesto"];
$gps_x = $_POST["gps_x"];
$gps_y = $_POST["gps_y"];

$sql = "INSERT INTO domy (mesto, ulice, cislo_domu, gps_x, gps_y) VALUES ('$mesto', '$ulice', '$cislo_domu', '$gps_x','$gps_y')";
if (mysqli_query($conn, $sql)) {
    $response = "Data byla úspěšně uložena.";
} else {
    $response = "Chyba při ukládání dat: " . mysqli_error($conn);
}
disconenect_to_database($conn);
header("Location: editor.php?response=$response");
?>