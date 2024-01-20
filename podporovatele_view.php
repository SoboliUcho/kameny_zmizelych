<?php
if (isset($_COOKIE['prihlaseni'])) {
    // header("Location: prihlaseni.php");
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
    <title>Kameny zmizelých - Podporovatelé</title>
</head>

<body>
    <?php include('lista.php'); ?>
    <div id="nelista">
        <h2>Přispěli</h2>
        <?php
        $spravcove = get_all_donators($conn);
        foreach ($spravcove as $spravce) {
            if ($spravce['visible'] == 0) {
                continue;
            }
            $id = $spravce["id"];
            $jmeno = $spravce["jmeno"];
            $email = $spravce["email"];
            $penize = $spravce["castka"];

            echo "<div class='clovek' id='podpora$id'>
            <div class='center'>
              <div class='zaklad'>
                <div class='jmeno'>$jmeno</div>";
            if (true) {
                echo "<div class='email'>$email</div>
                <div class='penize'>$penize Kč</div>";
            }
            echo "</div>
            </div>
          </div>";
        }
        ?>
        <h2>O kameny se starají:</h2>
        <?php
        $spravcove = get_all_spravce($conn);
        foreach ($spravcove as $spravce) {
            if ($spravce['visible'] == 0) {
                continue;
            }
            $id = $spravce["id"];
            $jmeno = $spravce["jmeno"];
            $email = $spravce["email"];

            echo "<div class='clovek' id='$id'>
            <div class='center'>
              <div class='zaklad'>
                <div class='jmeno'>$jmeno</div>";
            if (true) {
                echo "<div class='email'>$email</div>
                <button class='vice' value='$id' id='button$id'> Více informací</button>
              </div>";
                $spravovane = get_spravovane($conn, $id);
                $datainsert = "";
                foreach ($spravovane as $kamen) {
                    $jmeno = $kamen["jmeno"] . " " . $kamen["prijmeni"];
                    $date_of_birth = $kamen["datum_narozeni"];
                    $timestamp = strtotime($date_of_birth);
                    $date_of_birth = date("j. n. Y", $timestamp);
                    $adresa = $kamen["ulice"] . " " . $kamen["cislo_domu"];
                    $datainsert .= "<div class='clovek'>
                    <div class='subjmeno'>$jmeno</div>
                    <div class='data'>
                      <div class='datum'>$date_of_birth</div>
                      <div class='bydliste'>$adresa</div>
                    </div>
                  </div>";
                }
                echo "<div class='rozsireni hidden visuallyhidden'>$datainsert</div>
                <script>
                var button$id = document.getElementById('button$id')
                button$id.addEventListener('click', function clik_on_button(event) {
                    var clovek = document.getElementById('$id');
                    var rozsireni = clovek.getElementsByClassName('rozsireni');
                    rozsireni[0].classList.remove('hidden');
                    setTimeout(function () {
                    rozsireni[0].classList.remove('visuallyhidden');
                    }, 20);
                    console.log(event.target.value)
                })
                </script>";
            }
            echo "</div>
            </div>
            </div>";
        }
        ?>
        <h2>Kameny k adopci:</h2>
        <?php
        $spravovane = get_nespravovane($conn);
        // print_r($spravovane);
        $datainsert = "";
        foreach ($spravovane as $kamen) {
            // print_r($kamen);
            $jmeno = $kamen["jmeno"] . " " . $kamen["prijmeni"];
            $date_of_birth = $kamen["datum_narozeni"];
            $timestamp = strtotime($date_of_birth);
            $date_of_birth = date("j. n. Y", $timestamp);
            $adresa = $kamen["ulice"] . " " . $kamen["cislo_domu"];
            $datainsert .= "<div class='clovek'>
            <div class='subjmeno'>$jmeno</div>
            <div class='data'>
              <div class='datum'>$date_of_birth</div>
              <div class='bydliste'>$adresa</div>
            </div>
          </div>";
        }
        echo $datainsert;
        ?>
    </div>

</body>
</html>