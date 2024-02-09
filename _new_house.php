<?php
require('_function_database.php');
// print_r($_POST);
$conn = conenect_to_database_kameny();
$ulice = $_POST['nulice'];
$cislo_domu = $_POST["ncislo_domu"];
$mesto = $_POST["nmesto"];
$gps_x = $_POST["gps_x"];
$gps_y = $_POST["gps_y"];
$old_siclo = $_POST["old_siclo"];
$visible = isset($_POST["viditelny"]) ? 1 : 0;
$id = $_POST["id"];

if ($id == "") {
    $sql = "INSERT INTO domy (mesto, ulice, cislo_domu, gps_x, gps_y,stare_cislo, visible) VALUES ('$mesto', '$ulice', '$cislo_domu', '$gps_x','$gps_y', $old_siclo, $visible)";
} else {
    
    $sql = "UPDATE domy
    SET mesto = '$mesto',
        ulice = '$ulice',
        cislo_domu = '$cislo_domu',
        gps_x = '$gps_x',
        gps_y = '$gps_y',
        stare_cislo = '$old_siclo',
        visible = $visible
    WHERE id = $id";
}

if (mysqli_query($conn, $sql)) {
    $response = "Data byla úspěšně uložena.";
} else {
    $response = "Chyba při ukládání dat: " . mysqli_error($conn);
}
disconenect_to_database($conn);
// echo $response;
// echo "<br>";
// echo $sql;
$location = "Location: editor.php?response='$response'";
header($location);
?>