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
                    <input type="submit" value="Načíst">
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
                <?php
                $id_nick = data_nick();
                $nazvy = nicks_alter();
                // print_r ( $nazvy );
                
                for ($i = 0; $i < count($id_nick); $i++) {
                    if ($id_nick[$i] == "id" || $id_nick[$i] == "deti_id") {
                        continue;
                    }
                    $id_label = $id_nick[$i];
                    // echo $nazvy[$i];
                    $nazvy_label = $nazvy[$i];

                    if ($id_nick[$i] == "deti") {
                        echo "<div id='deti_div'><div>
                        <label>Dítě:</label>
                        <input type='text' class = 'dite_name' name='deti[]'>
                    </div>
                    <div>
                        <label >Dítě z databáze:</label>
                        <select name='deti_id[]' class='dite_op'><option value='NULL'>Vyber člověka:</option>";
                        foreach ($lide as $clovek) {
                            $id = $clovek["id"];
                            $jmeno = $clovek["jmeno"];
                            $prijmeni = $clovek["prijmeni"];
                            $datum_narozeni = $clovek["datum_narozeni"];
                            $text = "<option value=\"$id\">$jmeno $prijmeni, $datum_narozeni</option>";
                            echo $text;
                        }
                        echo " </select>
                                </div>
                                </div><div class='tlacitko'>
                                <input type='button' id='ndite' value='Další dítě'>
                            </div>";
                        continue;
                    }
                    if ($id_nick[$i] == "odkazy") {
                        echo "<div id='okaz_div'><div>
                        <label>Název odkazu:</label>
                        <input type='text' name='odkazy[]' class='nazev'>
                        </div>
                        <div>
                        <label>Odkaz:</label>
                        <input type='url' name='url[]' class='url' placeholder='https://example.com'>
                        </div>
                        </div><div class='tlacitko'>
                        <input type='button' id='nodkaz' value='Další odkaz'>
                        </div>
                        ";
                        continue;
                    }


                    echo "<div>
                    <label for='$id_label'>$nazvy_label:</label>";

                    if ($id_nick[$i] == "datum_narozeni" || $id_nick[$i] == "den_prichodu" || $id_nick[$i] == "mrtvy" || $id_nick[$i] == "realmrtvy" || $id_nick[$i] == "presidlil" || $id_nick[$i] == "datum_odhaseni") {
                        echo "<input type='date' id='$id_label' name='$id_label'> 
                        </div>";
                        continue;
                    }

                    if (strpos($id_nick[$i], "_id") !== false && $id_nick[$i] != "dum_id") {
                        echo "<select name='$id_label' id='$id_label'>
                        <option value='NULL'>Vyber člověka:</option>";
                        foreach ($lide as $clovek) {
                            $id = $clovek["id"];
                            $jmeno = $clovek["jmeno"];
                            $prijmeni = $clovek["prijmeni"];
                            $datum_narozeni = $clovek["datum_narozeni"];
                            $text = "<option value=\"$id\">$jmeno $prijmeni, $datum_narozeni</option>";
                            echo $text;
                        }
                        echo " </select>
                        </div>";
                        continue;
                    }

                    if ($id_nick[$i] == "pohlavi") {
                        echo " <select name='$id_label' id='$id_label' >
                        <option value='0'>Muž</option>
                        <option value='1'>Žena</option>
                        </select>
                        </div>";
                        continue;
                    }

                    if ($id_nick[$i] == "majitel_mot_vozidla") {
                        echo " <select name='$id_label' id='$id_label' >
                        <option value='0'>Ne</option>
                        <option value='1'>Ano</option>
                        </select>
                        </div>";
                        continue;
                    }
                    if ($id_nick[$i] == "karta") {
                        echo "<input type='file' id='karta' name='karta[]' multiple='multiple'>
                        </div>
                        <div id='delete_image'>
                        </div>";
                        continue;
                    }
                    if ($id_nick[$i] == "informace") {
                        echo "<textarea id='informace' name='informace'> </textarea>
                        </div>";
                        continue;
                    }
                    if ($id_nick[$i] == "dum_id") {
                        echo " <select name='dum_id' id='dum_id'><option value=''>Vyber adresu</option>";
                        $domy = get_all_house($conn);
                        $domy = json_decode($domy, true);
                        foreach ($domy as $dum) {
                            $id = $dum["id"];
                            $ulice = $dum["ulice"];
                            $cislo_domu = $dum["cislo_domu"];
                            $mesto = $dum["mesto"];
                            $text = "<option value=\"$id\">$ulice $cislo_domu, $mesto</option>";
                            echo $text;
                        }
                        echo "</select>
                    </div>";
                        continue;
                    }
                    echo " <input type=text' id='$id_label' name='$id_label'>
                    </div>";
                }
                ?>
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
    console.log("hide");
    var dite_buton = document.getElementById("ndite");
    dite_buton.addEventListener("click", function (event) {
        event.preventDefault();
        nove_dite();
    });
    var odkaz_buton = document.getElementById("nodkaz");
    odkaz_buton.addEventListener("click", function (event) {
        event.preventDefault();
        nove_odkaz();
    });
    function nove_dite(){
        var nazevd = document.createElement('div');
        var dite = document.createElement('div');
        nazevd.innerHTML += "<label>Dítě:</label><input type='text' class = 'dite_name' name='dite[]'>"
        dite.innerHTML = <?php
        echo "\"<label>Dítě z databáze</label><select name='dite_id[]' class='dite_op'> <option value='NULL' >Vyber člověka</option>.";
        foreach ($lide as $clovek) {
            $id = $clovek["id"];
            $jmeno = $clovek["jmeno"];
            $prijmeni = $clovek["prijmeni"];
            $datum_narozeni = $clovek["datum_narozeni"];
            $text = "<option value='$id'>$jmeno $prijmeni, $datum_narozeni</option>";
            echo $text;
        }
        echo "</select>\"";
        disconenect_to_database($conn);
        ?>
        // nove_dite(text);
        var div = document.getElementById("deti_div");
        div.appendChild(nazevd);
        div.appendChild(dite);
    }
    function nove_odkaz(){
        var nazevu = document.createElement('div');
        var odkaz = document.createElement('div');
        var div = document.getElementById("okaz_div");
        nazevu.innerHTML += "<label>Název odkazu:</label><input type='text' name='odkaz[]' class='nazev'>";
        odkaz.innerHTML += "<label>Odkaz:<input type='url' name='url[]' class='url' placeholder='https://example.com'>";
        div.appendChild(nazevu);
        div.appendChild(odkaz);
    }
</script>

</html>