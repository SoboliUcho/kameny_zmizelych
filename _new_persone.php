<?php
require('_function_database.php');
$conn = conenect_to_database_kameny();

$promnene = data_nick();
// přečtení dat
print_r($_POST);
for ($i = 0; $i < count($promnene); $i++) {
    if ($promnene[$i] == 'karta') {
        $karta = !empty($_FILES["karta"]) ? karta($jmeno, $prijmeni) : "NULL";
        continue;
    }
    if ($promnene[$i] == "deti") {
        $deti = $_POST["deti"];
        continue;
    }
    if ($promnene[$i] == "deti_id") {
        $deti_id = $_POST["deti_id"];
        continue;
    }
    if ($promnene[$i] == "odkazy") {
        $odkazy = $_POST["odkazy"];
        $url = $_POST["url"];
        continue;
    }
    if ($promnene[$i] == "informace") {
        $_POST["informace"] = trim($_POST["informace"]);
    }
    if (isset($_POST[$promnene[$i]]) && !empty($_POST[$promnene[$i]])) {
        if ($promnene[$i] == "otec-j") {
            $otec = "'" . $_POST[$promnene[$i]] . "'";
        }
        if ($promnene[$i] == "matka-j") {
            $matka = "'" . $_POST[$promnene[$i]] . "'";
        } else {
            ${$promnene[$i]} = "'" . $_POST[$promnene[$i]] . "'";
        }
    } else {
        if ($promnene[$i] == "otec-j") {
            $otec = "NULL";
        }
        if ($promnene[$i] == "matka-j") {
            $matka = "NULL";
        } else {
            ${$promnene[$i]} = "NULL";
        }
    }
    if ($promnene[$i] == "otec-j") {
        $promnene[$i] = "otec";
    }
    if ($promnene[$i] == "matka-j") {
        $promnene[$i] = "matka";
    }
}
// print_r($promnene);
// if ($informace == "' '"){
//     $informace = "NULL";
// }
// echo "informace";
// echo $informace;
// uprava lidí
if ($otec == "NULL" && $otec_id != "NULL") {
    $lide = get_persone($conn, $otec_id);
    foreach ($lide as $clovek) {
        $otec = "'" . $clovek["jmeno"] . " " . $clovek["prijmeni"] . "'";
    }
}
if ($matka == "NULL" && $matka_id != "NULL") {
    $lide = get_persone($conn, $matka_id);
    foreach ($lide as $clovek) {
        $matka = "'" . $clovek["jmeno"] . " " . $clovek["prijmeni"] . "'";
    }
}
if ($partner == "NULL" && $partner_id != "NULL") {
    $lide = get_persone($conn, $partner_id);
    foreach ($lide as $clovek) {
        $partner = "'" . $clovek["jmeno"] . " " . $clovek["prijmeni"] . "'";
    }
}
// print_r($deti);

$deti_ararray = array();
$deti_id_ararray = array();

if ($deti != "NULL" && count($deti) > 0) {
    for ($i = 0; $i < count($deti); $i++) {
        if (!empty($deti_id[$i])) {
            $lide = get_persone($conn, $deti_id[$i]);
            foreach ($lide as $clovek) {
                $deti_ararray[] =  $clovek["jmeno"] . " " . $clovek["prijmeni"];
                $deti_id_ararray[] = $deti_id[$i];
            }
        } else if (!empty($deti[$i])) {
            $deti_ararray[] = "'" . $deti_id[$i] . "'";
            $deti_id[$i] = "NULL";
        }
    }
}
if (!empty($deti_ararray)) {
    $deti = "'".json_encode($deti_ararray, JSON_UNESCAPED_UNICODE)."'";
    $deti_id = "'".json_encode($deti_id_ararray, JSON_UNESCAPED_UNICODE)."'";
} else {
    $deti = "NULL";
    $deti_id = "NULL";
}

$odkaz_ararray = array();
$url_ararray = array();

