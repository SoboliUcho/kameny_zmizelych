var x = 16.6597287;
var y = 49.4868687;
var zoom = 18;
function make_map(x, y, zoom) {
    var stred = SMap.Coords.fromWGS84(x, y);
    var mapa = new SMap(JAK.gel("mapa"), stred, zoom); // mapa = id div 
    mapa.addDefaultLayer(SMap.DEF_TURIST).enable();
    // mapa.addDefaultLayer(SMap.DEF_BASE)
    // mapa.addDefaultLayer(SMap.DEF_OPHOTO);
    // mapa.addDefaultLayer(SMap.DEF_TURIST_WINTER);
    
    var mouse = new SMap.Control.Mouse(SMap.MOUSE_PAN | SMap.MOUSE_WHEEL | SMap.MOUSE_ZOOM); /* Ovládání myší */
    mapa.addControl(mouse); 
    mapa.addDefaultControls();
    return mapa;
}

function mapa_botom_space(pixels, mapa) {
    var sync = new SMap.Control.Sync({ bottomSpace: pixels });
    mapa.addControl(sync);
}

function make_marker_layer(mapa) {
    var layer = new SMap.Layer.Marker();
    mapa.addLayer(layer);
    return layer;
}

function make_marker(marker_data){
    var coords = SMap.Coords.fromWGS84(marker_data.gps_x, marker_data.gps_y);
    
    var obrazek = "https://api.mapy.cz/img/api/marker/drop-red.png";
    var adresa = marker_data.ulice + " " + marker_data.cislo_domu;
    // console.log (adresa);
    var options = {
        url: obrazek,
        title: adresa,
        anchor: {left:10, bottom: 1},
    };

    var marker = new SMap.Marker(coords, marker_data.id, options);
    var card = new SMap.Card();
// card.getHeader().innerHTML = "<strong>Nadpis</strong>";
// card.getBody().innerHTML = "Ahoj, já jsem <em>obsah vizitky</em>!";
// marker.decorate(SMap.Marker.Feature.Card, card);

    return marker;
}

function make_markers(domy, mapa){
    // console.log("dum");
    var pole_markery = new Array()
    if (domy == false){
        return false;
    }
    for (var dum of domy){
        pole_markery.push(make_marker(dum));
        console.log(dum);
    }
    var layer = make_marker_layer(mapa)
    // var clusterer = new SMap.Marker.Clusterer(mapa, 20);
    // layer.setClusterer(clusterer);
    layer.addMarker(pole_markery);
    layer.enable();
}

function marker_clik(e){
    var marker = e.target;
    var id = marker.getId();
    console.log(id);
}