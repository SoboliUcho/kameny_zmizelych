function tabulka_request(id, type) {
    if (type == "people") {

        var cFunction = people_in_house;
    }
    else if (type == "persone") {
        var mapa = document.getElementById("mapa");
        mapa.classList.add("gray");
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
        tabulka_hide();
        var cFunction = persone;
    }
    else if (type == "persone2") {
        type = "persone"
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
    else if (type == "page") {
        type = "persone"
        var cFunction = page;
    }
    else if (type == "editspravce") {
        var cFunction = spravce;
    }
    else if (type == "editdonator") {
        var cFunction = donator;
    }
    else if (type == "dum") {
        var cFunction = dum_edit;
    }
    else {
        var cFunction = nothing;
    }
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            cFunction(xhr.responseText);
        }
    };
    var data = new FormData();
    data.append('id', id);
    data.append("type", type);
    xhr.open("POST", "_tabulka.php", true);
    xhr.send(data);
}

function lide_clik(event) {
    var lide_tabulka = document.getElementsByClassName("clovek");
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

function tabulka_hide() {
    var tabulka = document.getElementById("tabulka");
    if (tabulka.classList.contains("hidden")) {
        // console.log("remove hidden")
        tabulka.classList.remove("hidden");
        setTimeout(function () {
            tabulka.classList.remove('visuallyhidden');
            // console.log("remove visual")
        }, 20);

    } else {
        tabulka.classList.add("visuallyhidden");
        setTimeout(() => {
            tabulka.classList.add("hidden");
        }, 500);
    }
}

function people_in_house(data) {
    document.addEventListener('click', function handleClickOutsideBox(event) {
        var lide_tabulka = document.getElementById("lide");
        var data_tabulka = document.getElementById("data");
        var obr = document.getElementById("obrazkyshow")
        if (lide_clik(event) && !data_tabulka.contains(event.target) && informace_clik(event) && obr.classList.contains("hidden")) {
            var mapa = document.getElementById("mapa");
            mapa.classList.remove("gray");
            tabulka_hide()
            document.removeEventListener('click', handleClickOutsideBox)
            close();
        }
    });
    data = JSON.parse(data);
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

    if (document.getElementById(data["id"]) == null) {
        text = "<div class = 'clovek active' id =" + data["id"] + ">" + data["jmeno"] + " " + data["prijmeni"] + "</div>"
        var lide = document.getElementById('lide');
        lide.innerHTML += text;
    }

    var keys = keysword();
    var nazvy = language_set("cz");


    clovek.innerHTML = innerHTMLtext(data, keys, nazvy);
    if (data["karta"] != null) {
        var img = "";
        var karta = JSON.parse(data["karta"]);
        for (let index = 0; index < karta.length; index++) {
            // console.log(karta)
            img += '<div class = "ctverec"><img src="' + karta[index] + '" alt="obrazek" class="obrazek"></div>';

        }
        var text = '<div class="radek_tabulky">\n<div class="popisek karta">' + nazvy[nazvy.length - 2] + ':</div>\n <div class="data_r" id="karta">' + img + '</div>\n</div>\n';
        clovek.innerHTML += text
    }

    if (data["informace"] != null) {
        var subtext = '<div id="radek_informace">\n<div class="popisek_informace"> Informace: </div>\n <div class="data_r" id="informacet">' + data["informace"] + '</div>\n</div>\n';
        document.getElementById("informace").innerHTML = subtext;
    }

    var divlidi = document.getElementsByClassName("clovek");
    for (var i = 0; i < divlidi.length; i++) {
        divlidi[i].addEventListener("click", change_persone);
    }
    var div_n_osoba = document.getElementsByClassName("n_ososba")
    // for (var i = 0; i < div_n_osoba.length; i++) {
    //     div_n_osoba[i].addEventListener("click", change_persone);
    // }
    // if (data["otec_id"] != null) {
    //     father(data)
    // }
    // if (data["matka_id"] != null) {
    //     mother(data)
    // }
    var obrazky = document.getElementsByClassName("obrazek");
    for (var i = 0; i < obrazky.length; i++) {
        obrazky[i].addEventListener("click", openimage);
    }
    var n_ososba = document.getElementsByClassName("n_ososba");
    for (let i = 0; i < n_ososba.length; i++) {
        n_ososba[i].addEventListener("click", function (event) {
            event.stopPropagation();
            change_persone(event);
        })
    }
}
function innerHTMLtext(data, keys, nazvy) {
    var text = "";

    var last_key = [];
    for (var i = 1; i < keys.length; i++) {
        var popisek = "";

        if (keys[i] == '_' && last_key[last_key.length - 1] != '_') {
            text += '<div class="prazdky_radek"></div><div></div>'
            last_key.push(keys[i])
            continue
        }
        if (data[keys[i]] == null) {
            continue;
        }
        else if (keys[i] == "rozena" && keys.includes("prijmeni")) {
            continue;
        }
        else if (keys[i] == "misto_narozeni" && keys.includes("datum_narozeni")) {
            continue;
        }
        else {
            var id = keys[i];
        }
        if (keys[i].includes("datum") || keys[i].includes("presidlil") || keys[i].includes("den_prichodu") || keys[i].includes("mrtvy")) {
            var date = new Date(data[keys[i]])
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();
            data[keys[i]] = `${day}. ${month}. ${year}`;
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
        } else if (keys[i] == "partner") {
            if (data["matka_id"] != null) {
                id = data["partner_id"];
                popisek = " n_ososba"
            }
        }
        else {
            id = keys[i];
        }
        if (nazvy[i] instanceof Array) {
            if (data["pohlavi"] == "NULL") {
                data["pohlavi"] = 0;
            }
            nazev = nazvy[i][data["pohlavi"]];
        }
        else {
            var nazev = nazvy[i];
        }

        var insrted_text = "";
        if (keys[i] == "majitel_mot_vozidla" || keys[i] == "cinny_v_protiletadlove_obrane") {
            if (data[keys[i]] == 1) {
                insrted_text += "Ano"
            }
            else {
                continue;
            }
        } else if (keys[i] == "deti") {
            deti = JSON.parse(data["deti"]);
            deti_id = JSON.parse(data["deti_id"])
            for (let j = 0; j < deti.length; j++) {
                if (deti_id[j] != null) {
                    idd = deti_id[j];
                    popisekd = " n_ososba";
                }
                else {
                    idd = "dite" + j;
                    popisekd = ""
                }
                insrted_text += "<div class='dite" + popisekd + "' id='" + idd + "'>" + deti[j] + "</div>";
            }
        }
        else if (keys[i] == "odkazy") {
            id = "odkazy"
            url = JSON.parse(data["odkazy"]);
            for (let j = 0; j < url.length; j++) {
                insrted_text += "<a class='n_ososba' href='" + url[j][1] + "' target='_blank'>" + url[j][0] + "</a>";
            }
        }
        else if (keys[i] == "prijmeni" && data["rozena"] != null) {
            insrted_text += data[keys[i]] + " (rozená " + data["rozena"] + ")"
        }
        else if (keys[i] == "datum_narozeni" && data["misto_narozeni"] != null) {
            insrted_text += data[keys[i]] + " " + data["misto_narozeni"] + ""
        }
        else {
            insrted_text += data[keys[i]]
        }
        var subtext = '<div class="radek_tabulky">\n<div class="popisek">' + nazev + ': </div>\n <div class="data_r' + popisek + '" id="' + id + '">' + insrted_text + '</div>\n</div>\n'
        text += subtext;
        last_key.push(keys[i])
    }
    if (last_key[last_key.length - 1] == "_") {
        var substringToRemove = '<div class="prazdky_radek"></div><div></div>'
        var lastOccurrenceIndex = text.lastIndexOf(substringToRemove);
        var modifiedText = text.substring(0, lastOccurrenceIndex) + text.substring(lastOccurrenceIndex + substringToRemove.length)
        text = modifiedText
    }
    return text;
}

function father(data) {
    var otec = document.getElementById(data["otec_id"])
    otec.addEventListener("click", function (event) {
        event.stopPropagation()
        change_persone(event);
    });
}

function mother(data) {
    var matka = document.getElementById(data["matka_id"])
    matka.addEventListener("click", function (event) {
        event.stopPropagation()
        change_persone(event);
    });
}

function close() {
    tabulka_request(null, "close");
}

function change_persone(event) {
    var id_div = event.target.id;
    console.log(id_div);
    tabulka_request(id_div, "persone2");
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
        "Rozená",
        "Datum narození",
        "Místo narození",
        ["Zemřel", "Zemřela"],
        ["Prohlášen za mrtvého", "Prohlášena za mrtvou"],
        "Státní příslušnost",
        "Náboženské vyznání",
        "Zaměstnání",
        "",
        "Otec",
        "Matka",
        "Rodinný stav",
        ["Manželka", "Manžel"],
        "Děti",
        ["Majitel motorového vozidla", "Majitelka motorového vozidla"],
        "",
        "Den příchodu",
        "Datum transportu",
        "Číslo transportu",
        // "Dům Id",
        "Datum přesídlení",
        "Datum odhlášení",
        "",
        // "Činný v protiletadlové obraně",
        "Odkazy",
        "Fotky",
        "Další informace"
    ];
    return (cz);
}

