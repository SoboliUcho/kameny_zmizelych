<?php

require('_function_database.php');
require('_darujme_cz_functions.php');
$conn = conenect_to_database_kameny();

if (isset($_COOKIE['prihlaseni'])) {
  // header("Location: prihlaseni.php");
  load_data_dar($conn);
}
$old_date = get_data_by_file_get("update_date.txt");
$curent_date = date("Y-m-d");
$curent_date = strtotime($curent_date . " 00:00:00");
if ($old_date < $curent_date){
  load_data_dar($conn);
  file_put_contents( "update_date.txt", $curent_date);
}

if (isset($_GET['stranka'])) {
  $cislo_pvniho = ($_GET['stranka'] - 1) * $pocet_na_stranku;
  $urlarray = $_GET;
  $stranka = $_GET['stranka'];
  unset($urlarray['stranka']);
} else {
  $cislo_pvniho = 0;
  $stranka = 1;
  $urlarray = $_GET;
}
?>

<!DOCTYPE html>
<html lang="cz">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="icon" href="https://www.muzeum-boskovicka.cz/sites/default/files/favicons/favicon-16x16.png">
  <!-- <link rel="icon" href="images/icona.jpg"> -->

  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/lista.css">
  <link rel="stylesheet" href="css/loader.css">
  <!-- <link rel="stylesheet" href="css/tabulka.css"> -->
  <link rel="stylesheet" href="css/lide.css">
  <link rel="stylesheet" href="css/ciselnik.css">
  <link rel="stylesheet" href="css/podporovatele.css">


  <!-- <script src="js/logintable.js"></script> -->

  <script src="js\tabulka.js"></script>
  <script src="js\podporovatele.js"></script>

  <title>Podporovatelé | Kameny zmizelých</title>
</head>

<body>
  <?php include('lista.php'); ?>
  <div class="prpinace">
    <div class="prepinac <?php
    if (!isset($_GET['spravci']) && !isset($_GET['kamen'])) {
      echo "active";
    } ?>" id="prispeli">Přispěli</div>
    <div class="prepinac <?php
    if (isset($_GET['spravci'])) {
      echo "active";
    } ?>" id="spravci">Správci kamenů</div>
    <div class="prepinac <?php
    if (isset($_GET['kamen'])) {
      echo "active";
    } ?>" id="kamen">Kameny k adopci</div>
  </div>
  <div id="nelista">

    <script>
      // prepnout();
      document.getElementById("prispeli").addEventListener("click", prepnout);
      document.getElementById("spravci").addEventListener("click", prepnout);
      document.getElementById("kamen").addEventListener("click", prepnout);

    </script>

    <div class="prispeli" id="prispeli_tabulka" style="<?php
    if (isset($_GET['spravci']) || isset($_GET['kamen'])) {
      echo "display: none;";
    }
    ?>">
      <div class="donatori">
        <?php
        $donatorove = get_all_donators($conn);
        foreach ($donatorove as $donator) {
          if ($donator['visible'] == 0 && !isset($_COOKIE['prihlaseni'])) {
            continue;
          }
          $id = $donator["id"];
          $jmeno = $donator["jmeno"];
          $email = $donator["email"];
          $penize = $donator["castka"];
          echo "<div class='clovek' id='podpora$id'>
            <div class='center'>
              <div class='zaklad'>
                <div class='jmeno'>$jmeno</div>";
          if (isset($_COOKIE['prihlaseni'])) {
            echo "<div class='email'>$email</div>
                <div class='penize'>$penize Kč</div>";
          }
          echo "</div>
            </div>
          </div>";
        }
        ?>
      </div>
      <div data-darujme-widget-token="11m962ohzsouwbdi" id="darovat">&nbsp;</div>
      <script type="text/javascript">
        +function (w, d, s, u, a, b) {
          w['DarujmeObject'] = u;
          w[u] = w[u] || function () { (w[u].q = w[u].q || []).push(arguments) };
          a = d.createElement(s); b = d.getElementsByTagName(s)[0];
          a.async = 1; a.src = "https:\/\/www.darujme.cz\/assets\/scripts\/widget.js";
          b.parentNode.insertBefore(a, b);
        }(window, document, 'script', 'Darujme');
        Darujme(1, "11m962ohzsouwbdi", 'render', "https:\/\/www.darujme.cz\/widget?token=11m962ohzsouwbdi", "100%");
      </script>
    </div>

    <div class="starost" id="starost" style="<?php
    if (!isset($_GET['spravci'])) {
      echo "display: none;";
    }
    ?>">
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
        if (isset($_COOKIE['prihlaseni'])) {
          echo "<div class='email'>$email</div>";
        }
        echo "<button class='vice' value='$id' id='button$id'> Spravuje</button>
              </div>";
        $spravovane = get_spravovane($conn, $id);
        $datainsert = "";
        foreach ($spravovane as $kamen) {
          $jmeno = $kamen["jmeno"] . " " . $kamen["prijmeni"];
          $date_of_birth = $kamen["datum_narozeni"];
          $timestamp = strtotime($date_of_birth);
          $date_of_birth = date("j. n. Y", $timestamp);
          $adresa = $kamen["ulice"] . " " . $kamen["cislo_domu"];
          $datainsert .= "<div class='kamen'>
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
            if (rozsireni[0].classList.contains('hidden')) {
            rozsireni[0].classList.remove('hidden');
            setTimeout(function () {
            rozsireni[0].classList.remove('visuallyhidden');
            }, 20);
            console.log(event.target.value)}
            else {
              rozsireni[0].classList.add('hidden');
            setTimeout(function () {
            rozsireni[0].classList.add('visuallyhidden');
            }, 20);
            }
      
        })
        </script>";

        echo "</div>
            </div>";
      }
      ?>
    </div>

    <div class="volne" id="volne" style="<?php
    if (!isset($_GET['kamen'])) {
      echo "display: none;";
    }
    ?>">

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
        echo "<div class='clovek' id='$id'>
                <div class='center'>
            <div class='zaklad'>
              <div class='jmeno'>$jmeno</div>
              <div class='data'>
                <div class='datum'>$date_of_birth</div>
                <div class='bydliste'>$adresa</div>
              </div>
            </div>
            </div>
            </div>
            ";
      }
      ?>
    </div>
  </div>

</body>

</html>