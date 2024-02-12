<?php 
require('_function_database.php');
$conn = conenect_to_database_kameny();
$id = $_POST["id"];
$visible = $_POST["visible"];

$sql = "UPDATE domy
    SET visible = $visible
    WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    $response = "Data byla úspěšně uložena.";
} else {
    $response = "Chyba při ukládání dat: " . mysqli_error($conn);
}
disconenect_to_database($conn);
echo $response;
echo "<br>";
echo $sql;
$location = "Location: editor.php?response=$response";
header($location);
?>