function keysword() {
    var keys = [
        "id",
        "jmeno",
        "prijmeni",
        "rozena",
        "datum_narozeni",
        "misto_narozeni",
        "mrtvy",
        "realmrtvy",
        "statni_prislusnost",
        "nabozenske_vyznani",
        "zamnestnani",
        "_",
        "otec-j",
        "matka-j",
        "rodinny_stav",
        "partner",
        "deti",
        "majitel_mot_vozidla",
        "_",
        "den_prichodu",
        "presidlil",
        "transport",
        // "dum_id", 
        // "partner_id",
        // "otec_id", 
        // "matka_id", 
        // "deti_id", 
        "datum_presidleni",
        "datum_odhaseni",
        "_",
        "odkazy",
        // "karta", 
        // "informace", 
        // "spravce"
    ]
    return keys;
}


function editpersone(data) {
    data = JSON.parse(data);
    for (var key in data) {
        if (key == "karta" && data["karta"] != null) {
            console.log(data[key]);
            karta_img(data[key]);
        }
        if (key == "karta" || key == "deti_id") {
            continue;
        }
        if (key == "deti") {
            var deti = JSON.parse(data[key])
            var detiid = JSON.parse(data["deti_id"])
            if (deti == null) {
                continue;
            }
            for (let i = 0; i < deti.length; i++) {
                var input = document.getElementsByClassName("dite_name");
                var selct = document.getElementsByClassName('dite_op');
                input[i].value = deti[i];
                selct[i].value = detiid[i];
                nove_dite();
            }
            continue;
        }
        if (key == "odkazy") {
            var odkazy = JSON.parse(data[key])
            if (odkazy == null) {
                continue;
            }
            for (let i = 0; i < odkazy.length; i++) {
                var nazev = document.getElementsByClassName("nazev");
                var url = document.getElementsByClassName('url');
                nazev[i].value = odkazy[i][0];
                url[i].value = odkazy[i][1];
                console.log("echo");
                nove_odkaz();
            }
            continue;
        }
        var hodnota = data[key];
        var pole = document.getElementById(key);
        if (pole) {
            pole.value = hodnota;
        }
    }
    console.log(data)
}

