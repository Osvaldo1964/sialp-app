// Initialize and add the map
let map;

function initMap(){
    let santamarta = { lat: 6.244, lng: -75.580 };
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: santamarta,
    })
};