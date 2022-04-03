<template>
    <div id="container">
        <div class="loading_div_nextgame" v-bind:style="doneloading"><div id="pulseloader"/></div>
        <div class="timer_header">
            NEXT MATCH in
            <span id="days">{{ time_days }}d</span>:<span id="hours">{{time_hours }}h</span>:<span id="minutes">{{time_mins }}m</span>:<span id="seconds">{{time_secs }}s</span>
        </div>
        <div class="separator_bar"></div>
        <div id="flag_hometeam"><img :src=countryLogos[0]></div>
        <div id="hometeam_name">{{ hometeam }}</div>
        <div id="versus">vs</div>
        <div id="awayteam_name">{{ awayteam }}</div>
        <div id="flag_awayteam"><img :src=countryLogos[1]></div>
    </div>
</template>

<script>
    export default {
        name: "nextgame",
        props: ['teamid'],

        data() {
            return {
                timeloading: false,
                logoloading: false,
                time_days: null,
                time_hours: null,
                time_mins: null,
                time_secs: null,
                timetowait: null,
                hometeam: null,
                awayteam: null,
                countryLogos: []
            }
        },

        methods: {
            /*
            *
            * this function will compare current time with a given date and parse it for us to read
            * we'll also append an extra 0 if the hours, minutes or seconds get below 10
            *
            */
            startCountdown(timestamp) {
                // current time
                let date1 = new Date();
                // time for next match
                let date2 = new Date(timestamp);
                // difference between the two, with milliseconds removed
                var diff = (date2 - date1)/1000;
                var diff = Math.abs(Math.floor(diff));
                // how many days
                var days = Math.floor(diff/(24*60*60));
                var leftSec = diff - days * 24*60*60;
                // how many hours
                var hrs = Math.floor(leftSec/(60*60));
                if(hrs < 10) { hrs = '0'+hrs };
                var leftSec = leftSec - hrs * 60*60;
                // how many seconds
                var min = Math.floor(leftSec/(60));
                if(min < 10) { min = '0'+min};
                var leftSec = leftSec - min * 60;
                if(leftSec < 10 > 0) { leftSec = '0'+leftSec};
                // make up the time you'll see in the app
                this.time_days = days;
                this.time_hours = hrs;
                this.time_mins = min;
                this.time_secs = leftSec;
                // done setting time
                this.timeloading = true;
            },
            /*
            *
            * Here we'll check for the images to be done loading and remove the loading screen
            *
            */
            imageLoadedCheck() {
                console.log('loading');
                let imageLoaded = 0;
                for (const imageSrc of this.countryLogos) {
                    const img = new Image();
                    img.src = imageSrc;

                    img.onload = () => {
                        imageLoaded++;

                        if(imageLoaded === this.countryLogos.length) {
                            console.log("all country logos have loaded");
                            this.logoloading = true;
                        }
                    }
                }
            },
            /*
            *
            * Limit the number of characters a teamname can have, so it can properly
            * fit in the box, to reduce ugliness of having long names
            */
            limitTeamName(name) {
                let string = name;
                let length = 14;
                return string.length > length ? string.substring(0, length - 3) + "..." : string.substring(0, length);
            },
            /*
            *
            * We'll make a call to the API and ask when the next game is
            * then we'll set the loading icon to off when it's done loading
            *
            */
            loadNextGame(e) {
                // external API call and
                axios.get("https://v3.football.api-sports.io/fixtures?team=" + e + "&next=1", {
                    headers: {
                        "X-RapidAPI-Host": process.env.MIX_API_URL,
                        "X-RapidAPI-Key": process.env.MIX_API_KEY
                    }
                }).then((response) => {
                    this.timetowait = response.data.response[0].fixture.date;
                    this.hometeam = this.limitTeamName(response.data.response[0].teams.home.name);
                    this.awayteam = this.limitTeamName(response.data.response[0].teams.away.name);
                    this.countryLogos.push(response.data.response[0].teams.home.logo);
                    this.countryLogos.push(response.data.response[0].teams.away.logo);
                    this.imageLoadedCheck();
                }).catch((error) => {
                    console.log(error);
                });
            }
        },

        created() {
            //this.loadNextGame(this.teamid);
            setInterval(() => this.startCountdown(this.timetowait), 1000);
        },

        computed: {
            doneloading() {
                if(this.timeloading !== false && this.logoloading !== false) {
                    return {opacity: 0};
                }
            }
        }

    }
</script>

<style scoped>
    #container {
        position: relative;
        z-index:1
    }

    .loading_div_nextgame {
        position: absolute;
        width: 100%;
        height: 138px;
        background-color: whitesmoke;
        z-index: 999;
        opacity: 100%;
        transition: all .2s ease-in;
    }

    #pulseloader {
        z-index: 1000;
        background-image: url("images/pulseloader_3.gif");
        width: 84px;
        height: 84px;
        position: absolute;
        top: 18%;
        left: 45%;
    }
    .timer_header {
        width: 100%;
        height: 55px;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        color: #515151;
        text-align: center;
        background-image: url("images/light_wool.png");
        padding: 9px 0 8px 0;
    }

    .separator_bar {
        height: 2px;
        background-image: linear-gradient(to right, transparent, #b5b5b5, transparent);
    }

    #days {
        color: #e58d37;
    }
    #hours {
        color: #c9d466;
    }
    #minutes {
        color: #c34c26;
    }
    #seconds {
        color: #4cb4e7;
    }

    #flag_hometeam {
        float: left;
        width: 75px;
        height: 100%;
        padding-left: 10px;
        padding-top: 5px;
    }
    #flag_hometeam img {
        height: 65px;
    }
    #hometeam_name {
        float: left;
        font-family: 'Oswald', sans-serif;
        font-size: 1vw;
        color: #515151;
        width: 160px;
        line-height: 75px;
    }
    #versus {
        float: left;
        font-family: 'Oswald', sans-serif;
        text-transform: uppercase;
        font-size: 31px;
        line-height: 75px;
    }
    #awayteam_name {
        float: left;
        text-align: right;
        font-family: 'Oswald', sans-serif;
        font-size: 1vw;
        color: #515151;
        width: 160px;
        line-height: 75px;
    }
    #flag_awayteam {
        float: right;
        width: 75px;
        height: 100%;
        padding-right: 10px;
        padding-top: 5px;
    }
    #flag_awayteam img {
        height: 65px;
    }
</style>
