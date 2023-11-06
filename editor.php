<?php
if (!isset($_COOKIE['prihlaseni'])) {
    header("Location: prihlaseni.php");
}
require('_function_database.php');

$conn = conenect_to_database_kameny();
if (isset($_GET["response"])) {
    $response = $_GET["response"];
    echo ('
    <script>alert("' . $response . '");</script>');
}
?>

<!DOCTYPE html>
<html lang="cz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="images/icona.jpg">

    <link rel="stylesheet" href="css/lista.css">
    <link rel="stylesheet" href="css/editor.css">

    <script type="text/javascript" src="https://api.mapy.cz/loader.js"></script>
    <script type="text/javascript">Loader.load()</script>

    <script src="js/mapa.js"></script>
    <script src="js/tabulka.js"></script>
    <script src="js/editor.js"></script>
    <title>editor</title>
</head>

<body>
    <?php include('lista.php'); ?>
    <div class="obsah">
        <div class="prepinace">
            <div id="nosoba" class="prepinac">nová osoba</div>
            <div id="edit" class="prepinac">editace osoby</div>
            <div id="ndum" class="prepinac">nový dům</div>
            <script type="text/javascript">
                var nosoba = document.getElementById("nosoba");
                var edit = document.getElementById("edit");
                var ndum = document.getElementById("ndum");
                nosoba.addEventListener("click", prepnout);
                edit.addEventListener("click", prepnout);
                ndum.addEventListener("click", prepnout);
            </script>
        </div>

        <div id="eosoba_form">
            <form class="form" id="eosoba">
                <div></div>
                <label for="lide">Lidé</label>
                <select name="lide" id="lide" required>
                    <option value="">Vyber člověka</option>
                    <?php
                    $lide = get_all_persone($conn);
                    foreach ($lide as $clovek) {
                        $id = $clovek["id"];
                        $jmeno = $clovek["jmeno"];
                        $prijmeni = $clovek["prijmeni"];
                        $datum_narozeni = $clovek["datum_narozeni"];
                        $text = "<option value=\"$id\">$jmeno $prijmeni, $datum_narozeni</option>";
                        echo $text;
                    }
                    ?>
                </select>
                <div>
                    <input type="submit" value="Načíst" >
                </div>
            </form>
            <script type="text/javascript">
                var form = document.getElementById("eosoba");
                form.addEventListener("submit", editclovek);
            </script>
        </div>

        <div id="nosoba_form">
            <form action="_new_persone.php" method="post" class="form" id="nosoba_f" enctype="multipart/form-data">
                <div id="id_form" style="display: none;">
                </div>
                <div>
                    <label for="jmeno">Jméno:</label>
                    <input type="text" id="jmeno" name="jmeno">
                </div>
                <div>
                    <label for="prijmeni">Příjmení:</label>
                    <input type="text" id="prijmeni" name="prijmeni">
                </div>
                <div>
                    <label for="datum_narozeni">Datum narození:</label>
                    <input type="date" id="datum_narozeni" name="datum_narozeni">
                </div>
                <div>
                    <label for="misto_narozeni">Místo narození:</label>
                    <input type="text" id="misto_narozeni" name="misto_narozeni">
                </div>
                <div>
                    <label for="rodinny_stav">Rodinný stav:</label>
                    <input type="text" id="rodinny_stav" name="rodinny_stav">
                </div>
                <div>
                    <label for="nabozenske_vyznani">Náboženské vyznání:</label>
                    <input type="text" id="nabozenske_vyznani" name="nabozenske_vyznani">
                </div>
                <div>
                    <label for="statni_prislusnost">Státní příslušnost:</label>
                    <input type="text" id="statni_prislusnost" name="statni_prislusnost">
                </div>
                <div>
                    <label for="okres">Nové bydliště - Okres:</label>
                    <input type="text" id="okres" name="okres">
                </div>
                <div>
                    <label for="dum_id">Domy</label>
                    <select name="domy" id="dum_id">
                        <option value="">Vyber adresu</option>
                        <?php
                        $domy = get_all_house($conn);
                        // echo $domy;
                        $domy = json_decode($domy, true);
                        foreach ($domy as $dum) {
                            $id = $dum["id"];
                            $ulice = $dum["ulice"];
                            $cislo_domu = $dum["cislo_domu"];
                            $mesto = $dum["mesto"];
                            $text = "<option value=\"$id\">$ulice $cislo_domu, $mesto</option>";
                            echo $text;
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="den_prichodu">Den příchodu:</label>
                    <input type="text" id="den_prichodu" name="den_prichodu">
                </div>
                <div>
                    <label for="otec">Otec:</label>
                    <input type="text" id="otec" name="otec">
                </div>
                <div>
                    <label for="otec_id">Otec z databáze</label>
                    <select name="otec_id" id="otec_id">
                        <option value="NULL">Vyber člověka</option>
                        <?php
                        foreach ($lide as $clovek) {
                            $id = $clovek["id"];
                            $jmeno = $clovek["jmeno"];
                            $prijmeni = $clovek["prijmeni"];
                            $datum_narozeni = $clovek["datum_narozeni"];
                            $text = "<option value=\"$id\">$jmeno $prijmeni, $datum_narozeni</option>";
                            echo $text;
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="matka">Matka:</label>
                    <input type="text" id="matka" name="matka">
                </div>
                <div>
                    <label for="matka_id">Matka z databáze</label>
                    <select name="matka_id" id="matka_id">
                        <option value="NULL">Vyber člověka</option>
                        <?php
                        foreach ($lide as $clovek) {
                            $id = $clovek["id"];
                            $jmeno = $clovek["jmeno"];
                            $prijmeni = $clovek["prijmeni"];
                            $datum_narozeni = $clovek["datum_narozeni"];
                            $text = "<option value=\"$id\">$jmeno $prijmeni, $datum_narozeni</option>";
                            echo $text;
                        }
                        disconenect_to_database($conn);
                        ?>
                    </select>
                </div>
                <div>
                    <label for="majitel_mot_vozidla">Majitel motorového vozidla:</label>
                    <select name="majitel_mot_vozidla" id="majitel_mot_vozidla">
                        <option value="0">Ne</option>
                        <option value="1">Ano</option>
                    </select>
                </div>
                <!-- <div>
                <label for="cinny_v_protiletadlove_obrane">Činný v protiletadlové obraně:</label>
                <select name="cinny_v_protiletadlove_obrane" id="cinny_v_protiletadlove_obrane">
                    <option value="0">Ne</option>
                    <option value="1">Ano</option>
                </select>
            </div> -->
                <div>
                    <label for="datum_presidleni">Datum přesídlení:</label>
                    <input type="text" id="datum_presidleni" name="datum_presidleni">
                </div>
                <div>
                    <label for="presidlil">Přesídlil (kam):</label>
                    <input type="text" id="presidlil" name="presidlil">
                </div>
                <div>
                    <label for="datum_odhaseni">Odhlášen dne:</label>
                    <input type="date" id="datum_odhaseni" name="datum_odhaseni">
                </div>
                <div>
                    <label for="karta">Karta:</label>
                    <input type="file" id="karta" name="karta[]" multiple="multiple" >
                </div>
                <div id = "delete_image">

                </div>
                <div>
                    <label for="informace">Informace:</label>
                    <textarea id="informace" name="informace"></textarea>
                </div>
                <div>
                    <input type="submit" value="Odeslat">
                </div>
            </form>
        </div>

        <div id="ndum_form">
            <form class="form" id="nform">
                <div>
                    <label for="adresa">Nový dům </label>
                    <input type="text" id="adresa" required>
                </div>
                <div>
                    <input type="submit" value="Hledat">
                </div>
            </form>
            <script type="text/javascript">
                var form = JAK.gel("nform");
                JAK.Events.addListener(form, "submit", geokoduj);
            </script>

            <form action="_new_house.php" method="post" class="form">

                <div>
                    <label for="nulice">ulice:</label>
                    <input type="text" id="nulice" name="nulice" value="" readonly required>
                </div>
                <div>
                    <label for="ncislo_domu">čislo domu:</label>
                    <input type="text" id="ncislo_domu" name="ncislo_domu" value="" readonly required>
                </div>
                <div>
                    <label for="nmesto">Město:</label>
                    <input type="text" id="nmesto" name="nmesto" value="" readonly required>
                </div>
                <div>
                    <label for="gps_x">gps x</label>
                    <input type="text" id="gps_x" name="gps_x" value="" readonly>
                </div>
                <div>
                    <label for="gps_y">gps y</label>
                    <input type="text" id="gps_y" name="gps_y" value="" readonly>
                </div>
                <div>
                    <input type="submit" value="Odeslat">
                </div>
            </form>
        </div>

    </div>
</body>
<script type="text/javascript">
    hideall();
    console.log("hide")
</script>

</html>

