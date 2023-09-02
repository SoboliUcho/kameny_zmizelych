<?php
require('_function_database.php');
$conn = conenect_to_database_kameny();
$id = $_POST['id'];
$type = $_POST["type"];
if ($type == "lide") {
    echo people($id, $conn);
} else {
    echo persone($id, $conn);
}
disconenect_to_database($conn);
function people($id, $conn)
{
    $sql = "SELECT * FROM lide WHERE dum_id = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $rensponse = [];
        while ($row = $result->fetch_assoc()) {
            $respons = [
                "id" => $row["id"],
                "jmeno" => $row["jmeno"],
                "prijmeni" => $row["prijmeni"]
            ];
            array_push($response, $respons);
        }
        return (json_encode($response, JSON_UNESCAPED_UNICODE));
    } else {
        return json_encode(["error" => "No data found for the given username."]);
    }
}

function persone($id, $conn)
{
    $sql = "SELECT * FROM lide WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return json_encode($row, JSON_UNESCAPED_UNICODE);
        }
    } else {
        return json_encode(["error" => "No data found for the given username."]);
    }
}

?>