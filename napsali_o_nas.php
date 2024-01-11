<<<<<<< HEAD
<?php
require('_function_database.php');
// header('Content-Type: text/html; charset=utf-8');
$conn = conenect_to_database_kameny();
if (isset($_GET['pocet'])) {
  $pocet_na_stranku = $_GET['pocet'];
} else {
  $pocet_na_stranku = 20;
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
if (isset($_GET['datum']) && !empty($_GET["datum"])) {
  $datum = $_GET['datum'];
  $datum = strtotime($datum);
} else {
  $datum = "NULL";
}
if (isset($_GET["response"])) {
  $response = $_GET["response"];
  echo ('
  <script>alert("' . $response . '");</script>');
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
  <link rel="stylesheet" href="css/ciselnik.css">
  <link rel="stylesheet" href="css/clanky.css">

  <!-- <script src="js/logintable.js"></script> -->

  <script src="js\tabulka.js"></script>
  <title>Napsali o nás | Kameny zmizelých</title>
</head>

<body>
  <?php include('lista.php'); ?>
  <div class="form">
    <form action="napsali_o_nas.php" method="get">
      <label for="datum">Datum
        <input type="date" name="datum" class="vyber" value="<?php if (isset($_GET['datum']) && !empty($_GET["datum"])) {
          echo $_GET['datum'];
        } ?>">
      </label>
      <label for="pocet">Počet článků na stránce
        <select name="pocet" class="vyber" id="pocet">
          <option value="20" <?php if ($pocet_na_stranku == 20) {
            echo "selected";
          } ?>>20</option>
          <option value="50" <?php if ($pocet_na_stranku == 50) {
            echo "selected";
          } ?>>50</option>
          <option value="100" <?php if ($pocet_na_stranku == 100) {
            echo "selected";
          } ?>>100</option>
        </select>
      </label>
      <input class="filtrovat" type="submit" value="Filtrovat">
    </form>
  </div>
  <?php if (isset($_COOKIE['prihlaseni'])) {
    include('novyclanek.php');
  }
  ?>
  <div id="nelista">

    <?php
    $clanky = get_all_clanky($conn);
    // $pocet = mysqli_num_rows($people);
    $counter_all_condition = 0;
    $counter = 0;
    foreach ($clanky as $clanek) {
      $id = $clanek["id"];
      $name = $clanek["nadpis"];
      $url = $clanek["odkaz"];
      $date = $clanek["datum"];
      $timestamp = strtotime($date);
      $date_visible = date("j. n. Y", $timestamp);
      $text = $clanek["slova"];

      if ($datum != "NULL" && $datum < $timestamp) {
        continue;
      }
      $counter_all_condition++;
      $counter++;
      if ($counter <= $cislo_pvniho) {
        continue;
      }
      // echo $_GET["stranka"];
    
      if ($counter > ($cislo_pvniho + $pocet_na_stranku)) {
        continue;
      }

      echo "<div class='clanek' id='$id'>
      <div class='center'>
        <div class='datum'>$date_visible</div>
        <div class='odkaz'>
          <a href='$url' target='_blank' class = 'nazev'>$name</a>
          <div class='popis'>$text</div>
        </div>
        <a href='$url' target='_blank' class='tlacitko'>Zobrazit</a>";
      
      if (isset($_COOKIE['prihlaseni'])) {
        echo "<button class='edit' value='$id' id='button$id'>Opravit</button>
        <script>
            var tlacitko = document.getElementById('button$id');
            tlacitko.addEventListener('click', function clik_on_button(event) {
                var form = document.getElementById('novy_clanek')
                var id_pole = document.getElementById('idform');
                var url_pole = document.getElementById('urlform');
                var nazev_pole = document.getElementById('nadpisform');
                var text_pole = document.getElementById('popisekform');
                var datum_pole = document.getElementById('datumform');
                id_pole.value = '$id';
                datum_pole.value = '$date';
                nazev_pole.value = '$name';
                text_pole.value = '$text'
                url_pole.value = '$url'
            })
        </script>";
      }
      echo "</div>
      </div>";

    }
    disconenect_to_database($conn)
      ?>
  </div>
  <div class="ciselnik">
    <?php
    $stranky = ceil($counter_all_condition / $pocet_na_stranku);
    // echo"$stranky $counter_all_condition";
    $urlarray = $_GET;
    for ($i = 1; $i <= $stranky; $i++) {
      if ($stranky == 1){
        break;
      }
      $urlarray["stranka"] = $i;
      $url = http_build_query($urlarray);
      $url = "napsali_o_nas.php?" . $url;

      if ($stranka == $i) {
        echo "<a href='$url'>
        <div class='stranka aktualni'>$i</div>
        </a>";
      } else {
        echo "<a href='$url'>
      <div class='stranka'>$i</div>
      </a>";
      }
    }
    // print_r($_GET);
    ?>
  </div>
</body>

=======
<?php
require('_function_database.php');
// header('Content-Type: text/html; charset=utf-8');
$conn = conenect_to_database_kameny();
if (isset($_GET['pocet'])) {
  $pocet_na_stranku = $_GET['pocet'];
} else {
  $pocet_na_stranku = 20;
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
if (isset($_GET['datum']) && !empty($_GET["datum"])) {
  $datum = $_GET['datum'];
  $datum = strtotime($datum);
} else {
  $datum = "NULL";
}
if (isset($_GET["response"])) {
  $response = $_GET["response"];
  echo ('
  <script>alert("' . $response . '");</script>');
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
  <link rel="stylesheet" href="css/ciselnik.css">
  <link rel="stylesheet" href="css/clanky.css">

  <!-- <script src="js/logintable.js"></script> -->

  <script src="js\tabulka.js"></script>
  <title>Napsali o nás | Kameny zmizelých</title>
</head>

<body>
  <?php include('lista.php'); ?>
  <div class="form">
    <form action="napsali_o_nas.php" method="get">
      <label for="datum">Datum
        <input type="date" name="datum" class="vyber" value="<?php if (isset($_GET['datum']) && !empty($_GET["datum"])) {
          echo $_GET['datum'];
        } ?>">
      </label>
      <label for="pocet">Počet článků na stránce
        <select name="pocet" class="vyber" id="pocet">
          <option value="20" <?php if ($pocet_na_stranku == 20) {
            echo "selected";
          } ?>>20</option>
          <option value="50" <?php if ($pocet_na_stranku == 50) {
            echo "selected";
          } ?>>50</option>
          <option value="100" <?php if ($pocet_na_stranku == 100) {
            echo "selected";
          } ?>>100</option>
        </select>
      </label>
      <input class="filtrovat" type="submit" value="Filtrovat">
    </form>
  </div>
  <?php if (isset($_COOKIE['prihlaseni'])) {
    include('novyclanek.php');
  }
  ?>
  <div id="nelista">

    <?php
    $clanky = get_all_clanky($conn);
    // $pocet = mysqli_num_rows($people);
    $counter_all_condition = 0;
    $counter = 0;
    foreach ($clanky as $clanek) {
      $id = $clanek["id"];
      $name = $clanek["nadpis"];
      $url = $clanek["odkaz"];
      $date = $clanek["datum"];
      $timestamp = strtotime($date);
      $date_visible = date("j. n. Y", $timestamp);
      $text = $clanek["slova"];

      if ($datum != "NULL" && $datum < $timestamp) {
        continue;
      }
      $counter_all_condition++;
      $counter++;
      if ($counter <= $cislo_pvniho) {
        continue;
      }
      // echo $_GET["stranka"];
    
      if ($counter > ($cislo_pvniho + $pocet_na_stranku)) {
        continue;
      }

      echo "<div class='clanek' id='$id'>
      <div class='center'>
        <div class='datum'>$date_visible</div>
        <div class='odkaz'>
          <a href='$url' target='_blank' class = 'nazev'>$name</a>
          <div class='popis'>$text</div>
        </div>
        <a href='$url' target='_blank' class='tlacitko'>Zobrazit</a>";
      
      if (isset($_COOKIE['prihlaseni'])) {
        echo "<button class='edit' value='$id' id='button$id'>Opravit</button>
        <script>
            var tlacitko = document.getElementById('button$id');
            tlacitko.addEventListener('click', function clik_on_button(event) {
                var form = document.getElementById('novy_clanek')
                var id_pole = document.getElementById('idform');
                var url_pole = document.getElementById('urlform');
                var nazev_pole = document.getElementById('nadpisform');
                var text_pole = document.getElementById('popisekform');
                var datum_pole = document.getElementById('datumform');
                id_pole.value = '$id';
                datum_pole.value = '$date';
                nazev_pole.value = '$name';
                text_pole.value = '$text'
                url_pole.value = '$url'
            })
        </script>";
      }
      echo "</div>
      </div>";

    }
    disconenect_to_database($conn)
      ?>
  </div>
  <div class="ciselnik">
    <?php
    $stranky = ceil($counter_all_condition / $pocet_na_stranku);
    // echo"$stranky $counter_all_condition";
    $urlarray = $_GET;
    for ($i = 1; $i <= $stranky; $i++) {
      if ($stranky == 1){
        break;
      }
      $urlarray["stranka"] = $i;
      $url = http_build_query($urlarray);
      $url = "napsali_o_nas.php?" . $url;

      if ($stranka == $i) {
        echo "<a href='$url'>
        <div class='stranka aktualni'>$i</div>
        </a>";
      } else {
        echo "<a href='$url'>
      <div class='stranka'>$i</div>
      </a>";
      }
    }
    // print_r($_GET);
    ?>
  </div>
</body>

>>>>>>> 7414d3c5cb25979073ea471cd9ccf7779ad002b1
</html>