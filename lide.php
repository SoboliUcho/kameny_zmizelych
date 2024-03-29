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
if (isset($_GET['ulice'])) {
  $ulice = $_GET['ulice'];
} else {
  $ulice = "NULL";
}
if (isset($_GET['dum'])) {
  $dum = $_GET['dum'];
} else {
  $dum = "NULL";
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

  <!-- <script src="js/logintable.js"></script> -->
  
  <script src="js\tabulka.js"></script>
  <title>Lidé | Kameny zmizelých</title>
</head>

<body>
  <?php include('lista.php'); ?>
  <div class="form">
    <form action="lide.php" method="get">
      <label for="pocet">Ulice
        <select name="ulice" class="vyber" id="ulice">
          <option value="NULL" <?php if ($ulice == null) {
            echo "selected";
          } ?>> -- </option>

          <?php
          $houses = get_all_house($conn);
          $houses = json_decode($houses, true);
          $strets = array();
          foreach ($houses as $house) {
            if (!in_array($house['ulice'], $strets)) {
              $strets[] = $house["ulice"];
            }
          }
          foreach ($strets as $stret) {
            echo "<option value='$stret'";
            if ($ulice == $stret) {
              echo "selected";
            }
            echo ">$stret</option>";
          }
          ?>
        </select>
      </label>

      <label for="dum">Dům
        <select name="dum" class="vyber" id="dum">
          <option value="NULL" <?php if ($dum == null) {
            echo "selected";
          } ?>> -- </option>
          <?php
          foreach ($houses as $house) {
            $house_id = $house["id"];
            $house_name = $house["ulice"] . " " . $house["cislo_domu"];
            echo "<option value='$house_id'";
            if ($dum == $house_id) {
              echo "selected";
            }
            echo ">$house_name</option>";
          }
          ?>
        </select>
      </label>
      <label for="pocet">Počet osob na stránce
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
  <div id="nelista">

    <?php
    $people = get_all_persone_location($conn);
    $counter_all_condition = 0;
    $counter = 0;
    foreach ($people as $person) {
      $id = $person["id"];
      $name = $person["jmeno"];
      $surname = $person["prijmeni"];
      $date_of_birth = $person["datum_narozeni"];
      $timestamp = strtotime($date_of_birth);
      $date_of_birth = date("j. n. Y", $timestamp);
      $street = $person["ulice"];
      $house_number = $person["cislo_domu"];
      // echo "$street $ulice";
      if ($ulice != "NULL" && $ulice != $street) {
        if ($dum != $person["dum_id"]) {
          continue;
        }

      }
      if ($dum != "NULL" && $dum != $person["dum_id"]) {
        if ($ulice != $street) {
          continue;
        }
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

      echo "<div class='clovek' id='clovek$id'>
                <div class='center'>
            <div class='zaklad'>
              <div class='jmeno'>$name $surname</div>
              <div class='data'>
                <div class='datum'>$date_of_birth</div>
                <div class='bydliste'>$street $house_number</div>
              </div>
              <button class='vice' value='$id' id = 'button$id'>Více informací</button>
              
            </div>
            <div class='rozsireni hidden visuallyhidden'>
              <div class='data'></div>
              <div class='informace'></div>
            </div>
            <script>
            var button$id = document.getElementById('button$id')
            button$id.addEventListener('click', function clik_on_button(event) {
                var clovek = document.getElementById('clovek$id');
                var rozsireni = clovek.getElementsByClassName('rozsireni');
                if (rozsireni[0].classList.contains('hidden'))
                {tabulka_request(event.target.value, 'page')
                console.log(event.target.value)}
                else{
                  rozsireni[0].classList.add('visuallyhidden');
                  rozsireni[0].classList.add('hidden');
                }
            })
            </script>
            </div>
            </div>
            ";
    }

    disconenect_to_database($conn)
      ?>
    <div class="obrazkyshow hidden visuallyhidden" id="obrazkyshow"></div>
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
      $url = "lide.php?" . $url;

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

</html>