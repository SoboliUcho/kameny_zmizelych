<?php
function conenect_to_database_kameny()
{   
    $servername = "servername";
    $username = "username";
    $password = "password";
    $dbname = "kameny";

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
    $servername = "localhost";
    $username = "root";
    $password = "";

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
    $sql = "SELECT * FROM domy";
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
    ORDER BY l.prijmeni ASC, l.jmeno ASC";
    $result = $conn->query($sql);
    return $result;
}
?>
