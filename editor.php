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
            <?php
            $prepinace = [
                ['id' => 'nosoba', 'text' => 'Nová osoba'],
                ['id' => 'edit', 'text' => 'Editace osoby'],
                ['id' => 'ndum', 'text' => 'Nový dům'],
                ['id' => 'nclanek', 'text' => 'Nový článek'],
                ['id' => 'eclanek', 'text' => 'Editovat článek'],
                ['id' => 'npodporovatel', 'text' => 'Nový podporovatel'],
                ['id' => 'epodporovatel', 'text' => 'Upravit podporovatele'],
                ['id' => 'nspravce', 'text' => 'Nový správce'],
                ['id' => 'espravce', 'text' => 'Editovat správce']
            ];

            foreach ($prepinace as $prepinac) {
                if ($prepinac['id'] == "eclanek") {
                    echo '<a href="napsali_o_nas.php" class="prepinac">Upravit članek</a>';
                    continue;
                }
                echo '<div id="' . $prepinac['id'] . '" class="prepinac">' . $prepinac['text'] . '</div>';
            }
            echo '<script type="text/javascript">';
            foreach ($prepinace as $prepinac) {
                if (($prepinac['id'] == "eclanek")) {
                    continue;
                }
                echo 'var ' . $prepinac['id'] . '= document.getElementById("' . $prepinac['id'] . '");' . $prepinac['id'] . '.addEventListener("click", prepnout);';
            }
            echo '</script>';

            ?>
        </div>

        <div id="eosoba_form" class="divform">
            <div class="nadpis">Človek k editaci</div>
            <form class="form" id="eosoba">
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

        <div id="nosoba_form" class="divform">
            <div class="nadpis">Človek (nový / editace)</div>

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

        <div id="ndum_form" class="divform">
            <div class="nadpis">Nový dům - poloha kamenů</div>

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
        <?php
        include("novyclanek.php");
        ?>
        <div id="espravce_form" class="divform">
            <div class="nadpis">Správce k editaci</div>

            <form class="form" id="espravcef">
                <label for="lide">Lidé</label>
                <select name="lide" id="spravcove" required>
                    <option value="">Vyber člověka</option>
                    <?php
                    $spravci = get_all_spravce($conn);
                    foreach ($spravci as $clovek) {
                        $id = $clovek["id"];
                        $jmeno = $clovek["jmeno"];
                        $text = "<option value=\"$id\">$jmeno</option>";
                        echo $text;
                    }
                    ?>
                </select>
                <div>
                    <input type="submit" value="Načíst">
                </div>
            </form>
            <script type="text/javascript">
                var form = document.getElementById("espravcef");
                form.addEventListener("submit", editspravce);
            </script>
        </div>
        <div id="nspravce_form" class="divform">
            <div class="nadpis">Informace o spravci</div>

            <form action="_new_spravce.php" method="POST" class="form" id="nspravce_f">
                <div id="id_spravce" style="display: none;">
                </div>
                <div>
                    <label for="jmenos">Jméno</label>
                    <input type="text" id="jmenos" name="jmeno">
                </div>
                <div>
                    <label for="emails">Email</label>
                    <input type="text" id="emails" name="email">
                </div>
                <div>
                    <label for="visibles">Viditelný</label>
                    <input type="checkbox" id="visibles" name="viditelny" checked>
                </div>
                <div id="spravovane_domy">
                    Vyber spravované domy
                    <div>
                        <select name='dum_id[]'>
                            <option value=''>Vyber adresu</option>
                            <?php
                            foreach ($domy as $dum) {
                                $id = $dum["id"];
                                $ulice = $dum["ulice"];
                                $cislo_domu = $dum["cislo_domu"];
                                $mesto = $dum["mesto"];
                                $text = "<option value='$id'>$ulice $cislo_domu, $mesto</option>";
                                echo $text;
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div>
                    <input type="button" value="Přidat dům" id="pridat_dum">
                </div>
                <div id="spravovani_lide">
                    Přidat spravovaného člověka pokud není součástí vybraných domů
                    <div>
                        <select name='clovek_id[]' class="clovek_s_id">
                            <option value='NULL'>Vyber člověka:</option>;
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

                </div>
                <div>
                    <input type="button" value="Přidat člověka" id="pridat_cloveka">
                </div>
                <div>
                    <input type="submit" value="Odeslat">
                </div>
            </form>

        </div>
        <div id="edonator_form" class="divform">
            <div class="nadpis">Donátor k editaci</div>
            <form class="form" id="edonatorf" class="form">
                <label for="lide">Lidé</label>
                <select name="lide" id="donatori" required>
                    <option value="">Vyber člověka</option>
                    <?php
                    $donatori = get_all_donators($conn);
                    foreach ($donatori as $clovek) {
                        $id = $clovek["id"];
                        $jmeno = $clovek["jmeno"];
                        $text = "<option value=\"$id\">$jmeno</option>";
                        echo $text;
                    }
                    ?>
                </select>
                <div>
                    <input type="submit" value="Načíst">
                </div>
            </form>
            <script type="text/javascript">
                var form = document.getElementById("edonatorf");
                form.addEventListener("submit", editdonator);
            </script>
        </div>
        <div id="ndonator_form" class="divform">
            <div class="nadpis">informace k donatoru</div>
            <form action="_new_donator.php" method="POST" class="form" id="ndonator_f">
                <div id="id_donator" style="display: none;">
                </div>
                <div>
                    <label for="jmenod">Jméno</label>
                    <input type="text" id="jmenod" name="jmeno">
                </div>
                <div>
                    <label for="emaild">Email</label>
                    <input type="text" id="emaild" name="email">
                </div>
                <div class="prispel">
                    <label for="castkad">Přispěl</label>
                    <input type="number" id="castkad" name="castka" placeholder="zadaná částka se přičte k původní">
                    <div id="prispel"></div>
                </div>
                <div>
                    <input type="checkbox" id="visibled" name="viditelny" checked>
                    <label for="visibled"> Viditelný</label>
                </div>
                <div class="prispel" style="display:none;">
                    <label for="stara_castka">Přispěl</label>
                    <input type="number" id="stara_castka" name="stara_castka" placeholder="zadaná částka se přičte k původní" value="0">
                    <div id="prispel"></div>
                </div>
                <div>
                    <input type="submit" value="Odeslat">
                </div>
            </form>
            <div>
                Načíst z darujme.cz 
                <form action="_darujme_cz.php">
                <div>
                    <input type="submit" value="Načíst">
                </div>
                </form>
            </div>
        </div>
    </div>

</body>
<script type="text/javascript">
    var divform = document.getElementsByClassName("divform");
    divform = Array.from(divform).map(element => element.id);
    hideall(divform);
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
    var dum_buton = document.getElementById("pridat_dum");
    dum_buton.addEventListener("click", function (event) {
        event.preventDefault();
        dalsi_dum();
    });
    var clovek_buton = document.getElementById("pridat_cloveka");
    clovek_buton.addEventListener("click", function (event) {
        event.preventDefault();
        dalsi_clovek();
    });
    function nove_dite() {
        var nazevd = document.createElement('div');
        var dite = document.createElement('div');
        nazevd.innerHTML += "<label>Dítě:</label><input type='text' class = 'dite_name' name='deti[]'>";
        dite.innerHTML = <?php
        echo "\"<label>Dítě z databáze</label><select name='deti_id[]' class='dite_op'> <option value='NULL' >Vyber člověka</option>.";
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
    function nove_odkaz() {
        var nazevu = document.createElement('div');
        var odkaz = document.createElement('div');
        var div = document.getElementById("okaz_div");
        nazevu.innerHTML += "<label>Název odkazu:</label><input type='text' name='odkazy[]' class='nazev'>";
        odkaz.innerHTML += "<label>Odkaz:<input type='url' name='url[]' class='url' placeholder='https://example.com'>";
        div.appendChild(nazevu);
        div.appendChild(odkaz);
    }
    function dalsi_dum() {
        var dum = document.createElement('div');
        dum.innerHTML = <?php
        echo "\"<select name='dum_id[]'><option value=''>Vyber adresu</option>";
        foreach ($domy as $dum) {
            $id = $dum["id"];
            $ulice = $dum["ulice"];
            $cislo_domu = $dum["cislo_domu"];
            $mesto = $dum["mesto"];
            $text = "<option value='$id'>$ulice $cislo_domu, $mesto</option>";
            echo $text;
        }
        echo "</select>\"";
        ?>
        // nove_dite(text);
        var div = document.getElementById("spravovane_domy");
        div.appendChild(dum);
    }
    function dalsi_clovek() {
        var clovek = document.createElement('div');
        clovek.innerHTML = <?php
        echo "\"<select name='clovek_id[]' class='clovek_s_id'><option value='NULL'>Vyber člověka:</option>";
        foreach ($lide as $clovek) {
            $id = $clovek["id"];
            $jmeno = $clovek["jmeno"];
            $prijmeni = $clovek["prijmeni"];
            $datum_narozeni = $clovek["datum_narozeni"];
            $text = "<option value='$id'>$jmeno $prijmeni, $datum_narozeni</option>";
            echo $text;
        }
        echo " </select>\"";
        ?>
        // nove_dite(text);
        var div = document.getElementById("spravovani_lide");
        div.appendChild(clovek);
    }
</script>

</html>