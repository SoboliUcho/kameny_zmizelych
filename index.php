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
  <link rel="stylesheet" href="css/lista.css">
  <link rel="stylesheet" href="css/tabulka.css">
  <link rel="stylesheet" href="css/loader.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.css">
  <link rel="stylesheet" href="css/mapacz.css">


  <!-- <script src="js/logintable.js"></script> -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.js"></script>

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
    <div id="mapa">
    </div>
    <div id="tlacitka_pozice">
      <?php
      require "log_tokens.php";
      foreach ($pozice as $mesto) {
        $nazev = $mesto["nazev"];
        $gps_x = $mesto["gps_x"];
        $gps_y = $mesto["gps_y"];
        $zoom = $mesto["zoom"];

        echo ("
            <div class='pozice' id='$nazev'>$nazev</div>
            <script>var pozice = document.getElementById('$nazev')
    pozice.addEventListener('click', function(){
        mapa.setView([$gps_y, $gps_x], $zoom, { animate: true })
    })</script>
            ");
      }
      ?>


    </div>
    <div id="control">
      <div class="zoom">
        <div class="buttons">
          <div class="button" id="minus_button">-</div>
          <div class="button" id="white_line"></div>
          <div class="button" id="plus_button">+</div>
        </div>
        <div class="priblizeni">
          <div class="zoom_level" value=2>Svět</div>
          <div class="zoom_level" value=5>Stát</div>
          <div class="zoom_level" value=8>Kraj</div>
          <div class="zoom_level" value=11>Město</div>
          <div class="zoom_level" value=14>Obec</div>
          <div class="zoom_level" value=18>Ulice</div>
        </div>
      </div>
      <div class="compass" id="compass">
      </div>
    </div>
    <script type="text/javascript">
      var x = 16.6597287;
      var y = 49.4868687;
      var zoom = 18;
      set_height();
      var mapa = make_map(x, y, zoom)
      var domy = <?php echo get_all_house($conn);
      disconenect_to_database($conn); ?>;
      make_markers(domy, mapa);

      var minus_button = document.getElementById("minus_button");
      var plus_button = document.getElementById("plus_button");
      var zoom_level = document.getElementsByClassName("zoom_level");
      minus_button.addEventListener("click", function () {
        mapa.zoomOut();
      })
      plus_button.addEventListener("click", function () {
        mapa.zoomIn();
      })
      for (var i = 0; i < zoom_level.length; i++) {
        var element = zoom_level[i];
        element.addEventListener("click", function () {
          var zoom = event.target.getAttribute("value");
          zoom = parseInt(zoom);
          mapa.setZoom(zoom);
          console.log("zoom is:", zoom)
        })
      };

      var compass = document.getElementById("compass");
      let centerX = compass.offsetWidth / 2;
      let centerY = compass.offsetHeight / 2;
      compass.addEventListener('mousedown', handleTouchStart);
      document.addEventListener('mousemove', handleMouseMove);
      document.addEventListener('mouseup', handleMouseUp);
      let isMousePressed = false;
      var timeoutId;
    </script>

    <div class="tabulka hidden visuallyhidden" id="tabulka">
      <div id="lide"></div>
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