function tabulka_request(id, type) {
    if (type == "lide") {
        var cFunction = lide;
    }
    else if (type == "clovek") {
        // console.log(id)
        var loading = document.getElementById('data');
        loadinig(loading);
        var curent_active = document.getElementsByClassName("active")
        for (var i = 0; i < curent_active.length; i++) {
            curent_active[i].classList.remove("active");
        };
        var current_element = document.getElementById(id);
        if (current_element != null) {
            current_element.classList.add("active");
        }

        var cFunction = clovek;

    }
    else if (type == "otec") {
        var cFunction = otec;
    }
    else if (type == "matka") {
        var cFunction = matka;
    }
    else if (type == "edit") {
        var cFunction = editpersone;
    }

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // console.log(xhr);
            cFunction(xhr.responseText);
        }
    };
    var data = new FormData();
    data.append('id', id);
    data.append("type", type);
    xhr.open("POST", "_tabulka.php", true);
    xhr.send(data);
}

function lide(data) {
    var tabulka = document.getElementById("tabulka");
    tabulka.style.display = "flex"
    document.addEventListener('click', function handleClickOutsideBox(event) {

        if (!tabulka.contains(event.target)) {
            tabulka.style.display = 'none';
        }
    });
    data = JSON.parse(data);
    console.log(data);
    if (data["error"] !== undefined) {
        return;
    }
    var lide = document.getElementById('lide');
    var lidetext = "";
    for (var i = 0; i < data.length; i++) {
        var clovek = "<div class = 'clovek' id =" + data[i].id + ">" + data[i].jmeno + " " + data[i].prijmeni + "</div>"
        lidetext += clovek;
    }
    lide.innerHTML = lidetext;
    tabulka_request(data[0].id, "clovek");

}

function clovek(data) {

    var clovek = document.getElementById('data');
    data = JSON.parse(data);
    console.log(data)

    if (document.getElementById(data["id"]) == null) {
        text = "<div class = 'clovek active' id =" + data["id"] + ">" + data["jmeno"] + " " + data["prijmeni"] + "</div>"
        var lide = document.getElementById('lide');
        lide.innerHTML += text;
    }

    var text = ""
    var keys = [
        "id",
        "jmeno",
        "prijmeni",
        "datum_narozeni",
        "misto_narozeni",
        "rodinny_stav",
        "nabozenske_vyznani",
        "statni_prislusnost",
        "nove_bydliste",
        "okres",
        "ulice",
        "cislo",
        // "dum_id",
        "den_prichodu",
        "otec-j",
        "matka-j",
        "majitel_mot_vozidla",
        "cinny_v_protiletadlove_obrane",
        "datum_presidleni",
        "presidlil",
        "datum_odhaseni",
        "karta",
        "informace"
    ]

    var nazvy = nazvy_jazyk();

    var popisek = "";

    for (var i = 1; i < keys.length; i++) {
        if (data[keys[i]] == null) {
            continue;
        }
        if (keys[i].includes("id")) {
            var id = data[keys[i]];
        }
        else {
            var id = keys[i];
        }
        if (keys[i] == "otec-j") {
            if (data["otec_id"] != null) {
                id = data["otec_id"];
                popisek = " n_ososba"
            }
        } else if (keys[i] == "matka-j") {
            if (data["matka_id"] != null) {
                id = data["matka_id"];
                popisek = " n_ososba"
            }
        }
        else {
            id = keys[i];
        }
        var subtext = '<div class="radek_tabulky">\n<div class="popisek' + popisek + '">' + nazvy[i] + '</div>\n <div class="data" id="' + id + '">';

        if (keys[i] == "majitel_mot_vozidla" || keys[i] == "cinny_v_protiletadlove_obrane") {
            if (data[i] = 1) {
                subtext += "Ano"
            }
            else {
                subtext += "Ne"
            }
        }
        else {
            subtext += data[keys[i]]
        }
        subtext += '</div>\n</div>\n'
        text += subtext
    }

    clovek.innerHTML = text;

    var divlidi = document.getElementsByClassName("clovek");
    for (var i = 0; i < divlidi.length; i++) {
        divlidi[i].addEventListener("click", change_persone);
    }
    if (data["otec_id"] != null) {
        otec(data)
    }
    if (data["matka_id"] != null) {
        matka(data)
    }
}

function otec(data) {
    var otec = document.getElementById(data["otec_id"])
    otec.addEventListener("click", function (event) {
        change_persone(event);
    });
}
function matka(data) {
    var matka = document.getElementById(data["matka_id"])
    matka.addEventListener("click", change_persone);
}

function close() {
    tabulka_request(null, "close");
}


function change_persone(event) {
    var id_div = event.target.id;
    console.log(id_div);
    tabulka_request(id_div, "clovek");
}

function loadinig(misto) {
    misto.innerHTML = "loading"
}

function nazvy_jazyk() {
    var cz = [
        "Id",
        "Jméno",
        "Příjmení",
        "Datum narození",
        "Místo narození",
        "Rodinný stav",
        "Náboženské vyznání",
        "Státní příslušnost",
        "Nové bydliště",
        "Okres",
        "Ulice",
        "Číslo",
        // "Dům Id",
        "Den příchodu",
        "Otec",
        "Matka",
        "Majitel motorového vozidla",
        "Činný v protiletadlové obraně",
        "Datum přesídlení",
        "Přesídlil",
        "Datum odhlášení",
        "Karta",
        "Informace"
    ];
    return (cz);
}

function editpersone(data) {
    data = JSON.parse(data);
    for (var key in data) {
        var hodnota = data[key];
        var pole = document.getElementById(key);
        // console.log(hodnota);
        // console.log(key);
        if (pole) {
            pole.value = hodnota;
        }
    }
    console.log(data)
}

