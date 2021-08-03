<template>
    <div class="container">
        <div class="team_header">
            <img class="header_flag" :src="flag">
            <span>{{details}}</span>
        </div>
        <div id="separator_bar"></div>
        <div class="form_container">
            <span id="form_title">Form</span>
                <span v-for="result in lastTenForm" :key="result">
                    <a href="#" v-if="result === 'W'" class="form_button button_win">{{ result }}</a>
                    <a href="#" v-else-if="result === 'L'" class="form_button button_lose">{{ result }}</a>
                    <a href="#" v-else-if="result === 'D'" class="form_button button_draw">{{ result }}</a>
                </span>
        </div>
        <div class="last_ten_matches_container">
            <div class="form_game_container">
                <div class="scoreboard_header">
                    <img id="scoreboard_icon" src="/images/icons/scoreboard_icon.png">
                    <span id="scoreboard_title">SCOREBOARD</span>
                </div>
                <div id="form_bg_gradient">
                    <!-- scoreboard content ------------------------------------------------------------------------------>
                    <div class="scoreboard_content">
                        <table class="form_table">
                            <tr>
                                <td>
                                    <img id="form_home_flag" v-if="flagfile(lastTenMatches.teams.home.id)" :src=flagloc(lastTenMatches.teams.home.id)>
                                    <img id="form_home_flag" v-else-if="!flagfile()" :src=lastTenMatches.teams.home.logo>
                                </td>
                                <td>{{ lastTenMatches.teams.home.name }}</td>
                                <td style="width: 35px; text-align: center; font-size: 16px"><span>{{ lastTenMatches.goals.home}}</span> - <span>{{ lastTenMatches.goals.away }}</span></td>
                                <td style="text-align: right">{{ lastTenMatches.teams.away.name }}</td>
                                <td style="text-align: right">
                                    <img id="form_away_flag" v-if="flagfile(lastTenMatches.teams.away.id)" :src=flagloc(lastTenMatches.teams.away.id)>
                                    <img id="form_away_flag" v-else-if="!flagfile()" :src=lastTenMatches.teams.away.logo>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="form_goals" style="vertical-align: top">
                                    21’ Onni Valakari<br>
                                    66’ J. Pohjanpalo
                                </td>
                                <td></td>
                                <td class="form_goals" style="text-align: right; vertical-align: top">
                                    Ferran Torres ‘7<br>
                                    Ferran Torres’ 14<br>
                                    Gerard Moreno ‘51<br>
                                    Fabián Ruiz ’88
                                </td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                    <!-- time & date content ----------------------------------------------------------------------------->
                    <div class="timedate_header">
                        <img src="/images/icons/timedate_icon.png" style="margin-top: 4px">
                        <span id="timedate_title">DATE AND TIME</span>
                    </div>
                    <div class="timedate_content">
                        {{ convertdatetime(lastTenMatches.fixture.timestamp) }}
                    </div>
                    <!-- venue content ----------------------------------------------------------------------------------->
                    <div class="timedate_header">
                        <img src="/images/icons/venue_icon.png" style="margin-top: 4px">
                        <span id="venue_title">VENUE</span>
                    </div>
                    <div class="timedate_content">
                        {{ lastTenMatches.fixture.venue.name + ', ' + lastTenMatches.fixture.venue.city }}
                    </div>
                    <!-- referee content --------------------------------------------------------------------------------->
                    <div class="timedate_header">
                        <img src="/images/icons/ref_icon.png" style="margin-top: 4px">
                        <span id="ref_title">REFEREE</span>
                    </div>
                    <div class="timedate_content">
                        {{ lastTenMatches.fixture.referee }}
                    </div>
                    <!-- league content ---------------------------------------------------------------------------------->
                    <div class="timedate_header">
                        <img src="/images/icons/league_icon.png" style="margin-top: 4px">
                        <span id="league_title">LEAGUE</span>
                    </div>
                    <div class="timedate_content">
                        {{ whoscored }}
                    </div>
                    <!-- formations content ------------------------------------------------------------------------------>
                    <div class="timedate_header">
                        <img src="/images/icons/formations_icon.png" style="margin-top: 4px">
                        <span id="formation_title">FORMATIONS</span>
                    </div>
                    <div class="timedate_content">
                        <div id="formation_content"><div style="float: left">4-3-3</div><div style="float: right">
                            {{ whoscored[718242] }}</div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Teamform",
        props: ['details', 'flag', 'teamid'],

        data() {
            return {
                formArr: [],
                data: Object,
                lastTenMatches: [],
                lastTenForm: [],
                timestamp: null,
                imagesource: null,
                whoscored: {}
            }
        },

        methods: {
            // get an array of goals scored in a particular match for the home or away team.
            whoScored(e) {
                // get the 10 last matches that correspondents with the form
                axios.get("https://v3.football.api-sports.io/fixtures/events?fixture=" + e + "&type=Goal", {
                    headers: {
                        "X-RapidAPI-Host": process.env.MIX_API_URL,
                        "X-RapidAPI-Key": process.env.MIX_API_KEY
                    }
                }).then((response) => {
                    this.whoscored[e] = response.data.response;
                });
            },

            flagloc(e) {
                // return the proper format of the file path
                return "/images/country_flags/" + e + ".png";
            },

            flagfile(e) {
                // check if the flag .png exists, if not -> use the lesser quality api png
                var xhr = new XMLHttpRequest();
                xhr.open('HEAD', "/images/country_flags/" + e + ".png", false);
                xhr.send();

                if(xhr.status == "404") {
                    return false;
                }   else {
                    return true
                }
            },

            convertResult(e) {
                // we convert a boolean value on the 'winner' field to a W L D value
                let result;
                switch(e) {
                    case true:
                        result = "W";
                        break;
                    case false:
                        result = "L";
                        break;
                    case null:
                        result = "D";
                        break;
                }
                return result;
            },

            sayHello() {
                // Say cheeeeeese :D
                return 'Hello';
            },

            convertdatetime(e) {
                // Months array
                var months_arr = ['January','February','March','April','May','June','July','August','September','October','November','December'];
                // Day array
                var days_arr = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                // Convert timestamp to milliseconds
                var date = new Date(e*1000);
                // Year
                var year = date.getFullYear();
                // Month
                var month = months_arr[date.getMonth()];
                // Day
                var day = date.getDate();
                // Name of day
                var dayOfWeek = days_arr[date.getDay()];
                // Hours
                var hours = date.getHours();
                // Minutes
                var minutes = "0" + date.getMinutes();
                // final date
                return dayOfWeek + ' ' + month + ' ' + day + ' ' + year + ' - ' + hours + ':' + minutes
            },

            whichTeam(e) {
               if(Number(e.teams.home.id) === Number(this.teamid)) {
                   return this.convertResult(e.teams.home.winner);
               }
               return this.convertResult(e.teams.away.winner);
            },


        },

        computed: {

        },


        mounted() {
            // get the 10 last matches that correspondents with the form
            axios.get("https://v3.football.api-sports.io/fixtures?team=" + this.teamid + "&last=10", {
                headers: {
                    "X-RapidAPI-Host": process.env.MIX_API_URL,
                    "X-RapidAPI-Key": process.env.MIX_API_KEY
                }
            }).then((response) => {
                response.data.response.forEach(element => this.lastTenForm.push(this.whichTeam(element)));
                this.lastTenMatches = response.data.response[0];
                this.whoScored(response.data.response[0].fixture.id);
            });

        }
    }
