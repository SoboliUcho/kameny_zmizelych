function tabulka_request(id, type) {
    if (type == "lide") {
        var cFunction = lide;
    }
    else if(type == "clovek") {
        var cFunction = clovek;
    }
    else if (type == "otec"){
        var cFunction = otec;
    }
    else if (type == "matka"){
        var cFunction = matka;
    }

    // console.log(id);
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
    tabulka_request(data[0].id, "clovek");
    lide.innerHTML = lidetext;
}

function clovek(data) {
    data = JSON.parse(data);
    console.log(data)
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

    var nazvy = [
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

    var popisek="";

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
        if (keys[i] == "otec-j"){
            if (data["otec-id"]!=null){
                var id = data["otec-id"];
                popisek = " n_ososba"
            }
        }else if (keys[i] == "matka-j"){
            if (data["matka-id"]!=null){
                var id = data["matka-id"];
                popisek = " n_ososba"
            }
        }
        else {
            var id = keys[i];
        }
        var subtext = '<div class="radek_tabulky">\n<div class="popisek'+popisek+'">' + nazvy[i] + '</div>\n <div class="data" id="' + id + '">';

        if (keys[i] == "majitel_mot_vozidla" || keys[i]== "cinny_v_protiletadlove_obrane") {
            if (data[i]=1){
                subtext += "Ano"
            }
            else{
                subtext += "Ne"
            }
        } 
        subtext += '</div>\n</div>\n'
        text += subtext
    }
    var clovek = document.getElementById('data');
    clovek.innerHTML = text;
}

function otec(data){

}
function matka(data){

}

function close() {
    tabulka_request(null, "close");
}

var divlidi = document.getElementsByClassName("clovek");
for (var i = 0; i < divlidi.length; i++) {
    divlidi[i].addEventListener("click", change_persone());
}

function change_persone(event){
    var id_div = event.target.id;
    clovek(id_div)
}