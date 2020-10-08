mapboxgl.accessToken = 'pk.eyJ1IjoiYWxqb3NqYTg0IiwiYSI6ImNrN2RobzM0ZTA5ZGUzb253YnFlZDZ2M3gifQ.3E9_BSsxKdqU25O8R7KOpg';
var map = new mapboxgl.Map({
    container: 'map_background',
    style: 'mapbox://styles/aljosja84/ck7dhypob0y6l1ikby7qeq2zu',
    center: { lon: 5.25656, lat: 51.19153 },
    zoom: 4.06,
    pitch: 33.00,
    bearing: 9.54,
    interactive: false
});

/**
 *
 * @type {{features: [{geometry: {coordinates: number[], type: string}, type: string, properties: {iconSize: number[], message: string}}, {geometry: {coordinates: number[], type: string}, type: string, properties: {iconSize: number[], message: string}}, {geometry: {coordinates: number[], type: string}, type: string, properties: {iconSize: number[], message: string}}], type: string}}
 */
/** ------------------------------ SOCCER ICON LOCATIONS -------------------------- */
var geojson = {
    'type': 'FeatureCollection',
    'features': [
        {
            'type': 'Feature',
            'properties': {
                'message': 'AMS',
                'iconSize': [35, 35]
            },
            'geometry': {
                'type': 'Point',
                'coordinates': [4.93113, 52.37625]
            }
        },
        {
            'type': 'Feature',
            'properties': {
                'message': 'GLA',
                'iconSize': [35, 35]
            },
            'geometry': {
                'type': 'Point',
                'coordinates': [-4.22385, 55.95465]
            }
        },
        {
            'type': 'Feature',
            'properties': {
                'message': 'BAK',
                'iconSize': [35, 35]
            },
            'geometry': {
                'type': 'Point',
                'coordinates': [49.76447, 40.50385]
            }
        },
        {
            'type': 'Feature',
            'properties': {
                'message': 'DUB',
                'iconSize': [35, 35]
            },
            'geometry': {
                'type': 'Point',
                'coordinates': [-6.32547, 53.51102]
            }
        },
        {
            'type': 'Feature',
            'properties': {
                'message': 'COP',
                'iconSize': [35, 35]
            },
            'geometry': {
                'type': 'Point',
                'coordinates': [12.58369, 55.73169]
            }
        },
        {
            'type': 'Feature',
            'properties': {
                'message': 'BUD',
                'iconSize': [35, 35]
            },
            'geometry': {
                'type': 'Point',
                'coordinates': [19.08598, 47.58372]
            }
        },
        {
            'type': 'Feature',
            'properties': {
                'message': 'BUC',
                'iconSize': [35, 35]
            },
            'geometry': {
                'type': 'Point',
                'coordinates': [26.16951, 44.48370]
            }
        },
        {
            'type': 'Feature',
            'properties': {
                'message': 'BIL',
                'iconSize': [35, 35]
            },
            'geometry': {
                'type': 'Point',
                'coordinates': [-2.95899, 43.35881]
            }
        },
        {
            'type': 'Feature',
            'properties': {
                'message': 'MUN',
                'iconSize': [35, 35]
            },
            'geometry': {
                'type': 'Point',
                'coordinates': [11.54448, 48.19486]
            }
        },
        {
            'type': 'Feature',
            'properties': {
                'message': 'ROM',
                'iconSize': [35, 35]
            },
            'geometry': {
                'type': 'Point',
                'coordinates': [12.54566, 41.92128]
            }
        },
        {
            'type': 'Feature',
            'properties': {
                'message': 'PET',
                'iconSize': [35, 35]
            },
            'geometry': {
                'type': 'Point',
                'coordinates': [30.31600, 59.88792]
            }
        },
        {
            'type': 'Feature',
            'properties': {
                'message': 'BRU',
                'iconSize': [35, 35]
            },
            'geometry': {
                'type': 'Point',
                'coordinates': [4.35233, 50.85139]
            }
        },

    ]
};

/**
 ------------ AMSTERDAM --------------
 */
document.getElementById('AMS').addEventListener('mouseover', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 4.93113, lat: 52.37625 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.7,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

document.getElementById('AMS').addEventListener('mouseout', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 5.25656, lat: 51.19153 },
        zoom: 4.06,
        pitch: 33.00,
        bearing: 9.54,
        speed:0.8,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

/**
 ------------ GLASGOW --------------
 */
document.getElementById('GLA').addEventListener('mouseover', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: -4.22385, lat: 55.95465 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.7,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

document.getElementById('GLA').addEventListener('mouseout', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 5.25656, lat: 51.19153 },
        zoom: 4.06,
        pitch: 33.00,
        bearing: 9.54,
        speed:0.8,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});
