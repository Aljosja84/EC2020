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
 ------------ AMSTERDAM --------------
 */
document.getElementById('AMS').addEventListener('click', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 4.93113, lat: 52.37625 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.3,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

/**
 ------------ GLASGOW --------------
 */
document.getElementById('GLA').addEventListener('click', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: -4.22385, lat: 55.95465 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.3,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

/**
 ------------ BAKU --------------
 */
document.getElementById('BAK').addEventListener('click', function() {
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

/**
 ------------ LONDON --------------
 */
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

/**
 ------------ DUBLIN --------------
 */
document.getElementById('DUB').addEventListener('click', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: -6.32547, lat: 53.51102 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.5,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

/**
 ------------ COPENHAGEN --------------
 */
document.getElementById('COP').addEventListener('click', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 12.58369, lat: 55.73169 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.5,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

/**
 ------------ BUDAPEST --------------
 */
document.getElementById('BUD').addEventListener('click', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 19.08598, lat: 47.58372 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.5,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

/**
 ------------ BUCHAREST --------------
 */
document.getElementById('BUC').addEventListener('click', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 26.16951, lat: 44.48370 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.5,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

/**
 ------------ BILBOA --------------
 */
document.getElementById('BIL').addEventListener('click', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: -2.95899, lat: 43.35881 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.5,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

/**
 ------------ MUNICH --------------
 */
document.getElementById('MUN').addEventListener('click', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 11.54448, lat: 48.19486 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.5,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

/**
 ------------ ROME --------------
 */
document.getElementById('ROM').addEventListener('click', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 12.54566, lat: 41.92128 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.5,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

/**
 ------------ SAINT PETERSBURG --------------
 */
document.getElementById('PET').addEventListener('click', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 30.31600, lat: 59.88792 },
        zoom: 4.84,
        pitch: 0.00,
        bearing: 0.00,
        speed:0.5,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});

/**
 ------------ HOME --------------
 */
document.getElementById('HOME').addEventListener('click', function() {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: { lon: 5.25656, lat: 51.19153 },
        zoom: 4.06,
        pitch: 33.00,
        bearing: 9.54,
        speed:0.5,
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
    });
});
