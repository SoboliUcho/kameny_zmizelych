<div id="del_lide" class="del_form">
    <div class="nadpis">Odstranit človeka</div>
    <form action="_odstranit.php" method="POST" class="form" id="del_people">
        <input type='text' id='type' name='type' value='lide' readonly='' style="display:none;">
        <div>
        <label for="dlide">človek</label>
        <select name="id" id="dlide" required>
            <option value="">Vyber člověka</option>
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
            <input type="submit" value="Odstranit">
        </div>
    </form>
    <script>stopform("del_people");</script>
</div>
<div id="del_domy" class="del_form">
    <div class="nadpis">Odstranit dům</div>
    <form action="_odstranit.php" method="POST" class="form" id="del_house">
        <input type='text' id='type' name='type' value='domy' readonly='' style="display:none;">
        <div>
        <label for="ddomy">Dům</label>
        <select name='id' id="ddomy">
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
        <div>
            <input type="submit" value="Odstranit">
        </div>
    </form>
    <script>stopform("del_house");</script>
</div>
<div id="del_spravce" class="del_form">
    <div class="nadpis">Odstranit správce</div>
    <form action="_odstranit.php" method="POST" class="form" id="del_manager">
        <input type='text' id='type' name='type' value='spravci' readonly='' style="display:none;">
        <div>
        <label for="dspravce">Správce</label>
        <select name="id" id="dspravce" required>
            <option value="">Vyber člověka</option>
            <?php
            foreach ($spravci as $clovek) {
                $id = $clovek["id"];
                $jmeno = $clovek["jmeno"];
                $text = "<option value=\"$id\">$jmeno</option>";
                echo $text;
            }
            ?>
        </select>
        </div>
        <div>
            <input type="submit" value="Odstranit">
        </div>
    </form>
    <script>stopform("del_manager");</script>
</div>
<div id="del_donator" class="del_form">
    <div class="nadpis">Odstranit donatora</div>
    Donátory načtené přes darujme.cz nelze trvale odstranit (vrátí se). Místo odstranění jej skryjte.
    <form action="_odstranit.php" method="POST" class="form" id="del_manager">
        <input type='text' id='type' name='type' value='donatori' readonly='' style="display:none;">
        <div>
        <label for="ddonator">Donátor</label>
        <select name="id" id="ddonator" required>
            <option value="">Vyber člověka</option>
            <?php
            foreach ($spravci as $clovek) {
                $id = $clovek["id"];
                $jmeno = $clovek["jmeno"];
                $text = "<option value=\"$id\">$jmeno</option>";
                echo $text;
            }
            ?>
        </select>
        </div>
        <div>
            <input type="submit" value="Odstranit">
        </div>
    </form>
    <script>stopform("del_manager");</script>
</div>