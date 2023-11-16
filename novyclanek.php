<div class="form" id="novy_clanek_form">
  <form action="_novy_clanek.php" method="post" id="novy_clanek">
    <div>
      <label for="nadpisform">Nadpis: </label>
      <input type="text" name="nazev" id="nadpisform" require>
    </div>
    <div>
      <label for="urlform">Url adres: </label>
      <input type="text" name="url" id="urlform" require>
    </div>
    <div>
      <label for="popisekform">Popisek: </label>
      <input type="text" name="popisek" id="popisekform">
    </div>
    <div>
      <label for="datumform">Datum: </label>
      <input type="date" name="datum" id="datumform">
      <div class="napoveda">Pokud zůstane nevyplněné, nastaví se dnešní</div>
    </div>
    <div style="display:none">
      <input type="text" name="puvod" id="puvod" value="<?php $currentPage = basename($_SERVER['PHP_SELF']);
      echo $currentPage ?>">
    </div>
    <div style='display:none'>
      <input type='text' name='id' id='idform'>
    </div>
    <div>
      <input class="filtrovat" type="submit" value="Vložit">
      <input class="filtrovat" type="button" value="Vymazat" id="vymaz">
      <script>
        document.getElementById("vymaz").addEventListener("click", function clik_on_button(event) {
          var form = document.getElementById('novy_clanek')
          form.reset();
        })
      </script>
    </div>
    
  </form>
</div>