<?php
// Uživatel pro správu databáze (má plná přístupová práva):
// Jméno: a331056_kameny
// Heslo: jSwfrnh4

// Uživatel s omezenými právy pro použití ve vašich skriptech:
// Jméno: w331056_kameny
// Heslo: p34vLN4d
function conenect_to_database_kameny()
{   
    require "log_tokens.php";
    $servername = $database["servername"];
    $username = $database["username"];
    $password = $database["password"];
    $dbname = $database["dbname"];

    // Vytvoření připojení
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8mb4");
    // Kontrola spojení
    if ($conn->connect_error) {
        // die("Spojení s databází selhalo: " . $conn->connect_error);
        return false;
    }
    return $conn;
    // echo "Spojení k databázi bylo úspěšně navázáno.";

}
function conenect_to_database($dbname)
{
    require "log_tokens.php";
    $servername = $database["servername"];
    $username = $database["username"];
    $password = $database["password"];

    // Vytvoření připojení
    $conn = new mysqli($servername, $username, $password, $dbname);
    // $conn->set_charset("utf8mb4");
    echo (mysqli_character_set_name($conn));
    // Kontrola spojení
    if ($conn->connect_error) {
        // die("Spojení s databází selhalo: " . $conn->connect_error);
        return false;
    }
    return $conn;
    // echo "Spojení k databázi bylo úspěšně navázáno.";

}
function disconenect_to_database($conn)
{
    // Uzavření spojení
    $conn->close();
}

function get_all_house($conn)
{
    $domy = array();
    $sql = "SELECT * FROM domy WHERE visible = 1 order by ulice ASC, cislo_domu ASC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $domy[] = $row;
        }
    } else {
        return false;
    }
    $domypole = json_encode($domy, JSON_UNESCAPED_UNICODE);
    return $domypole;
}
function get_house($id, $conn){
    $sql = "SELECT * FROM domy where id = $id";
    $result = $conn->query($sql);
    return $result;
}
function get_all_house_editor($conn)
{
    $domy = array();
    $sql = "SELECT * FROM domy order by stare_cislo ASC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $domy[] = $row;
        }
    } else {
        return false;
    }
    $domypole = json_encode($domy, JSON_UNESCAPED_UNICODE);
    return $domypole;
}
function people_in_house($house_id, $conn){
    $sql = "SELECT id, jmeno, prijmeni FROM lide WHERE dum_id = '$house_id'  AND visible = 1";
    $result = $conn->query($sql);
    return $result;
}
function get_all_persone($conn){
    $sql = "SELECT id, jmeno, prijmeni, datum_narozeni FROM lide ORDER BY `lide`.`prijmeni` ASC, `lide`.`jmeno` ASC ";
    $result = $conn->query($sql);
    return $result;
}

function get_persone($conn, $id){
    $sql = "SELECT id, jmeno, prijmeni FROM lide WHERE id = $id";
    $result = $conn->query($sql);
    return $result;
}

function get_all_report($conn){
    $sql = "SELECT * FROM `report`";
    $result = $conn->query($sql);
    return $result;
}

function get_persone_karta($conn, $id){
    $sql = "SELECT karta FROM lide WHERE id = $id";
    $result = $conn->query($sql);
    return $result;
}

function convertCzechToEnglish($text) {
    $czech = ['á', 'č', 'ď', 'é', 'ě', 'í', 'ň', 'ó', 'ř', 'š', 'ť', 'ú', 'ů', 'ý', 'ž', 'Á', 'Č', 'Ď', 'É', 'Ě', 'Í', 'Ň', 'Ó', 'Ř', 'Š', 'Ť', 'Ú', 'Ů', 'Ý', 'Ž',' '];
    $english = ['a', 'c', 'd', 'e', 'e', 'i', 'n', 'o', 'r', 's', 't', 'u', 'u', 'y', 'z', 'A', 'C', 'D', 'E', 'E', 'I', 'N', 'O', 'R', 'S', 'T', 'U', 'U', 'Y', 'Z','-'];

    return str_replace($czech, $english, $text);
}

