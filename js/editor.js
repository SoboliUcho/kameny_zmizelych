function geokoduj(e, elm) {  /* Voláno při odeslání */
    JAK.Events.cancelDef(e); /* Zamezit odeslání formuláře */
    var query = JAK.gel("adresa").value;
    var form = document.getElementById("control_form")
    form.reset();
    new SMap.Geocoder(query, odpoved);
}

function odpoved(geocoder) { /* Odpověď */
    if (!geocoder.getResults()[0].results.length) {
        alert("Tohle místo neznáme.");
        return;
    }

    var vysledky = geocoder.getResults()[0].results;
    var data = [];
    while (vysledky.length) { /* Zobrazit všechny výsledky hledání */
        var item = vysledky.shift()
        console.log(item.label)
        var regex = /(.+?)\s(\d+\/\d+),\s(.+?),\s(.+)$/;
        var matches = item.label.match(regex);
        var lomítka = matches[2].split('/');
        console.log(item);

        var addressInfo = {
            ulice: matches[1],
            pscislo: lomítka[0],
            ocislo: lomítka[1],
            mesto: matches[3],
            stat: matches[4],
            gps_x: item.coords.x,
            gps_y: item.coords.y
        };
        console.log(addressInfo)


    }
    // var value = document.getElementById("")
    var mestoInput = document.getElementById("nmesto");
    var uliceInput = document.getElementById("nulice");
    var cisloDomuInput = document.getElementById("ncislo_domu");
    var gpsXInput = document.getElementById("gps_x");
    var gpsYInput = document.getElementById("gps_y");

    mestoInput.value = addressInfo.mesto;
    uliceInput.value = addressInfo.ulice;
    cisloDomuInput.value = addressInfo.ocislo;
    gpsXInput.value = addressInfo.gps_x;
    gpsYInput.value = addressInfo.gps_y;
}

function editclovek(event) {
    event.preventDefault();
    var formular = document.getElementById("nosoba_f")
    formular.reset();
    var image = document.getElementById("delete_image")
    image.innerHTML = ""
    var select = document.getElementById("lide");
    var selectedValue = select.value;
    console.log(selectedValue)

    var id = '<label for= "id" >ID:</label ><input type="text" id="id" name="id" value="" readonly>';

    var form = document.getElementById("id_form");
    form.innerHTML = id;

    var type = "edit";
    tabulka_request(selectedValue, "edit");
    var n_ososba = document.getElementById("nosoba_form");
    n_ososba.style.display = "";
}

function prepnout(event) {
    var tlacitka = ["nosoba", "edit", "ndum", "nclanek", "npodporovatel", "epodporovatel", "nspravce", "espravce", "o_projektu"]
    var form = ["nosoba_form", "eosoba_form", "ndum_form", "novy_clanek_form", "ndonator_form", "edonator_form", "nspravce_form", "espravce_form", "o_projektu_form"]
    hideall(form);
    var type = event.target.id;
    for (let i = 0; i < tlacitka.length; i++) {
        // console.log(tlacitka[i]);
        // console.log(form[i]);
        if (type == tlacitka[i]) {
            var visible = document.getElementById(form[i]);
            visible.style.display = "";
        }
        if (type == "nosoba") {
            var formular = document.getElementById("nosoba_f")
            formular.reset();
            var image = document.getElementById("delete_image")
            image.innerHTML = ""
        }
        if (type == "nspravce") {
            var formular = document.getElementById("nspravce_f")
            formular.reset();
        }
        if (type == "npodporovatel") {
            var formular = document.getElementById("ndonator_f");
            formular.reset();
            var div = document.getElementById("prispel");
            div.innerHTML = "";
        }
    }
}

function hideall(form) {
    // console.log(form)
    for (let i = 0; i < form.length; i++) {
        var formular = document.getElementById(form[i]);
        // console.log(formular)
        formular.style.display = "none";
    }
    return;
}
function editspravce(event) {
    event.preventDefault();
    var select = document.getElementById("spravcove");
    var selectedValue = select.value;
    // console.log(selectedValue)

    var id = '<label for= "ids" >ID:</label ><input type="text" id="ids" name="ids" value="" readonly>';

    var form = document.getElementById("id_spravce");
    form.innerHTML = id;

    var type = "edit";
    tabulka_request(selectedValue, "editspravce");
    var n_ososba = document.getElementById("nspravce_form");
    n_ososba.style.display = "";
}
function editdonator(event) {
    event.preventDefault();
    var select = document.getElementById("donatori");
    var selectedValue = select.value;
    // console.log(selectedValue)

    var id = '<label for= "idd" >ID:</label ><input type="text" id="idd" name="idd" value="" readonly>';

    var form = document.getElementById("id_donator");
    form.innerHTML = id;

    var type = "edit";
    tabulka_request(selectedValue, "editdonator");
    var n_ososba = document.getElementById("ndonator_form");
    n_ososba.style.display = "";
}
