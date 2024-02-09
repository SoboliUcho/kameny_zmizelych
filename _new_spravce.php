<?php
// require('_tabulka.php');
require('_function_database.php');
$conn = conenect_to_database_kameny();

// print_r($_POST);
$jmeno = !empty($_POST["jmeno"]) ? "'" . $_POST["jmeno"] . "'" : "NULL";
$email = !empty($_POST["email"]) ? "'" . $_POST["email"] . "'" : "NULL";
$visible = isset($_POST["viditelny"]) ? 1 : 0;

if (isset($_POST["ids"])) {
    $id = $_POST['ids'];
    $sql = "UPDATE spravci SET jmeno = $jmeno, email= $email, visible = $visible WHERE id = $id";

} else {
    $sql = "INSERT INTO spravci(jmeno,email,visible)values ($jmeno, $email, $visible)";
}
$response = "";
if (mysqli_query($conn, $sql)) {
    if (!isset($_POST["ids"])) {
        $lastInsertedId = mysqli_insert_id($conn);
        $response .= spravce_lidi($lastInsertedId, $conn);
    } else {
        $response .= spravce_lidi($_POST["ids"], $conn);
    }
    $response .= "Data byla úspěšně uložena. ";
} else {
    $response .= "Chyba při ukládání dat: " . mysqli_error($conn);
}
disconenect_to_database($conn);
// echo $response;
// echo "<br>";
// echo $sql;
$location = "Location: editor.php?response=$response";
header($location);
function spravce_lidi($id_spravce, $conn)
{
    $domy = !empty($_POST["dum_id"]) ? $_POST["dum_id"] : "NULL";
    $lide = !empty($_POST["clovek_id"]) ? $_POST["clovek_id"] : "NULL";
    $response = "";
    for ($i = 0; $i < count($domy); $i++) {
        if ($domy[$i] == NULL) {
            continue;
        }
        $cloveci = people_in_house($domy[$i], $conn);
        foreach ($cloveci as $clovek) {
            $id = $clovek["id"];
            $sql = "UPDATE lide SET spravce = $id_spravce WHERE id = $id";
            if (mysqli_query($conn, $sql)) {
                $response .= "Človek " . $clovek["jmeno"] . " " . $clovek["prijmeni"] . "byl aktualizován. ";
            } else {
                $response .= "Chyba při ukládání dat: " . mysqli_error($conn);
            }
        }
    }
    for ($j = 0; $j < count($lide); $j++) {
        if ($lide[$j] == NULL) {
            continue;
        }
        $id = $lide[$j];
        $sql = "UPDATE lide SET spravce = $id_spravce WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            $response .= "Clovek byl aktualizován ";
        } else {
            $response += "Chyba při ukládání dat: " . mysqli_error($conn);
        }
    }
    return $response;
}
?>