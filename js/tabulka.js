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
    else if(type == "page"){
        type = "persone"
        var cFunction = page;
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

function tabulka_hide(){
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
            tabulka.classList.add ("hidden");
          }, 500);
      }
}

function people_in_house(data) {
    document.addEventListener('click', function handleClickOutsideBox(event) {
        var lide_tabulka = document.getElementById("lide");
        var data_tabulka = document.getElementById("data");
        var obr = document.getElementById("obrazkyshow")
        if (lide_clik(event) && !data_tabulka.contains(event.target) && informace_clik(event)&&obr.classList.contains("hidden")) {
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

    var text = "";
    var keys = keysword();
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
        if (keys[i].includes("datum") || keys[i].includes("presidlil") || keys[i].includes("den_prichodu") ){
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
    if (data["karta"] != null) {
        var img = "";
    var karta = JSON.parse(data["karta"]);
        for (let index = 0; index < karta.length; index++) {
            // console.log(karta)
            img +='<div class = "ctverec"><img src="'+karta[index]+'" alt="obrazek" class="obrazek"></div>';
            
        }
        var text = '<div class="radek_tabulky">\n<div class="popisek karta"> Karta: </div>\n <div class="data_r" id="karta">'+img+'</div>\n</div>\n';
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
    if (data["otec_id"] != null) {
        father(data)
    }
    if (data["matka_id"] != null) {
        mother(data)
    }
    var obrazky = document.getElementsByClassName("obrazek");
    for (var i = 0; i < obrazky.length; i++) {
        obrazky[i].addEventListener("click", openimage);
    }
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

 function keysword(){
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
        // "karta",
    ]
    return keys;
 }
function editpersone(data) {
    data = JSON.parse(data);
    for (var key in data) {
        if (key == "karta" && data["karta"]!=null){
            console.log(data[key]);
            karta_img(data[key]);
        }
        if (key == "karta"){
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

function karta_img(data){
    var deleteimage = document.getElementById("delete_image")
    // console.log(data)
    data = JSON.parse(data);
    console.log(data);
    var  img = "<label class='obrazek_label'> vyberte obrázek na smazání: </label>";
    for (let index = 0; index < data.length; index++) {
        img +='<label class="obrazek_label"><input type="checkbox" name="del_images[]" value="'+data[index]+'"><div class="ctverec"><img src="'+data[index]+'" alt="obrazek" class="obrazek"></div></label>';
    }
    deleteimage.innerHTML = img;
}

function openimage(event){
    event.stopPropagation()
    var obr = document.getElementById("obrazkyshow")
    var tabulka =document.getElementById("tabulka")
    obr.innerHTML= '<img src="'+event.target.src+'" alt="obrazek" class="popuoutimage">'
    obr.classList.remove("hidden")
    tabulka.classList.add("gray");
    setTimeout(function () {
        obr.classList.remove('visuallyhidden');
      }, 20)
    document.addEventListener("click", function closeimg(event) {
        tabulka.classList.remove("gray");
        obr.classList.add("visuallyhidden");
        setTimeout(() => {
            obr.classList.add ("hidden");
          }, 500);
        document.removeEventListener('click', closeimg)
    })
}

function nothing() {

}

function page(data){
    
    data = JSON.parse(data);
    var clovek = document.getElementById(data["id"]);
    var rozsireni = clovek.getElementsByClassName("rozsireni");
    tabulka = rozsireni[0].getElementsByClassName("data");

    var text = "";
    var keys = keysword();
    var nazvy = language_set("cz");

    var popisek = "";

    for (var i = 1; i < keys.length; i++) {
        if (data[keys[i]] == null || keys[i] == "jmeno"|| keys[i] == "prijmeni") {
            continue;
        }
        else {
            var id = keys[i];
        }
        if (keys[i].includes("datum") || keys[i].includes("presidlil") || keys[i].includes("den_prichodu")){
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
    
    tabulka[0].innerHTML = text;
   
    if (data["karta"] != null) {
        var img = "";
    var karta = JSON.parse(data["karta"]);
        for (let index = 0; index < karta.length; index++) {
            // console.log(karta)
            img +='<div class = "ctverec"><img src="'+karta[index]+'" alt="obrazek" class="obrazek"></div>';
            
        }
        var text = '<div class="radek_tabulky">\n<div class="popisek karta"> Karta: </div>\n <div class="data_r" id="karta">'+img+'</div>\n</div>\n';
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

function openimagepage(event){
    event.stopPropagation()
    var obr = document.getElementById("obrazkyshow")
    var nelisat =document.getElementById("nelista")
    obr.innerHTML= '<img src="'+event.target.src+'" alt="obrazek" class="popuoutimage">'
    obr.classList.remove("hidden")
    nelisat.classList.add("gray");
    setTimeout(function () {
        obr.classList.remove('visuallyhidden');
      }, 20)
    document.addEventListener("click", function closeimg(event) {
        nelisat.classList.remove("gray");
        obr.classList.add("visuallyhidden");
        setTimeout(() => {
            obr.classList.add ("hidden");
          }, 500);
        document.removeEventListener('click', closeimg)
    })
}