<?php
function load_data_dar($conn)
{
    require "log_tokens.php";
    $url = "https://www.darujme.cz/api/v1/organization/" . $darujme_api["organizationId"] . "/pledges-by-filter";

    $data = array(
        'apiId' => $darujme_api["apiId"],
        'apiSecret' => $darujme_api["apiSecret"],
    );

    $response = get_data_from_darujme_curl($url);
    // $response = get_data_by_file_get("_darujme_cz_out_JSON.json");
    $response = json_decode($response, true);
    $donatori_dar = array();
    for ($i = 0; $i < count($response["pledges"]); $i++) {
        // echo "$i: ";
        $clovek = array(
            "jmeno" => $response["pledges"][$i]['donor']['firstName'] . " " . $response["pledges"][$i]['donor']['lastName'] . " ",
            "email" => $response["pledges"][$i]['donor']['email'],
        );
        $counter = 0;
        for ($j = 0; $j < count($response["pledges"][$i]['transactions']); $j++) {
            // print_r($response["pledges"][$i]['transactions'][$j]);
            // echo ("<br>");
            // echo ("<br>");
            if (isset($response["pledges"][$i]['transactions'][$j]["sentAmount"]["cents"])) {
                $money = floatval($response["pledges"][$i]['transactions'][$j]["sentAmount"]["cents"]) / 100;
                $counter += $money;
            }
        }
        $clovek["castka"] = $counter;
        $donatori_dar[] = $clovek;
        // print_r($clovek);
        // echo "<br>";
    }

    $donatori_db = get_all_donators($conn);
    $response = "";
    foreach ($donatori_dar as $donator_dar) {
        $zapsat = true;
        foreach ($donatori_db as $donator_db) {
            if ($donator_dar["jmeno"] == $donator_db["jmeno"] && $donator_dar["email"] == $donator_db["email"]) {
                if ($donator_dar["castka"] > $donator_db["castka"]) {
                    $castka = $donator_dar["castka"];
                    $id = $donator_db["id"];
                    $sql = "UPDATE donatori SET castka = $castka ,visible = 1 WHERE id = $id";
                    if (mysqli_query($conn, $sql)) {
                        $response .= $donator_dar["jmeno"] . "byl úspěšně uložena. ";
                    } else {
                        $response .= "Chyba při ukládání dat: " . mysqli_error($conn);
                    }
                }
                $zapsat = false;
                break;
            }
        }
        if ($zapsat) {
            $jmeno = $donator_dar["jmeno"];
            $email = $donator_dar["email"];
            $castka = $donator_dar["castka"];
            if ($castka > 0) {
                $visible = 1;
            } else {
                $visible = 0;
            }
            $sql = "INSERT INTO donatori (jmeno,email,castka,visible) values ('$jmeno', '$email', $castka, $visible)";
            if (mysqli_query($conn, $sql)) {
                $response .= $donator_dar["jmeno"] . "byl úspěšně uložena. ";
            } else {
                $response .= "Chyba při ukládání dat: " . mysqli_error($conn);
            }
        }

        // echo $sql;
        // $response .= "<br>";
    }
    if ($response == "") {
        $response = "Data jsou aktuální.";
    }
    // echo ($response);
    return $response;
}


function get_data_from_darujme_curl($url)
{
    require "log_tokens.php";

    $data = array(
        'apiId' => $darujme_api["apiId"],
        'apiSecret' => $darujme_api["apiSecret"],
    );
    $url = $url . "?" . http_build_query($data);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // odstranit!!

    $response = curl_exec($ch);
    curl_close($ch);
    return $response;

}
function get_data_by_file_get($url)
{
    $response = file_get_contents($url);
    return $response;
}
?>