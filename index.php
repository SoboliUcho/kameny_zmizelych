<?php
require('_function_database.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="icon" href="https://www.muzeum-boskovicka.cz/sites/default/files/favicons/favicon-16x16.png"> -->
  <link rel="icon" href="icona.jpg">

  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/mapacz.css">

  <script src="js/logintable.js"></script>
  <script type="text/javascript" src="https://api.mapy.cz/loader.js"></script>
  <script type="text/javascript">Loader.load()</script>
  <script src="js\mapa.js"></script>

  <title>Kameny zmizelých</title>

  <!-- <meta http-equiv="refresh" content="15"> -->
</head>

<body>
  <div class="lista">
    <a href="https://www.muzeum-boskovicka.cz/"><img
        src="https://www.muzeum-boskovicka.cz/themes/custom/b5subtheme/logo.svg" alt="Muzeum boskovicka"></a>
    <h1 id="nazev">KAMENY ZMIZELÝCH</h1>
    <div class="infobox">
      <a href="o_projektu.html" class="info">
        <div class="info">O projektu</div>
      </a>
      <!-- <a href="" class="info"><div class="info">Autoři?</div></a> -->
    </div>
  </div>

  <div id="mapa"></div>
  <script type="text/javascript">
    var x = 16.6597287;
    var y = 49.4868687;
    var zoom = 18;
    var mapa = make_map(x,y,zoom)
    mapa_botom_space(20, mapa)
  </script>
<?php
get_all_house();
?>
  <div class="tabulka" style="display: none;" id="tabulka">
    <script>
      vypis_hodnot(dum = iddomu) 
    </script>
  </div>

</body>

</html>