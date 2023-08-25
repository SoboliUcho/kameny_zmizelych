<?php
function conenect_to_database_kameny()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
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
    echo(mysqli_character_set_name($conn));
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
    // $conn = conenect_to_database_kameny();
    $domy = array();
    $sql = "SELECT * FROM domy";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Zde můžete pracovat s jednotlivými sloupci řádku
            // echo $row;
            array_push($domy, $row);
            // echo($row["ulice"]);
            // echo($row);
        }
    } else {
        return false;
    }
    $domypole= json_encode($domy, JSON_UNESCAPED_UNICODE);
    // echo($domypole);
    return $domypole;
}
?>