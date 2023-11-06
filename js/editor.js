function geokoduj(e, elm) {  /* Voláno při odeslání */
    JAK.Events.cancelDef(e); /* Zamezit odeslání formuláře */
    var query = JAK.gel("adresa").value;
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
    var select = document.getElementById("lide");
    var selectedValue = select.value;
    console.log(selectedValue)

    var id = '<label for= "id" >ID:</label ><input type="text" id="id" name="id" value="" readonly>';

    var form = document.getElementById("id_form");
    form.innerHTML+=id;

    var type = "edit";
    tabulka_request(selectedValue, "edit");
    var n_ososba = document.getElementById("nosoba_form");
    n_ososba.style.display = "";
}

function prepnout(event) {
    hideall();
    var type = event.target.id;
    if (type == "nosoba") {
        var visible = document.getElementById("nosoba_form");
    }
    if (type == "edit") {
        var visible = document.getElementById("eosoba_form");
    }
    if (type == "ndum") {
        var visible = document.getElementById("ndum_form");
    }
    visible.style.display = "";
}

function hideall() {
    var edit = document.getElementById("eosoba_form");
    var n_ososba = document.getElementById("nosoba_form");
    var ndum = document.getElementById("ndum_form");
    edit.style.display = "none";
    n_ososba.style.display = "none";
    ndum.style.display = "none";
}