
var domy = document.getElementsByClassName("dum");
console.log(domy)
for (var i = 0; i < domy.length; i++) {

    // console.log(domy[i]);
    // console.log(domy[i].getAttribute("data-value"));

    var read_dum = domy[i]
    domy[i].addEventListener("click", function () { kartaopen(read_dum); });
}

// dum.addEventListener("click", function(){kartaopen(domy)})

function kartaopen(dum) {
    // console.log(dum)
    var iddomu = dum.getAttribute("id");
    document.getElementById("tabulka").style.display = "block";
    // console.log(iddomu)
    downald_data(iddomu)
}

function downald_data(id) {
    console.log(id);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // console.log(this.responseText);
            // console.log(this);
            print_data(this.responseText);
        }
    }
    id = "dum=" + id
    xhttp.open("POST", "_data.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(id);
}

function print_data(data) {
    console.log(data)
    data = JSON.parse(data)
    console.log(data)
    document.getElementById("tabulka").innerHTML = data;
}
