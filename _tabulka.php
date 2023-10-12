<?php
require('_function_database.php');
$conn = conenect_to_database_kameny();
$id = $_POST['id'];
$type = $_POST["type"];
// $id = 1;
// $type = "people";

if ($type == "people") {
    echo (people($id, $conn));
} elseif($type == "persone"){
    echo (persone($id, $conn));
}
elseif($type == "edit"){
    echo(persone($id,$conn));
}
else{
    disconenect_to_database($conn);
}
function people($id, $conn)
{
    $sql = "SELECT id, jmeno, prijmeni FROM lide WHERE dum_id = '$id' ORDER BY `lide`.`prijmeni` ASC, `lide`.`jmeno` ASC ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $rensponse = array();
        while ($row = $result->fetch_assoc()) {
            $respons = [
                "id" => $row["id"],
                "jmeno" => $row["jmeno"],
                "prijmeni" => $row["prijmeni"]
            ];
            array_push($rensponse, $respons);
        }
        $odpoved =  json_encode($rensponse, JSON_UNESCAPED_UNICODE);
    } else {
        $odpoved = json_encode(["error" => "1No data found for the given username."], JSON_UNESCAPED_UNICODE);
        
    }
    return $odpoved;
}

function persone($id, $conn)
{
    // $sql = "SELECT *, otec.jmeno AS otec_jmeno, otec.prijmeni AS otec_prijmeni, matka.jmeno AS matka_jmeno, matka.prijmeni AS matka_prijmeni,  FROM lide WHERE id = '$id' 
    // LEFT JOIN lide AS otec ON lide.otec_id = otec.id 
    // LEFT JOIN lide AS matka ON lide.matka_id = matka.id
    // WHERE id = '$id'";
    $sql = "SELECT * FROM lide WHERE id = '$id'" ;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return json_encode($row, JSON_UNESCAPED_UNICODE);
        }
    } else {
        return json_encode(["error" => "No data found for the given username2."], JSON_UNESCAPED_UNICODE);
    }
}

?>