function karta_img(data) {
    var deleteimage = document.getElementById("delete_image")
    // console.log(data)
    data = JSON.parse(data);
    console.log(data);
    var img = "<label class='obrazek_label'> vyberte obrázek na smazání: </label>";
    for (let index = 0; index < data.length; index++) {
        img += '<label class="obrazek_label"><input type="checkbox" name="del_images[]" value="' + data[index] + '"><div class="ctverec"><img src="' + data[index] + '" alt="obrazek" class="obrazek"></div></label>';
    }
    deleteimage.innerHTML = img;
}

function openimage(event) {
    event.stopPropagation()
    var obr = document.getElementById("obrazkyshow")
    var tabulka = document.getElementById("tabulka")
    obr.innerHTML = '<img src="' + event.target.src + '" alt="obrazek" class="popuoutimage">'
    obr.classList.remove("hidden")
    tabulka.classList.add("gray");
    setTimeout(function () {
        obr.classList.remove('visuallyhidden');
    }, 20)
    document.addEventListener("click", function closeimg(event) {
        tabulka.classList.remove("gray");
        obr.classList.add("visuallyhidden");
        setTimeout(() => {
            obr.classList.add("hidden");
        }, 500);
        document.removeEventListener('click', closeimg)
    })
}

function nothing() {

}

