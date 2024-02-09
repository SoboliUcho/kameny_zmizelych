function set_height() {
  const win_height = window.innerHeight;
  var nelista = document.getElementById("nelista");
  var lista = document.getElementsByClassName("lista")[0];
  const size_lista = lista.clientHeight;
  var size = (win_height - size_lista) - 2;
  // console.log(size);
  nelista.style.height = `${size}px`
}

function make_map(x, y, zoom) {
  const API_KEY = '-YU-3m6kTF_X0RFCcyIDyMT5EbJixEkzsmz8JlWMoWY';
  var map = L.map('mapa', { zoomControl: false }).setView([y, x], zoom);
  L.tileLayer(`https://api.mapy.cz/v1/maptiles/outdoor/256/{z}/{x}/{y}?apikey=${API_KEY}`, {
    minZoom: 0,
    maxZoom: 19,
    attribution: '<a href="https://api.mapy.cz/copyright" target="_blank">&copy; Seznam.cz a.s. a další</a>',
  }).addTo(map);
  const LogoControl = L.Control.extend({
    options: {
      position: 'bottomleft',
    },

    onAdd: function (map) {
      const container = L.DomUtil.create('div');
      const link = L.DomUtil.create('a', '', container);

      link.setAttribute('href', 'http://mapy.cz/');
      link.setAttribute('target', '_blank');
      link.innerHTML = '<img src="https://api.mapy.cz/img/api/logo.svg" />';
      L.DomEvent.disableClickPropagation(link);

      return container;
    },
  });
  new LogoControl().addTo(map);
  // L.control.scale({
  //   position: 'bottomright', 
  //   imperial: false, 
  //   maxWidth: 200,
  //   updateWhenIdle:true}).addTo(map);
  return map
}

function make_marker(dum) {
  var icon = L.icon({
    iconUrl: 'images/jude3.png',
    iconSize: [30, 59], // size of the icon
    iconAnchor: [15, 59], // point of the icon which will correspond to marker's location
  });
  var adresa = dum.ulice + " " + dum.cislo_domu;
  var marker = L.marker([dum.gps_y, dum.gps_x], { icon: icon, markerId: dum.id }).bindTooltip(adresa);
  marker.on('click', function (event) {
    L.DomEvent.stopPropagation(event);
    // var markerId = this.options.markerId;
    console.log(dum.id);
    // console.log(markerId);
    tabulka_request(dum.id, "people")
  });
  return marker
}

function make_markers(domy, mapa) {
  // var markers = L.markerClusterGroup({
  //   keepSpiderfy: true
  // });
  if (domy == false) {
    return false;
  }
  for (var dum of domy) {
    // markers.addLayer(make_marker(dum))
    make_marker(dum).addTo(mapa)
    console.log(dum);
  }
  // mapa.addLayer(markers);
}

function handleTouchStart(event) {
  event.preventDefault();
  centerX = compass.offsetWidth / 2;
  centerY = compass.offsetHeight / 2;
  isMousePressed = true;
  const touchX = event.clientX - compass.getBoundingClientRect().left - centerX;
  const touchY = event.clientY - compass.getBoundingClientRect().top - centerY;

  const distance = Math.sqrt(touchX * touchX + touchY * touchY);
  const maxDistance = compass.offsetWidth / 2;
  const ratio = Math.min(maxDistance / distance, 1);

  executeFunction(touchX * ratio, touchY * ratio);
}

function handleMouseMove(event) {
  if (event.buttons !== 1) return;
  event.preventDefault();
  const touchX = event.clientX - compass.getBoundingClientRect().left - centerX;
  const touchY = event.clientY - compass.getBoundingClientRect().top - centerY;

  const distance = Math.sqrt(touchX * touchX + touchY * touchY);
  const maxDistance = compass.offsetWidth / 2;
  const ratio = Math.min(maxDistance / distance, 1);

  executeFunction(touchX * ratio, touchY * ratio);
}

function handleMouseUp(event) {
  event.preventDefault();
  isMousePressed = false;
  clearTimeout(timeoutId);
}

function executeFunction(x, y) {
  if (!isMousePressed) return;
  console.log('Function executed with coordinates:', x, y);
  mapa.panBy([x * 5, y * 5], { animate: true });
  timeoutId = setTimeout(executeFunction, 100, x, y);
}