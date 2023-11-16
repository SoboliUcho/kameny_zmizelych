<?php
require('_function_database.php');
// header('Content-Type: text/html; charset=utf-8');
if (isset($_GET['datum']) && !empty($_GET['datum'])) {
    $datum = $_GET['datum'];
    $datum = strtotime($datum);
} else {
    $datum = "NULL";
}
echo $datum;
echo "<br>"

    ?>
<form action="" method="get">
    <label for="datum">Datum
        <input type="date" name="datum">
    </label>
    </label>
    <input class="filtrovat" type="submit" value="Filtrovat">
</form>
<button class='edit' value='$id' id='button$id'>Opravit</button>
<script>
    var tlacitko = document.getElementById('button$id');
    tlacitko.addEventListener('click', function clik_on_button(event) {
        var form = document.getElementById('novy_clanek')
        // var id_pole = form.getElementById("id");
        var url_pole = form.getElementById("url");
        var nazev_pole = form.getElementById("nazev");
        var text_pole = form.getElementById("text");
        var datum_pole = form.getElementById("datum");
        if (id_pole == null) {
            form.innerHTML += "<div style='display:none'><input type='text' name='id' id='id' value='$id'></div>";
            id_pole = form.getElementById('idpole');
        }
        id_pole.value = '$id';
        datum_pole.value = '$date_visible';
        nazev_pole.value = '$name';
        text_pole.value = '$text'
        url_pole.value = '$url'
    })
</script>