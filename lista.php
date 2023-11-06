<div class="lista">
  <a href="https://www.muzeum-boskovicka.cz/" id="logo"> <img src="images/muzeum_boskovice_logo.svg"
      alt="Muzeum boskovicka" id="logo_velke">
    <img src="images/muzeum_boskovice_logo_male.svg" alt="Muzeum boskovicka" id="logo_male">
  </a>

  <h1 id="nazev"> KAMENY ZMIZELÝCH </h1>
  <div class="infobox" id="infobox">
    <svg class="ham" width="100%" height="100%" viewBox="0 0 100 100" version="1.1" id="svg5"
      xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
      <defs id="defs2" />
      <rect id="rect" width="100" height="100" x="0" y="0" />
      <path d="M 10.429166,25.79623 89.570832,25.429199" id="line1" class="menuline" />
      <path d="m 10.429199,50.796199 79.141667,-0.367" id="line2" class="menuline" />
      <path d="M 10.429166,75.796194 89.570833,75.429199" id="line3" class="menuline" />

    </svg>

  </div>
</div>
<div class="pomoc">
  <div class="sublista" id="sublista">

    <?php
    $currentPage = basename($_SERVER['PHP_SELF']);
    if ($currentPage == 'index.php') {
      echo ' <a href="index.php" class="info aktive">
        <div class="infotext">MAPA</div>
        
        </a>';
    } else {
      echo ' <a href="index.php" class="info">
      <div class="infotext">MAPA</div>
      
      </a>';
    }
    if ($currentPage == 'lide.php') {
      echo '<a href="lide.php" class="info aktive">
        <div class="infotext">Lidé</div>
        
        </a>';
    } else {
      echo '<a href="lide.php" class="info">
        <div class="infotext">Lidé</div>
        
        </a>';
    }
    if ($currentPage == 'report.php') {
      echo '<a href="report.php" class="info aktive">
        <div class="infotext">Report</div>
        
        </a>';
    } else {
      echo '<a href="report.php" class="info">
        <div class="infotext">Report</div>
        
        </a>';
    }
    if ($currentPage == 'o_projektu.php') {
      echo '<a href="o_projektu.php" class="info aktive">
        <div class="infotext">O projektu</div>
        
        </a>';
    } else {
      echo '<a href="o_projektu.php" class="info">
        <div class="infotext">O projektu</div>
        
        </a>';
    }
    if (isset($_COOKIE['prihlaseni'])) {
      if ($currentPage == 'editor.php') {
        echo '<a href="editor.php" class="info aktive">
        <div class="infotext">editor</div>
        
        </a>';
      } else {
        echo '<a href="editor.php" class="info">
        <div class="infotext">editor</div>
        
        </a>';
      }
    }
    ?>


  </div>
</div>

<script>
  var menu = document.getElementById("infobox")
  var submenu = document.getElementById("sublista")
  menu.addEventListener("click", function (event) {
    event.stopPropagation()
    console.log("clik");
    menu.classList.toggle("iks");
    submenu.classList.toggle('iks');
    document.addEventListener('click', function handleClickOutsideBox(event) {
      if (!submenu.contains(event.target)) {
        menu.classList.toggle("iks");
        submenu.classList.toggle('iks');
        document.removeEventListener('click', handleClickOutsideBox);
      }
    })
  });

</script>
<img id="progres" src="images\in_progres.png" alt="">