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
    layer.enable();
    return layer;
}

function make_marker(mapa, marker_layer, marker_data){
    var coords = SMap.Coords.fromWGS84(marker_data.coords);
    
    var obrazek = "https://api.mapy.cz/img/api/marker/drop-red.png";

    var options = {
        url: obrazek,
        title: marker_data.adresa,
        anchor: {left:10, bottom: 1}
    }

    var marker = new SMap.Marker(coords, marker_data.id, options);
    marker_layer.addMarker(marker);
    return marker
}