if ($url != "NULL" && count($url) > 0) {
    for ($i = 0; $i < count($url); $i++) {
        if (!empty($odkazy[$i])) {
            $odkaz_ararray[] = $odkazy[$i];
            $url_ararray[] = $url[$i];
        } else if (!empty($url[$i])) {
            $odkaz_ararray[] = $url[$i];
            $url_ararray[] = $url[$i];
        }
    }
}
if (!empty($odkaz_ararray)) {
    for ($i = 0; $i < count($odkaz_ararray); $i++) {
        // echo ("<br>");
        // print_r($odkaz_ararray[$i]);
        // echo ("<br>");
        // print_r([$odkaz_ararray[$i], $url_ararray[$i]]);
        $odkaz_ararray[$i] = [$odkaz_ararray[$i], $url_ararray[$i]];
    }
    $odkazy = "'".json_encode($odkaz_ararray, JSON_UNESCAPED_UNICODE)."'";
} else {
    $odkazy = "NULL";
}

// práce s obrázky
if (isset($_POST["id"])) {
    $sql = get_persone_karta($conn, $_POST["id"]);
    $old_karta_json = "";
    foreach ($sql as $okarta) {
        $old_karta_json = $okarta["karta"];
    }
    $old_karta = json_decode($old_karta_json, true);
} else {
    $old_karta = "NULL";
}

if (($karta != "NULL" && isset($_POST["id"])) || isset($_POST["del_images"])) {
    if (isset($_POST["del_images"])) {
        $del_images = $_POST["del_images"];
        for ($i = 0; $i < count($del_images); $i++) {
            foreach ($old_karta as $index => $okarta) {
                if ($okarta === $del_images[$i]) {
                    unset($old_karta[$index]);
                    break;
                }
            }
            try {
                unlink($del_images[$i]);
            } catch (Exception $e) {
            }
        }
    }

    if ($karta != "NULL") {
        for ($i = 0; $i < count($karta); $i++) {
            $old_karta[] = $karta[$i];
        }
    }
}
if ($old_karta != "NULL") {
    $old_karta = "'" . json_encode($old_karta, JSON_UNESCAPED_UNICODE) . "'";
    $karta = $old_karta;
}
// odeslání do databáze
if (isset($_POST["id"])) {
    $id = $_POST['id'];
    $sql = "UPDATE lide SET ";
    for ($i = 0; $i < count($promnene); $i++) {
        // echo $promnene[$i]." = ". ${$promnene[$i]} ."<br>";
        if ($promnene[$i] == "otec") {
            $sql .= "`otec-j`" . " = " . ${$promnene[$i]}.", ";
            echo `<br>kontrola otec-j` . " = " . ${$promnene[$i]}.", ";
            continue;
        }
        if ($promnene[$i] == "matka") {
            $sql .= "`matka-j`" . " = " . ${$promnene[$i]}.", ";
            continue;
        } else {
            $sql .= $promnene[$i] . " = " . ${$promnene[$i]};
        }
        if ($i != count($promnene) - 1) {
            $sql .= ", ";
        }
    }
    $sql .= " WHERE id = $id";
    echo "<br>";

} else {
    $sql = "INSERT INTO lide(";
    for ($i = 0; $i < count($promnene); $i++) {
        if ($promnene[$i] == "otec") {
            $sql .= `otec-j`;
        }
        if ($promnene[$i] == "matka") {
            $sql .= `matka-j`;
        } else {
            $sql .= $promnene[$i];
        }
        if ($i != count($promnene) - 1) {
            $sql .= ", ";
        }
    }
    $sql .= ") VALUES (";
    for ($i = 0; $i < count($promnene); $i++) {
        if ($promnene[$i] == "otec-j") {
            $sql .= $otec;
        }
        if ($promnene[$i] == "matka-j") {
            $sql .= $matka;
        } else {
            $sql .= ${$promnene[$i]};
        }
        if ($i != count($promnene) - 1) {
            $sql .= ", ";
        }
    }
    $sql .= ")";
}
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

// uprava obrazku
function karta($jmeno, $prijmeni)
{

    $files = $_FILES["karta"];
    $images = array();
    foreach ($files['name'] as $key => $name) {
        $fileTmpName = $files['tmp_name'][$key];
        $fileSize = $files['size'][$key];
        $fileError = $files['error'][$key];
        $fileName = $files["name"][$key];
        if ($fileError === 0) {
            $fileName = str_replace("'", "", $jmeno) . "_" . str_replace("'", "", $prijmeni) . "_" . uniqid() . "_" . $fileName;
            $fileName = convertCzechToEnglish($fileName);
            $uploadPath = "karty/" . $fileName;
            move_uploaded_file($fileTmpName, $uploadPath);
            $images[] = $uploadPath;
        }
    }
    if (count($images) > 0) {
        return $images;
    }
    return "NULL";
}
?>