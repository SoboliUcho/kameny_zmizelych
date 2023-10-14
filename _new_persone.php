<?php
require('_function_database.php');
$conn = conenect_to_database_kameny();

$jmeno = !empty($_POST["jmeno"]) ? "'".$_POST["jmeno"]."'" : "NULL";
$prijmeni = !empty($_POST["prijmeni"]) ? "'".$_POST["prijmeni"]."'" : "NULL";
$datum_narozeni = !empty($_POST["datum_narozeni"]) ? "'".$_POST["datum_narozeni"]."'" : "NULL";
$misto_narozeni = !empty($_POST["misto_narozeni"]) ? "'".$_POST["misto_narozeni"]."'" : "NULL";
$rodinny_stav = !empty($_POST["rodinny_stav"]) ? "'".$_POST["rodinny_stav"]."'" : "NULL";
$nabozenske_vyznani = !empty($_POST["nabozenske_vyznani"]) ? "'".$_POST["nabozenske_vyznani"]."'" : "NULL";
$statni_prislusnost = !empty($_POST["statni_prislusnost"]) ? "'".$_POST["statni_prislusnost"]."'" : "NULL";
$okres = !empty($_POST["okres"]) ? "'".$_POST["okres"]."'" : "NULL";
$domy = !empty($_POST["domy"]) ? "'".$_POST["domy"]."'" : "NULL";
$den_prichodu = !empty($_POST["den_prichodu"]) ? "'".$_POST["den_prichodu"]."'" : "NULL";
$majitel_mot_vozidla = !empty($_POST["majitel_mot_vozidla"]) ? "'".$_POST["majitel_mot_vozidla"]."'" : "NULL";
$otec = !empty($_POST["otec"]) ? "'".$_POST["otec"]."'" : "NULL";
if (isset($_POST["otec_id"])) {
    $otec_id = $_POST["otec_id"];
} else {
    $otec_id = "NULL";
}
$matka = !empty($_POST["matka"]) ? "'".$_POST["matka"]."'" : "NULL";
if (isset($_POST["matka_id"])) {
    $matka_id = $_POST["matka_id"];
} else {
    $matka_id = "NULL";
}
$datum_presidleni = !empty($_POST["datum_presidleni"]) ? "'".$_POST["datum_presidleni"]."'" : "NULL";
$presidlil = !empty($_POST["presidlil"]) ? "'".$_POST["presidlil"]."'" : "NULL";
$datum_odhaseni = !empty($_POST["datum_odhaseni"]) ? "'".$_POST["datum_odhaseni"]."'" : "NULL";
$karta = !empty($_POST["karta"]) ? "'".$_POST["karta"]."'" : "NULL";
$informace = !empty($_POST["informace"]) ? "'".$_POST["informace"]."'" : "NULL";

if ($otec == "NULL" && $otec_id != "NULL"){
    $lide=get_persone($conn, $otec_id);
    foreach ($lide as $clovek);
        $otec = "'".$clovek["jmeno"]." ".$clovek["prijmeni"]."'";
}
if ($matka == "NULL" && $matka_id != "NULL"){
    $lide=get_persone($conn, $matka_id);
    foreach ($lide as $clovek);
        $matka = "'".$clovek["jmeno"]." ".$clovek["prijmeni"]."'";
}

if (isset($_POST["id"])) {
    $id = $_POST['id'];
    $sql = "UPDATE lide SET 
    jmeno = $jmeno,
    prijmeni = $prijmeni,
    datum_narozeni = $datum_narozeni,
    misto_narozeni = $misto_narozeni,
    rodinny_stav = $rodinny_stav,
    nabozenske_vyznani = $nabozenske_vyznani,
    statni_prislusnost = $statni_prislusnost,
    okres = $okres,
    dum_id = $domy,
    den_prichodu = $den_prichodu,
    otec_id = $otec_id,
    `otec-j` = $otec,
    matka_id = $matka_id,
    `matka-j` = $matka,
    majitel_mot_vozidla = $majitel_mot_vozidla,
    datum_presidleni = $datum_presidleni,
    presidlil = $presidlil,
    datum_odhaseni = $datum_odhaseni,
    karta = $karta,
    informace = $informace
    WHERE id = $id";

} else {
    $sql = "INSERT INTO lide(jmeno, prijmeni, datum_narozeni, misto_narozeni, rodinny_stav, nabozenske_vyznani, statni_prislusnost, okres, dum_id, den_prichodu, otec_id, `otec-j`, matka_id, `matka-j`, majitel_mot_vozidla, datum_presidleni, presidlil, datum_odhaseni, karta, informace) VALUES ($jmeno, $prijmeni, $datum_narozeni, $misto_narozeni, $rodinny_stav, $nabozenske_vyznani, $statni_prislusnost, $okres, $domy, $den_prichodu,  $otec_id, $otec, $matka_id, $matka, $majitel_mot_vozidla, $datum_presidleni, $presidlil, $datum_odhaseni, $karta, $informace)";
}
if (mysqli_query($conn, $sql)) {
    $response = "Data byla úspěšně uložena.";
} else {
    $response = "Chyba při ukládání dat: " . mysqli_error($conn);
}

disconenect_to_database($conn);
header("Location: editor.php?response=$response");
?>