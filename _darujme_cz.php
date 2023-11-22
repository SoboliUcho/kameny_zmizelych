<?php
$apiId = 74234503;
$apiSecret = "g9qesn0jllgllrlyzv3umwd1k4y4d8wiwstsrglq";
$organizationId = 1200707;
$url = "https://www.darujme.cz/api/v1/organization/$organizationId/pledges-by-filter";

$data = array(
    'apiId' => $apiId,
    'apiSecret' => $apiSecret,
);

$url = $url . "?" . http_build_query($data);
// echo $url . "<br>";
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // odstranit!!


$response = curl_exec($ch);
print_r(json_decode($response));

// if ($response === FALSE) {
//     echo "Chyba při provádění cURL požadavku - ".  curl_error($ch);
// } else {
// }
// curl_close($ch);

// $response = file_get_contents($url);
// // print_r($response);
?>
<script>
    // request();
    function request() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                odpoved(xhr.responseText);
            }
        };
        var data = new FormData();
        data.append('apiId', "74234503");
        data.append("apiSecret", "g9qesn0jllgllrlyzv3umwd1k4y4d8wiwstsrglq");
        xhr.open("GET", "https://www.darujme.cz/api/v1/organization/1200707/pledges-by-filter?apiId=74234503&apiSecret=g9qesn0jllgllrlyzv3umwd1k4y4d8wiwstsrglq", true);
        xhr.send();
    }
    function odpoved(data){
        console.log(data)
    }
//     var script = document.createElement('script');
// script.src = 'https://www.darujme.cz/api/v1/organization/1200707/pledges-by-filter?apiId=74234503&apiSecret=g9qesn0jllgllrlyzv3umwd1k4y4d8wiwstsrglq&callback=myCallback';
// document.body.appendChild(script);

// function myCallback(data) {
//     console.log(data);
// }
</script>