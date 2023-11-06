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
    <link rel="icon" href="icona.jpg">

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/mapacz.css">
    <link rel="stylesheet" href="css/lista.css">

    <!-- <script src="js/logintable.js"></script> -->
    <script type="text/javascript" src="https://api.mapy.cz/loader.js"></script>
    <script type="text/javascript">Loader.load()</script>
    <script src="js\mapa.js"></script>
    <script src="js\tabulka.js"></script>

    <title>Kameny zmizelých</title>

    <!-- <meta http-equiv="refresh" content="15"> -->
</head>

<body>
    <?php include('lista.php'); ?>
    <form action="_login.php" method="post">
        <form action="_login.php" id="log" method="post" class="log">
            <div class="log">
                <div class="pole">
                    <label for="Lname">Jméno</label>
                    <input type="text" id="Lname" placeholder="Jméno" class="login_pole" name="jmeno" pattern=".{4,}"
                        required>
                </div>
                <div class="pole">
                    <label for="password">Heslo</label>
                    <input type="password" id="password" placeholder="Heslo" class="login_pole" name="heslo"
                        pattern=".{6,}" required>
                </div>
                <div class="pole">
                    <label for="log_confirm">Přihlásit se</label>
                    <input type="submit" class="login_pole" name="log_confirm" value="Přihlásit se" id="log_confirm">
                </div>
            </div>
        </form>
    </form>
</body>