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

  <link rel="icon" href="https://www.muzeum-boskovicka.cz/sites/default/files/favicons/favicon-16x16.png">
  <!-- <link rel="icon" href="images/icona.jpg"> -->

  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/mapacz.css">
  <link rel="stylesheet" href="css/lista.css">
  <link rel="stylesheet" href="css/tabulka.css">
  <link rel="stylesheet" href="css/loader.css">

  <!-- <script src="js/logintable.js"></script> -->
  <script type="text/javascript" src="https://api.mapy.cz/loader.js"></script>
  <script type="text/javascript">Loader.load()</script>
  <script src="js\mapa.js"></script>
  <script src="js\tabulka.js"></script>

  <title>Kameny zmizelých</title>
  <!--  -->
  <!--  -->
  <!-- <meta http-equiv="refresh" content="10"> -->
  <!--  -->
  <!--  -->
</head>

<body>
  <?php include('lista.php'); ?>
  <div id="nelista">
    <div id="mapa"></div>
    <script type="text/javascript">
      var x = 16.6597287;
      var y = 49.4868687;
      var zoom = 18;
      var mapa = make_map(x, y, zoom)
      mapa_botom_space(1, mapa)
      var domy = <?php echo get_all_house($conn);
      disconenect_to_database($conn); ?>;
      make_markers(domy, mapa);
      mapa.getSignals().addListener(this, "marker-click", function (e) { tabulka_request(e.target.getId(), "people") })
      // tabulka_request("1","lide")
    </script>

    <div class="tabulka hidden visuallyhidden" id="tabulka">
      <div id="lide" ></div>
      <div id="data">
        <!-- <div class="radek_tabulky">
        <div class="popisek">Jméno</div>
        <div class="data" id="jmeno"></div>
      </div> -->
      </div>
      <div id="informace"></div>
      <div id="ix"></div>

    </div>
    <div class="obrazkyshow hidden visuallyhidden" id="obrazkyshow"></div>
  </div>

</body>

</html>