</script>

<style scoped>
    .container {
        width: 335px;
        height: 610px;
        background-color: white;
        float: left;
        margin-left: -9px;
    }

    .team_header {
        display: inline-flex;
        width: 100%;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        color: #515151;
        text-transform: uppercase;
        background-image: url("images/light_wool.png");
        padding: 10px 0 8px 15px;
    }

    .header_flag {
        height: 45px;
        width: 45px;
        margin-right: 17px;
    }

    .form_container {
        padding: 4px 0 0 16px;
        height: 38px;
        border-bottom: 1px solid #ccc;
        font-family: 'Oswald', sans-serif;
        font-size: 18px;
        text-transform: uppercase;
        color: #515151;
    }

    #form_title {
        vertical-align: middle;
    }

    .form_button {
        min-width: 23px;
        min-height: 23px;
        max-width: 23px;
        max-height: 23px;
        font-family: "Roboto", sans-serif;
        font-size: 11px;
        background-color: #04AA6D;
        border: none;
        color: white;
        padding: 6px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        margin: 4px 2px;
        box-shadow: rgba(0, 0, 0, 0.18) 0px 5px 15px;
    }

    .button_win {border-radius: 100%; background-color: #6bab4f;}
    .button_lose {border-radius: 100%; background-color: #e83434;}
    .button_draw {border-radius: 100%; background-color: lightgray;}

    #separator_bar {
        height: 2px;
        background-image: linear-gradient(to right, transparent, #b5b5b5, transparent);
    }

    .last_ten_matches_container {
        width: 100%;
        height: inherit;
    }

    .scoreboard_header {
        position: relative;
        z-index: 10;
        background-image: url("images/light_wool.png");
        padding: 6px 0 4px 16px;
        border-top: 1px solid whitesmoke;
        border-bottom: 1px solid #ccc;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;
    }

    #scoreboard_icon {

    }

    #scoreboard_title {
        padding-left: 20%;
        font-family: 'Oswald', sans-serif;
        font-size: 25px;
        font-weight: inherit;
        line-height: 24px;
        vertical-align: top;
        color: #c9d466;
    }

    .scoreboard_content {
        padding: 12px 16px 6px 16px;
        border-bottom: 1px solid #ccc
    }

    #form_bg_gradient {
        z-index: 9;
        height: 466px;
        background: rgb(255,255,255);
        background: linear-gradient(180deg, rgba(255,255,255,1) 16%, rgba(187,236,239,1) 100%);
    }



    .scoreboard_content table{
        width: 100%;
        border: none;
    }

    .scoreboard_content td {
        border: none;
    }

    .form_table {
        font-family: "Roboto", sans-serif;
        font-size: 14px;
        color: #515151;
    }
    #form_home_flag {
        width: 22px;
        height: 22px;
        border-radius: 100%;
    }

    #form_away_flag {
        width: 22px;
        height: 22px;
        border-radius: 100%;
    }

    .form_goals {
        font-family: "Roboto", sans-serif;
        font-size: 11px;
        color: #c6c4c4;
    }

    .timedate_header {
        padding: 0 16px 6px 16px;
        line-height: 1px;
        height: 35px;
        border-bottom: 1px solid #ccc;
        vertical-align: middle;
    }

    #timedate_title {
         padding-left: 20%;
         font-family: 'Oswald', sans-serif;
         font-size: 24px;
         font-weight: inherit;
         color: #ba7fb1;
     }
    #venue_title {
        padding-left: 30%;
        vertical-align: top;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        font-weight: inherit;
        color: #67bee9;
        line-height: 32px;
    }
    #ref_title {
        padding-left: 25%;
        vertical-align: top;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        font-weight: inherit;
        color: #e58d37;
        line-height: 32px;
    }
    #league_title {
        padding-left: 30%;
        vertical-align: text-top;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        font-weight: inherit;
        color: #c34c26;
    }
    #formation_title {
        padding-left: 20%;
        vertical-align: text-top;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        font-weight: inherit;
        color: #297c9b;
    }

    .timedate_content {
        padding: 8px 16px 4px 16px;
        border-bottom: 1px solid #ccc;
        text-align: center;
        font-family: "Roboto", sans-serif;
        font-size: 14px;
        color: #515151;
        height: 38px;
    }
</style>
