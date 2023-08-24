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
    var options = {
        url: obrazek,
        title: adresa,
        anchor: {left:10, bottom: 1}
    }

    var marker = new SMap.Marker(coords, marker_data.id, options);
    return marker
}

function make_markers(domy, mapa){
    var pole_markery = new Array()
    if (domy == false){
        return false;
    }
    for (var dum of domy){
        pole_markery.push(make_marker(dum))
    }
    var layer = make_marker_layer(mapa)
    var clusterer = new SMap.Marker.Clusterer(mapa);
    layer.setClusterer(clusterer);
    layer.addMarker(pole_markery);
    mapa.addLayer(layer).enable();
}