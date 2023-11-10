<?php
if (isset($_COOKIE['prihlaseni'])) {
    header("Location: prihlaseni.php");
}
require('_function_database.php');
// header('Content-Type: text/html; charset=utf-8');
$conn = conenect_to_database_kameny();
?>
<!DOCTYPE html>
<html lang="cz">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link rel="icon" href="https://www.muzeum-boskovicka.cz/sites/default/files/favicons/favicon-16x16.png"> -->
    <link rel="icon" href="images/icona.jpg">

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/lista.css">
    <link rel="stylesheet" href="css/loader.css">
    <!-- <link rel="stylesheet" href="css/tabulka.css"> -->
    <link rel="stylesheet" href="css/lide.css">

    <!-- <script src="js/logintable.js"></script> -->

    <script src="js\tabulka.js"></script>
    <title>Kameny zmizelých - lidé</title>
</head>

<body>
    <?php include('lista.php'); ?>
    <div >

    </div>

</body>

</html>