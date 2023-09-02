function tabulka_request(id, type) {
    if (type == "lide"){
        var cFunction = lide;
    }
    else{
        var cFunction = clovek;
    }
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            cFunction(xhr)
        }
    };
    var data = new FormData();
    data.append('id', id);
    data.append("type", type);
    xhr.open("POST", "_tabulka.php", true);
    xhr.send(data);
}

function lide(data){
    console
    if ("error" in data){
        return
    }
    
    data = JSON.parse(data);
    data.sort(function(a, b) {
        var comparison = a.prijmeni.localeCompare(b.prijmeni); // Porovnání příjmení
    
        if (comparison === 0) {
            // Pokud jsou příjmení stejná, porovnejte jména
            comparison = a.jmeno.localeCompare(b.jmeno);
        }
    
        return comparison;
    });
    var lide = document.getElementById('myDivId');
    lide.innerHTML ="";
    for(i in data){
        var clovek = "<div class = 'clovek' id =" + i.id + ">"+ i.jmeno +" " + i.prijmeni + "</div>" 
        lide.innerHTML += clovek;
    }
    tabulka_request (lide[1].id, "clovek");
}

function clovek(data){

}

