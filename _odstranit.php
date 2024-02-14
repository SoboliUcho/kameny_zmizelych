<?php 
require('_function_database.php');
$conn = conenect_to_database_kameny();
$id = $_POST["id"];
$type = $_POST["type"];

$sql = "DELETE FROM $type
    WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    $response = "Data byla úspěšně smazána.";
} else {
    $response = "Chyba při mazání dat: " . mysqli_error($conn);
}
disconenect_to_database($conn);
// echo $response;
// echo "<br>";
// echo $sql;
$location = "Location: editor.php?delete=&response=$response";
header($location);
?>