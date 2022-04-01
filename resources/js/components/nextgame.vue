<template>
    <div id="container">
        <div class="timer_header">
            NEXT MATCH in
            <span id="days">{{ time_days }}d</span>:<span id="hours">{{time_hours }}h</span>:<span id="minutes">{{time_mins }}m</span>:<span id="seconds">{{time_secs }}s</span>
        </div>
        <div class="separator_bar"></div>
    </div>
</template>

<script>
    export default {
        name: "nextgame",
        props: ['teamid'],

        data() {
            return {
                time_days: null,
                time_hours: null,
                time_mins: null,
                time_secs: null
            }
        },

        methods: {
            /*
            *
            * this function will compare current time with a given date and parse it for us to read
            *
            */
            startCountdown(timestamp) {
                // current time
                let date1 = new Date();
                // time for next match
                let date2 = new Date("2022-06-03T18:45:00+00:00");
                // difference between the two, with milliseconds removed
                var diff = (date2 - date1)/1000;
                var diff = Math.abs(Math.floor(diff));
                // how many days
                var days = Math.floor(diff/(24*60*60));
                var leftSec = diff - days * 24*60*60;
                // how many hours
                var hrs = Math.floor(leftSec/(60*60));
                var leftSec = leftSec - hrs * 60*60;
                // how many seconds
                var min = Math.floor(leftSec/(60));
                var leftSec = leftSec - min * 60;
                // make up the time you'll see in the app
                this.time_days = days;
                this.time_hours = hrs;
                this.time_mins = min;
                this.time_secs = leftSec;
            }
        },

        created() {
            //setTimeout(this.startCountdown, 1000);
            //this.startCountdown();
            setInterval(this.startCountdown, 1000);
        },

        computed: {
        }

    }
</script>

<style scoped>
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
</style>
