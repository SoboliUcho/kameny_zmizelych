<?php
require('_function_database.php');
$conn = conenect_to_database_kameny();

$url = isset($_POST["url"]) ? trim($_POST["url"]) : "NULL";
$nadpis = isset($_POST["nazev"]) ? trim($_POST["nazev"]) : "NULL";
$popis = isset($_POST["popisek"]) ? trim($_POST["popisek"]) : "NULL";
$date = isset($_POST["datum"]) ? $_POST["datum"] : "NULL";

if ($date == "NULL" || $date == "") {
    $date = date("Y-m-d");
}
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $sql = "UPDATE napsali SET 
    nadpis = '$nadpis', 
    odkaz = '$url',
    slova = '$popis', 
    datum = '$date'
    WHERE id = $id";
} else {
    $sql = "INSERT INTO napsali(nadpis, odkaz, slova, datum) VALUES ('$nadpis','$url', '$popis', '$date')";
}

if (mysqli_query($conn, $sql)) {
    $response = "Data byla úspěšně uložena.";
} else {
    $response = "Chyba při ukládání dat: " . mysqli_error($conn);
}
if (empty($_POST["puvod"])) {
    $location = "Location: editor.php?response=$response";
} else {
    $location = "Location:" . $_POST["puvod"] . "?response=$response";
}
// echo $location  ;

header($location);
?>