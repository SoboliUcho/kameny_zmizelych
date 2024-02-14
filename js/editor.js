async function geokoduj(adresa) {  /* Voláno při odeslání */
    const API_KEY = '-YU-3m6kTF_X0RFCcyIDyMT5EbJixEkzsmz8JlWMoWY';
    try {
        const url = new URL(`https://api.mapy.cz/v1/geocode`);

        url.searchParams.set('lang', 'cs');
        url.searchParams.set('apikey', API_KEY);
        url.searchParams.set('query', adresa);
        url.searchParams.set('limit', '1');
        [
            'regional.municipality',
            'regional.municipality_part',
            'regional.street',
            'regional.address'
        ].forEach(type => url.searchParams.append('type', type));

        const response = await fetch(url.toString(), {
            mode: 'cors',
        });
        const json = await response.json();

        // console.log('geocode', json);
        godpoved = odpoved(json)
        return godpoved;
    } catch (ex) {
        console.log(ex);
    }
}

function odpoved(geocoder) { /* Odpověď */
    if (!geocoder.items.length) {
        alert("Tohle místo neznáme.");
        return;
    }

    var vysledky = geocoder.items[0];
    var cislo = vysledky.regionalStructure.find(item => item.type === "regional.address").name;
        var lomítka = cislo.split('/');
        // console.log(items);
        var ctvrt = vysledky.regionalStructure.find(item => item.type === "regional.municipality_part").name;
        var mesto = vysledky.regionalStructure.find(item => item.type === "regional.municipality").name;
        if (ctvrt != mesto){
            mesto = mesto +" - "+ctvrt;
        }
        var addressInfo = {
            ulice: vysledky.regionalStructure.find(item => item.type === "regional.street").name,
            pscislo: lomítka[0],
            ocislo: lomítka[1],
            mesto: mesto,
            stat: vysledky.regionalStructure.find(item => item.type === "regional.country").name,
            gps_x: vysledky.position.lon,
            gps_y: vysledky.position.lat
        };
        console.log(addressInfo)
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
    return {gps_x:addressInfo.gps_x, gps_y:addressInfo.gps_y}
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
    var tlacitka = ["nosoba", "edit", "ndum", "edum", "nclanek", "npodporovatel", "epodporovatel", "nspravce", "espravce", "o_projektu", "controler", "deleter"]
    var form = ["nosoba_form", "eosoba_form", "ndum_form", "edum_form", "novy_clanek_form", "ndonator_form", "edonator_form", "nspravce_form", "espravce_form", "o_projektu_form","controler_form","odstraneni","odstraneni","dum_form"]
    var  deleter = document.getElementById("deleter");
    if (deleter == null){
        tlacitka.splice(11, 1);
    }
    hideall(form);
    for (let i = 0; i < tlacitka.length; i++) {
        var talcitko = document.getElementById(tlacitka[i])
        talcitko.style.backgroundColor = ""
    }
    var type = event.target.id;
    event.target.style.backgroundColor = "var(--bs-brown-mid)";
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
        if (type == "ndum" || type == "edum") {
            var formular = document.getElementById("control_form");
            formular.reset();
            var visible = document.getElementById("dum_form");
            visible.style.display = "";
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
function stopform(id){
    var form = document.getElementById(id);
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const isConfirmed = confirm('Chcete pokračovat s odstraněním? Akce je nevratná!');
        if (isConfirmed) {
            form.submit();
          } else {
            console.log('Form submission canceled');
          }
    });
}