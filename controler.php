<?php 
// require_once "_function_database.php";
// $conn = conenect_to_database_kameny();
?>

<div id="bezdomova" class="category">
    <div class="nadpis">Lidé bez domova</div>
    <?php
    $domy_form = "<select name='dum_id' id='dum_id'><option value=''>Vyber adresu</option>";
    foreach ($domy as $dum) {
        $id = $dum["id"];
        $ulice = $dum["ulice"];
        $stare = $dum["stare_cislo"];
        $cislo_domu = $dum["cislo_domu"];
        $mesto = $dum["mesto"];
        $text = "<option value=\"$id\">$stare - Nová adresa: $ulice $cislo_domu</option>";
        $domy_form .= $text;
    }
    $domy_form .= "</select>";

    $homeles = get_all_homeles($conn);
    foreach ($homeles as $clovek) {
        $id = $clovek["id"];
        $jmeno = $clovek["jmeno"];
        $prijmeni = $clovek["prijmeni"];
        $datum_narozeni = $clovek["datum_narozeni"];
        $text = "$jmeno $prijmeni, $datum_narozeni";
        echo "<div class='polozka'>$text</div>
        <form action='_update_persone.php' method='post'>
            <div id='id_form' style='display: none;'>
                <label for='id'>ID:</label>
                <input type='text' id='id' name='id' value='$id' readonly=''>
            </div>
            <div>
                $domy_form
            </div>
            <div>
                <input type='submit' value='Opravit'>
            </div>
        </form>";
    }
    if ($homeles->num_rows > 0){
        $visibele = "";
    }
    else{
        $visibele = "none";
    }
    ?>
    <script>
        var bezdomova =document.getElementById("bezdomova")
        bezdomova.style.display = "<?php echo $visibele ?>"
    </script>
</div>

<div id="nv_domy" class="category">
    <div class="nadpis">Domy s lidmi, které nejsou vidět</div>
    <?php
    $invisible_house = invisible_house_with_people($conn);
    foreach ($invisible_house as $house) {
        $id = $house["id"];
        $ulice = $house["ulice"];
        $cislo_domu = $house["cislo_domu"];
        $mesto = $house["mesto"];
        $stare_cislo = $house["stare_cislo"];
        $adresa = "Stare číslo: $stare_cislo - Nová adresa: $ulice $cislo_domu $mesto";
        echo "    <form action='_edit_house.php' method='post'>
            <div>
            <label for='id'>$adresa</label>
            <input type='text' name='id' value='$id' readonly='' style='display: none;'>
            <input type='text' name='visible' value='1' readonly='' style='display: none;'>
            </div>
            <div>
                <input type='submit' value='Zviditelnit'>
            </div>
        </form>";

    }
    if ($invisible_house->num_rows > 0){
        $visibele = "";
    }
    else{
        $visibele = "none";
    }
    ?>
    <script>
        var nv_domy =document.getElementById("nv_domy");
        nv_domy.style.display = "<?php echo $visibele ?>";
    </script>
</div>
<div id="nv_lide" class="category">
    <div class="nadpis">Lidé v neviditelné adrese</div>
    <?php
    $invisible = people_invisible_house($conn);
    foreach ($invisible as $clovek) {
        print($clovek);
        $ulice = $house["ulice"];
        $cislo_domu = $house["cislo_domu"];
        $mesto = $house["mesto"];
        $stare_cislo = $house["stare_cislo"];
        $adresa = "$stare_cislo - Nová adresa: $ulice $cislo_domu $mesto";
        $id = $clovek["id"];
        $jmeno = $clovek["jmeno"];
        $prijmeni = $clovek["prijmeni"];
        $datum_narozeni = $clovek["datum_narozeni"];
        $text = "$jmeno $prijmeni, $datum_narozeni";
        $text .= " - bydlící na čísle" . $adresa;
        echo ("<div class='nev_clovek'>$text</div>");
    }
    if ($invisible->num_rows > 0){
        $visibele = "";
    }
    else{
        $visibele = "none";
    }
    ?>
    <script>
        var nv_lide = document.getElementById("nv_lide");
        nv_lide.style.display = "<?php echo $visibele ?>";
    </script>
</div>
<div class="category" id="v_domy">
    <div class="nadpis">Vyditelné prázdné domy</div>
    <?php 
    $free_house = free_house($conn);
    foreach ($free_house as $house) {
        $id = $house["id"];
        $ulice = $house["ulice"];
        $cislo_domu = $house["cislo_domu"];
        $mesto = $house["mesto"];
        $stare_cislo = $house["stare_cislo"];
        $adresa = "Stare číslo: $stare_cislo - Nová adresa: $ulice $cislo_domu $mesto";
        echo "    <form action='_edit_house.php' method='post'>
            <div>
            <label for='id'>$adresa</label>
            <input type='text' name='id' value='$id' readonly='' style='display: none;'>
            <input type='text' name='visible' value='0' readonly='' style='display: none;'>
            </div>
            <div>
                <input type='submit' value='Zneviditelnit'>
            </div>
        </form>";

    }
    if ($free_house->num_rows > 0){
        $visibele = "";
    }
    else{
        $visibele = "none";
    }
    ?>
    <script>
        var v_domy =document.getElementById("v_domy")
        v_domy.style.display = "<?php echo $visibele ?>"
    </script>
</div>