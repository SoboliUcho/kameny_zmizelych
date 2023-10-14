<?php 
require('_function_database.php');
$conn = conenect_to_database_kameny();
$nazev = $_POST['jmeno'];
$popis = $_POST["popis"];

$sql = "INSERT INTO report(nazev, popis) VALUES ('$nazev', '$popis')";
if (mysqli_query($conn, $sql)) {
    $response = "Data byla úspěšně uložena.";
} else {
    $response = "Chyba při ukládání dat: " . mysqli_error($conn);
}
disconenect_to_database($conn);
// echo $response
header("Location: report.php?response=$response");
?>