function get_all_persone_location($conn){
    $sql = "SELECT 
    l.id, 
    l.jmeno, 
    l.prijmeni, 
    l.datum_narozeni,
    l.dum_id, 
    d.ulice,
    d.cislo_domu
    FROM lide l 
    JOIN domy d on d.id = l.dum_id
    WHERE l.visible = 1
    ORDER BY l.prijmeni ASC, l.jmeno ASC";
    $result = $conn->query($sql);
    return $result;
}

function get_all_spravce($conn){
    $sql = "SELECT * FROM spravci";
    $result = $conn->query($sql);
    return $result;
}
function get_spravce($id, $conn){
    $sql = "SELECT * FROM spravci WHERE id = $id";
    $result = $conn->query($sql);
    return $result;
}
function get_donator($id, $conn){
    $sql = "SELECT * FROM donatori WHERE id = $id";
    $result = $conn->query($sql);
    return $result;
}
function get_all_donators($conn){
    $sql = "SELECT * FROM donatori";
    $result = $conn->query($sql);
    return $result;
}

function get_spravovane($conn, $id){
    $sql = "SELECT 
    l.id, 
    l.jmeno, 
    l.prijmeni, 
    l.datum_narozeni,
    l.dum_id, 
    d.ulice,
    d.cislo_domu
    FROM lide l 
    JOIN domy d on d.id = l.dum_id
    where l.spravce = $id
    ORDER BY l.prijmeni ASC, l.jmeno ASC";
    $result = $conn->query($sql);
    return $result;
}
function get_nespravovane($conn){
    $sql = "SELECT 
    l.id, 
    l.jmeno, 
    l.prijmeni, 
    l.datum_narozeni,
    l.dum_id, 
    d.ulice,
    d.cislo_domu
    FROM lide l 
    JOIN domy d on d.id = l.dum_id
    where l.spravce is NULL AND l.visible = 1
    ORDER BY l.prijmeni ASC, l.jmeno ASC";
    $result = $conn->query($sql);
    return $result;
}

function data_nick(){
    $nicks = array(
    "id",
    "jmeno",
    "prijmeni",
    "rozena",
    "pohlavi",
    "datum_narozeni",
    "misto_narozeni",
    "statni_prislusnost",
    "nabozenske_vyznani",
    "den_prichodu",
    "transport",
    "presidlil",
    "transport_tere",
    "datum_trans_tere",
    "mrtvy",
    "realmrtvy",
    "dum_id", 
    "rodinny_stav",
    "partner_id",
    "partner",
    "otec_id", 
    "otec-j",
    "matka_id", 
    "matka-j",
    "deti_id", 
    "deti",
    "datum_presidleni",
    "datum_odhaseni",
    "zamnestnani",
    "majitel_mot_vozidla",
    "odkazy",
    "karta", 
    "informace", 
    // "spravce"
    "visible",
    );
    return $nicks;
}
function nicks_alter(){
    $cz = [
        "Id",
        "Jméno",
        "Příjmení",
        "Rozená",
        "Pohlavi",
        "Datum narození",
        "Místo narození",
        "Státní příslušnost",
        "Náboženské vyznání",
        "Den příchodu",
        "Číslo transportu do Terezína",
        "Datum trasportu do Terezína",
        "Číslo transportu z Terezína",
        "Datum trasportu z Terezína",
        "Prohlášen za mrtvého",
        "Zemřel", 
        "Dům",
        "Rodinný stav",
        "Partner z databaze",
        "Partner",
        "Otec z databaze",
        "Otec",
        "Matka z databaze",
        "Matka",
        "Děti z databaze",
        "Děti",
        "Datum přesídlení",
        "Datum odhlášení",
        "Zaměstnání",
        "Majitel motorového vozidla",
        "Odkazy",
        "Fotky",
        "Další informace",
        "Viditelný"
    ];
    return $cz;
}

function get_all_clanky($conn){
    $sql = "SELECT * FROM napsali ORDER BY datum DESC;";
    $result = $conn->query($sql);
    return $result;
}

?>