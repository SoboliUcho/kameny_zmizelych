<?php
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
  <div id="nelista">

    <?php
    $people = get_all_persone_location($conn);
    foreach ($people as $person) {
      $id = $person["id"];
      $name = $person["jmeno"];
      $surname = $person["prijmeni"];
      $date_of_birth = $person["datum_narozeni"];
      $timestamp = strtotime($date_of_birth);
      $date_of_birth = date("j. n. Y", $timestamp);
      $street = $person["ulice"];
      $house_number = $person["cislo_domu"];

      echo "<div class='clovek' id='$id'>
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
                tabulka_request(event.target.value, 'page')
                console.log(event.target.value)
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
</body>

</html>