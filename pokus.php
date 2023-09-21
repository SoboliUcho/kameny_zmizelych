<?php
require('_function_database.php');
// header('Content-Type: text/html; charset=utf-8');
$conn = conenect_to_database_kameny();
?>

<!DOCTYPE html>
<html lang="cz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="icona.jpg">

    <link rel="stylesheet" href="css/main.css">
    <script type="text/javascript" src="https://api.mapy.cz/loader.js"></script>
    <script type="text/javascript">Loader.load();</script>

    <!-- <script src="js\mapa.js"></script>
    <script src="js\tabulka.js"></script> -->
    <script src="js\editor.js"></script>

    <title>editor</title>
</head>

<body id="advanced-geocoding">
    <div>
        <form id="form">
            <p>
                <label>Hledaná oblast: </label><input type="text" id="query" value="Radlická 2" />
                <input type="submit" value="Hledat" />
            </p>
        </form>
        <script type="text/javascript">
            var form = JAK.gel("form");
            JAK.Events.addListener(form, "submit", geokoduj); 

        </script>
    </div>
</body>

</html>