var lekker = document.getElementById('games_container');
var formScroll = document.getElementsByClassName('last_ten_matches_container');
// Define the offset of the calendar
var offsetX = 190;
// Define all x positions of playdate divs
var june11 = document.getElementById('june11').getBoundingClientRect().x;
var june12 = document.getElementById('june12').getBoundingClientRect().x;
var june13 = document.getElementById('june13').getBoundingClientRect().x;
var june14 = document.getElementById('june14').getBoundingClientRect().x;
var june15 = document.getElementById('june15').getBoundingClientRect().x;
var june16 = document.getElementById('june16').getBoundingClientRect().x;
var june17 = document.getElementById('june17').getBoundingClientRect().x;
var june18 = document.getElementById('june18').getBoundingClientRect().x;
var june19 = document.getElementById('june19').getBoundingClientRect().x;
var june20 = document.getElementById('june20').getBoundingClientRect().x;
var june21 = document.getElementById('june21').getBoundingClientRect().x;
var june22 = document.getElementById('june22').getBoundingClientRect().x;
var june23 = document.getElementById('june23').getBoundingClientRect().x;
var june26 = document.getElementById('june26').getBoundingClientRect().x;
var june27 = document.getElementById('june27').getBoundingClientRect().x;
var june28 = document.getElementById('june28').getBoundingClientRect().x;
var june29 = document.getElementById('june29').getBoundingClientRect().x;
// July
var july2 = document.getElementById('july2').getBoundingClientRect().x;
var july3 = document.getElementById('july3').getBoundingClientRect().x;
var july6 = document.getElementById('july6').getBoundingClientRect().x;
var july7 = document.getElementById('july7').getBoundingClientRect().x;
var july11 = document.getElementById('july11').getBoundingClientRect().x;

// This function will scroll to the desired playdate
function scrollWin(waarheen) {
    lekker.scroll(waarheen-offsetX, 0);
}


(function() {
    function scrollHorizontally(e) {
        e = window.event || e;
        var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
        // Multiplied by 400 so the scroll snapping is active and noticable
        document.getElementById('games_container').scrollLeft -= (delta * 400);
        // Prevent it from scroll vertically
        e.preventDefault();
    }
    if (document.getElementById('games_container').addEventListener) {
        // IE9, Chrome, Safari, Opera
        document.getElementById('games_container').addEventListener('mousewheel', scrollHorizontally, false);
        // Firefox
        document.getElementById('games_container').addEventListener('DOMMouseScroll', scrollHorizontally, false);
    } else {
        // IE 6/7/8
        document.getElementById('games_container').attachEvent('onmousewheel', scrollHorizontally);
    }
})();
