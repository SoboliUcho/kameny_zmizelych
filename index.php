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
  <link rel="icon" href="icona.jpg">

  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/mapacz.css">

  <!-- <script src="js/logintable.js"></script> -->
  <script type="text/javascript" src="https://api.mapy.cz/loader.js"></script>
  <script type="text/javascript">Loader.load()</script>
  <script src="js\mapa.js"></script>
  <script src="js\tabulka.js"></script>

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
    var mapa = make_map(x, y, zoom)
    mapa_botom_space(20, mapa)
    var domy = <?php echo get_all_house($conn); disconenect_to_database($conn);?>;
    make_markers(domy, mapa);
    mapa.getSignals().addListener(this, "marker-click", function (e) { tabulka_request(e.target.getId(),"lide") })  

  </script>

  <!-- <div class="tabulka" style="display: none;" id="tabulka"> -->
    <div id="lide"></div>
    <div id="data">
      <!-- <div class="radek_tabulky">
        <div class="popisek">Jméno</div>
        <div class="data" id="jmeno"></div>
      </div>
      <div class="radek_tabulky">
        <div class="popisek">Přijmení</div>
        <div class="data" id="prijmeni"></div>
      </div>
      <div class="radek_tabulky">
        <div class="popisek">Datum narození</div>
        <div class="data" id="datum_narozeni"></div>
      </div>
      <div class="radek_tabulky">
        <div class="popisek">Místo narození</div>
        <div class="data" id="misto_narozeni"></div>
      </div>
      <div class="radek_tabulky">
        <div class="popisek">Rodinný stav</div>
        <div class="data" id="rodinny_stav"></div>
      </div>
      <div class="radek_tabulky">
        <div class="popisek">Náboženské vyznání</div>
        <div class="data" id="nabozenske_vyznani"></div>
      </div>
      <div class="radek_tabulky">
        <div class="popisek">Státní příslušnost</div>
        <div class="data" id="statni_prislusnost"></div>
      </div>
      <div class="radek_tabulky">
        <div class="popisek">Nové bydliště</div>
        <div class="data" id="nove_bydliste"></div>
      </div>
      <div class="radek_tabulky">
        <div class="popisek">Okres</div>
        <div class="data" id="okres"></div>
      </div>
      <div class="radek_tabulky">
        <div class="popisek">Ulice</div>
        <div class="data" id="ulice"></div>
      </div>
      <div class="radek_tabulky">
        <div class="popisek">Číslo</div>
        <div class="data" id="cislo"></div>
      </div>
      <div class="radek_tabulky">
        <div class="popisek">Den příchodu</div>
        <div class="data" id="den_prichodu"></div>
      </div>
      <div class="radek_tabulky">
        <div class="popisek">Otec</div>
        <div class="data" id="otec"></div>
      </div>
      <div class="radek_tabulky">
        <div class="popisek">Matka</div>
        <div class="data" id="matka"></div>
      </div>
      <div class="radek_tabulky">
        <div class="popisek">Majitel motorového vozidla</div>
        <div class="data" id="majitel_mot_vozidla"></div>
      </div>
      <div class="radek_tabulky">
        <div class="popisek">Činný v protiletedlové obraně</div>
        <div class="data" id="cinny_v_protiletadlove_obrane"></div>
      </div>
      <div class="radek_tabulky">
        <div class="popisek">Datum přesídlení</div>
        <div class="data" id="datum_presidleni"></div>
      </div>
      <div class="radek_tabulky">
        <div class="popisek">Přesídlil (kam)</div>
        <div class="data" id="presidlil"></div>
      </div>
      <div class="radek_tabulky">
        <div class="popisek">Odhlášen dne</div>
        <div class="data" id="datum_odhaseni"></div>
      </div>
      <div class="radek_tabulky">
        <div class="popisek"></div>
        <div class="data" id="karta"></div>
      </div>
      <div class="radek_tabulky">
        <div class="popisek"></div>
        <div class="data" id="informace"></div>
      </div> -->
    </div>
  </div>

</body>

</html>