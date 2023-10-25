function tabulka_request(id, type) {
    if (type == "people") {
        var cFunction = people_in_house;
    }
    else if (type == "persone") {
        var mapa = document.getElementById("mapa");
        mapa.classList.add("gray");
        console.log(id)
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

        var cFunction = persone;
    }
    else if (type == "father") {
        var cFunction = father;
    }
    else if (type == "mother") {
        var cFunction = mother;
    }
    else if (type == "edit") {
        var cFunction = editpersone;
    }
    else {
        var cFunction = nothing;
    }
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // console.log(xhr);
            cFunction(xhr.responseText);
        }
    };
    // console.log(id,type)
    var data = new FormData();
    data.append('id', id);
    data.append("type", type);
    // console.log(data);
    xhr.open("POST", "_tabulka.php", true);
    xhr.send(data);
}

function lide_clik(event) {
    var lide_tabulka = document.getElementsByClassName("clovek");
    // console.log(lide_tabulka)
    for (var i = 0; i < lide_tabulka.length; i++) {
        if (lide_tabulka[i].contains(event.target)) {
            return false;
        }
    }
    return true;
}

function informace_clik(event) {
    var informace_tabulka = document.getElementById("radek_informace");
    if (informace_tabulka != null && informace_tabulka.contains(event.target)) {
        return false
    }
    return true

}

function tabulka_hide(){
    var tabulka = document.getElementById("tabulka");
    if (tabulka.classList.contains("hidden")) {
        tabulka.classList.remove("hidden");
        setTimeout(function () {
            tabulka.classList.remove('visuallyhidden');
          }, 20);
        
      } else {
        tabulka.classList.add("visuallyhidden");
        setTimeout(() => {
            tabulka.classList.add ("hidden");
          }, 500);
      }
}

function people_in_house(data) {
    var tabulka = document.getElementById("tabulka");
    tabulka.classList.remove("hidden");
    setTimeout(function () {
        tabulka.classList.remove('visuallyhidden');
      }, 20);

    document.addEventListener('click', function handleClickOutsideBox(event) {
        console.log("clik")
        var lide_tabulka = document.getElementById("lide");
        var data_tabulka = document.getElementById("data");
        // console.log(event.target)
        // console.log(lide_clik(event))
        if (lide_clik(event) && !data_tabulka.contains(event.target) && informace_clik(event)) {
            var mapa = document.getElementById("mapa");
            mapa.classList.remove("gray");

            tabulka.classList.add("visuallyhidden");
            setTimeout(() => {
                tabulka.classList.add ("hidden");
              }, 500);
            console.log("hide")
            close();
        }
    });
    console.log(data);
    data = JSON.parse(data);
    console.log(data);
    if (data["error"] !== undefined) {
        return;
    }
    var lide = document.getElementById('lide');
    var lidetext = "";
    for (var i = 0; i < data.length; i++) {
        var clovek = div_lide(data[i]);
        lidetext += clovek;
    }
    lide.innerHTML = lidetext;
    tabulka_request(data[0].id, "persone");
}

function div_lide(data) {
    var clovek = "<div class = 'clovek' id =" + data.id + ">" + data.jmeno + " " + data.prijmeni + "</div>"
    return clovek;
}

function persone(data) {

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
    ]

    var nazvy = language_set("cz");

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
        var subtext = '<div class="radek_tabulky">\n<div class="popisek' + popisek + '">' + nazvy[i] + ': </div>\n <div class="data_r" id="' + id + '">';

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

    if (data["informace"] != null) {
        var subtext = '<div id="radek_informace">\n<div class="popisek_informace"> Informace: </div>\n <div class="data_r" id="informacet">' + data["informace"] + '</div>\n</div>\n';
        document.getElementById("informace").innerHTML = subtext;
    }

    var divlidi = document.getElementsByClassName("clovek");
    for (var i = 0; i < divlidi.length; i++) {
        divlidi[i].addEventListener("click", change_persone);
    }
    if (data["otec_id"] != null) {
        father(data)
    }
    if (data["matka_id"] != null) {
        mother(data)
    }
}

function father(data) {
    var otec = document.getElementById(data["otec_id"])
    otec.addEventListener("click", function (event) {
        change_persone(event);
    });
}

function mother(data) {
    var matka = document.getElementById(data["matka_id"])
    matka.addEventListener("click", change_persone);
}

function close() {
    tabulka_request(null, "close");
}

function change_persone(event) {
    var id_div = event.target.id;
    console.log(id_div);
    tabulka_request(id_div, "persone");
}

function loadinig(misto) {
    var informace = document.getElementById("informace");
    informace.innerHTML = "";
    misto.innerHTML = "<div class='lds-spinner'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>";
}

function language_set(langue) {
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

function nothing() {

}