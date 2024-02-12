<?php 
require('_function_database.php');
$conn = conenect_to_database_kameny();
$id = $_POST["id"];
$dum = $_POST["dum_id"];

$sql = "UPDATE lide
    SET dum_id = '$dum'
    WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    $response = "Data byla úspěšně uložena.";
} else {
    $response = "Chyba při ukládání dat: " . mysqli_error($conn);
}
disconenect_to_database($conn);
// echo $response;
// echo "<br>";
// echo $sql;
$location = "Location: editor.php?response=$response";
header($location);
?>