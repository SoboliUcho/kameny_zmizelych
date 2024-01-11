<<<<<<< HEAD
function prepnout(event) {
    var prispeli = document.getElementById("prispeli_tabulka");
    var spravci = document.getElementById("starost");
    var starost = document.getElementById("volne");
    prispeli.style.display = "none";
    spravci.style.display = "none";
    starost.style.display = "none";
    var tlacitka = document.getElementsByClassName("prepinac")
    for (let i = 0; i < tlacitka.length; i++) {
        tlacitka[i].classList.remove("active");
    }

    var currentUrl = new URL(window.location.href);
    currentUrl.searchParams.forEach((value, key) => {
        currentUrl.searchParams.delete(key);
    });
    if (event.target.id == "prispeli") {
        var tlacitko = document.getElementById("prispeli");
        tlacitko.classList.add("active");
        prispeli.style.display = "";
        currentUrl.searchParams.set("prispeli", "");
    }
    if (event.target.id == "spravci") {
        var tlacitko = document.getElementById("spravci");
        tlacitko.classList.add("active");
        spravci.style.display = "";
        currentUrl.searchParams.set("spravci", "");
    }
    if (event.target.id == "kamen") {
        var tlacitko = document.getElementById("kamen");
        tlacitko.classList.add("active");
        starost.style.display = "";
        currentUrl.searchParams.set("kamen", "");
    }
    newUrl = currentUrl.toString();
    window.history.replaceState({}, "", newUrl);
=======
function prepnout(event) {
    var prispeli = document.getElementById("prispeli_tabulka");
    var spravci = document.getElementById("starost");
    var starost = document.getElementById("volne");
    prispeli.style.display = "none";
    spravci.style.display = "none";
    starost.style.display = "none";
    var tlacitka = document.getElementsByClassName("prepinac")
    for (let i = 0; i < tlacitka.length; i++) {
        tlacitka[i].classList.remove("active");
    }

    var currentUrl = new URL(window.location.href);
    currentUrl.searchParams.forEach((value, key) => {
        currentUrl.searchParams.delete(key);
    });
    if (event.target.id == "prispeli") {
        var tlacitko = document.getElementById("prispeli");
        tlacitko.classList.add("active");
        prispeli.style.display = "";
        currentUrl.searchParams.set("prispeli", "");
    }
    if (event.target.id == "spravci") {
        var tlacitko = document.getElementById("spravci");
        tlacitko.classList.add("active");
        spravci.style.display = "";
        currentUrl.searchParams.set("spravci", "");
    }
    if (event.target.id == "kamen") {
        var tlacitko = document.getElementById("kamen");
        tlacitko.classList.add("active");
        starost.style.display = "";
        currentUrl.searchParams.set("kamen", "");
    }
    newUrl = currentUrl.toString();
    window.history.replaceState({}, "", newUrl);
>>>>>>> 7414d3c5cb25979073ea471cd9ccf7779ad002b1
}