function page(data) {

    data = JSON.parse(data);
    var clovek = document.getElementById("clovek" + data["id"]);
    var rozsireni = clovek.getElementsByClassName("rozsireni");
    tabulka = rozsireni[0].getElementsByClassName("data");

    var keys = keysword();
    var nazvy = language_set("cz");

    keys = keys.filter(item => item != "jmeno");
    keys = keys.filter(item => item != "prijmeni");
    nazvy = nazvy.filter(item => item != "Příjmení")
    nazvy = nazvy.filter(item => item != "Jméno")

    tabulka[0].innerHTML = innerHTMLtext(data, keys, nazvy);

    if (data["karta"] != null) {
        var img = "";
        var karta = JSON.parse(data["karta"]);
        for (let index = 0; index < karta.length; index++) {
            // console.log(karta)
            img += '<div class = "ctverec"><img src="' + karta[index] + '" alt="obrazek" class="obrazek"></div>';

        }
        var text = '<div class="radek_tabulky">\n<div class="popisek karta"> Karta: </div>\n <div class="data_r" id="karta">' + img + '</div>\n</div>\n';
        tabulka[0].innerHTML += text
    }

    if (data["informace"] != null) {
        var subtext = '<div id="radek_informace">\n<div class="popisek_informace"> Informace: </div>\n <div class="data_r" id="informacet">' + data["informace"] + '</div>\n</div>\n';
        clovek.getElementsByClassName("informace")[0].innerHTML = subtext;
    }
    var obrazky = clovek.getElementsByClassName("obrazek");
    for (var i = 0; i < obrazky.length; i++) {
        obrazky[i].addEventListener("click", openimagepage);
    }
    rozsireni[0].classList.remove("hidden");
    setTimeout(function () {
        rozsireni[0].classList.remove('visuallyhidden');
        // console.log("remove visual")
    }, 20);

}

function openimagepage(event) {
    event.stopPropagation()
    var obr = document.getElementById("obrazkyshow")
    var nelisat = document.getElementById("nelista")
    obr.innerHTML = '<img src="' + event.target.src + '" alt="obrazek" class="popuoutimage">'
    obr.classList.remove("hidden")
    nelisat.classList.add("gray");
    setTimeout(function () {
        obr.classList.remove('visuallyhidden');
    }, 20)
    document.addEventListener("click", function closeimg(event) {
        nelisat.classList.remove("gray");
        obr.classList.add("visuallyhidden");
        setTimeout(() => {
            obr.classList.add("hidden");
        }, 500);
        document.removeEventListener('click', closeimg)
    })
}

function spravce(data) {
    data = JSON.parse(data);
    console.log(data);
    var jmeno = document.getElementById("jmenos");
    var email = document.getElementById("emails");
    var id = document.getElementById("ids");
    var checkbox = document.getElementById("visibles");
    jmeno.value = data[0]["jmeno"];
    email.value = data[0]["email"];
    id.value = data[0]["id"];
    if (data[0]["visible"] == 1) {
        checkbox.checked = true;
    }
    else {
        checkbox.checked = false;
    }
    for (let i = 0; i < data[1].length; i++) {
        var lide = document.getElementsByClassName("clovek_s_id");
        lide[i].value = data[1][i]["id"];
        dalsi_clovek();
    }
}
function donator(data) {
    console.log(data);
    data = JSON.parse(data);
    var jmeno = document.getElementById("jmenod");
    var email = document.getElementById("emaild");
    var id = document.getElementById("idd");
    var cena = document.getElementById("prispel");
    var stara_castka = document.getElementById("stara_castka");
    var checkbox = document.getElementById("visibled");
    jmeno.value = data["jmeno"];
    email.value = data["email"];
    id.value = data["id"];
    stara_castka.value = data["castka"];
    if (data["visible"] == 1) {
        checkbox.checked = true;
    }
    else {
        checkbox.checked = false;
    }
    var text = "Přispěl " + data["castka"] + " Kć";
    cena.innerHTML = text;
}
function dum_edit(data){
    
}