/**
 ------------ BAKU --------------
 */
document.getElementById('BAK').addEventListener('mouseover', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 49.76447, lat: 40.50385 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.7,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

document.getElementById('BAK').addEventListener('mouseout', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 5.25656, lat: 51.19153 },
        zoom: 4.06,
        pitch: 33.00,
        bearing: 9.54,
        speed:0.8,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});
/**
 ------------ LONDON --------------
 */
/*
document.getElementById('LON').addEventListener('click', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: -0.28201, lat: 51.59977 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.5,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});
*/
/**
 ------------ DUBLIN --------------
 */
document.getElementById('DUB').addEventListener('mouseover', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: -6.32547, lat: 53.51102 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.7,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

document.getElementById('DUB').addEventListener('mouseout', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 5.25656, lat: 51.19153 },
        zoom: 4.06,
        pitch: 33.00,
        bearing: 9.54,
        speed:0.8,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});
/**
 ------------ COPENHAGEN --------------
 */
document.getElementById('COP').addEventListener('mouseover', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 12.58369, lat: 55.73169 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.7,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

document.getElementById('COP').addEventListener('mouseout', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 5.25656, lat: 51.19153 },
        zoom: 4.06,
        pitch: 33.00,
        bearing: 9.54,
        speed:0.8,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});
/**
 ------------ BUDAPEST --------------
 */
document.getElementById('BUD').addEventListener('mouseover', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 19.08598, lat: 47.58372 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.7,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

document.getElementById('BUD').addEventListener('mouseout', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 5.25656, lat: 51.19153 },
        zoom: 4.06,
        pitch: 33.00,
        bearing: 9.54,
        speed:0.8,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});
/**
 ------------ BUCHAREST --------------
 */
document.getElementById('BUC').addEventListener('mouseover', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 26.16951, lat: 44.48370 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.7,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

document.getElementById('BUC').addEventListener('mouseout', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 5.25656, lat: 51.19153 },
        zoom: 4.06,
        pitch: 33.00,
        bearing: 9.54,
        speed:0.8,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});
/**
 ------------ BILBOA --------------
 */
document.getElementById('BIL').addEventListener('mouseover', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: -2.95899, lat: 43.35881 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.7,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

document.getElementById('BIL').addEventListener('mouseout', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 5.25656, lat: 51.19153 },
        zoom: 4.06,
        pitch: 33.00,
        bearing: 9.54,
        speed:0.8,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});
/**
 ------------ MUNICH --------------
 */
document.getElementById('MUN').addEventListener('mouseover', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 11.54448, lat: 48.19486 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.7,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

document.getElementById('MUN').addEventListener('mouseout', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 5.25656, lat: 51.19153 },
        zoom: 4.06,
        pitch: 33.00,
        bearing: 9.54,
        speed:0.8,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});
/**
 ------------ ROME --------------
 */
document.getElementById('ROM').addEventListener('mouseover', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 12.54566, lat: 41.92128 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.7,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

document.getElementById('ROM').addEventListener('mouseout', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 5.25656, lat: 51.19153 },
        zoom: 4.06,
        pitch: 33.00,
        bearing: 9.54,
        speed:0.8,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});
/**
 ------------ SAINT PETERSBURG --------------
 */
document.getElementById('PET').addEventListener('mouseover', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 30.31600, lat: 59.88792 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.7,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

document.getElementById('PET').addEventListener('mouseout', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 5.25656, lat: 51.19153 },
        zoom: 4.06,
        pitch: 33.00,
        bearing: 9.54,
        speed:0.8,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});
/**
 ------------ BRUSSELS --------------
 */
document.getElementById('BRU').addEventListener('mouseover', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 4.35233, lat: 50.85139 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.7,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

document.getElementById('BRU').addEventListener('mouseout', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 5.25656, lat: 51.19153 },
        zoom: 4.06,
        pitch: 33.00,
        bearing: 9.54,
        speed:0.8,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});


// add markers to map
geojson.features.forEach(function (marker) {
// create a DOM element for the marker
    var el = document.createElement('div');
    el.className = 'marker';
    el.style.backgroundImage =
        'url(images/soccer_icon.png)';
    el.style.width = marker.properties.iconSize[0] + 'px';
    el.style.height = marker.properties.iconSize[1] + 'px';
    /*
    el.addEventListener('click', function () {
        window.alert(marker.properties.message);
    });
    */
// add marker to map
    new mapboxgl.Marker(el)
        .setLngLat(marker.geometry.coordinates)
        .addTo(map);
});

