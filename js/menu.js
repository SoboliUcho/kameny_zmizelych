<<<<<<< HEAD

// console.log("menu")
var menu = document.getElementById("infobox")
var lines = document.getElemenst("line");
var submenu = document.getElementById("sublista")
menu.addEventListener("click", function (event) {
    for (let index = 0; index < lines.length; index++) {
        if (lines[index].classList.contains('ikx'))
        lines[index].classList.toggle('ikx');
    }
    submenu.classList.toggle('iks')
});
=======

// console.log("menu")
var menu = document.getElementById("infobox")
var lines = document.getElemenst("line");
var submenu = document.getElementById("sublista")
menu.addEventListener("click", function (event) {
    for (let index = 0; index < lines.length; index++) {
        if (lines[index].classList.contains('ikx'))
        lines[index].classList.toggle('ikx');
    }
    submenu.classList.toggle('iks')
});
>>>>>>> 7414d3c5cb25979073ea471cd9ccf7779ad002b1
