<template>
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
                            <img id="form_home_flag" v-if="flagfile(matchData.teams.home.id)" :src=flagloc(matchData.teams.home.id)>
                            <img id="form_home_flag" v-else-if="!flagfile()" :src=matchData.teams.home.logo>
                        </td>
                        <td>{{ matchData.teams.home.name }}</td>
                        <td style="width: 35px; text-align: center; font-size: 16px"><span>{{ matchData.goals.home}}</span> - <span>{{ matchData.goals.away }}</span></td>
                        <td style="text-align: right">{{ matchData.teams.away.name }}</td>
                        <td style="text-align: right">
                            <img id="form_away_flag" v-if="flagfile(matchData.teams.away.id)" :src=flagloc(matchData.teams.away.id)>
                            <img id="form_away_flag" v-else-if="!flagfile()" :src=matchData.teams.away.logo>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="form_goals" style="vertical-align: top">
                            <span v-for="goals in ht_goals">
                                {{ goals.time }}' {{ goals.player }} <br>
                            </span>
                        </td>
                        <td></td>
                        <td class="form_goals" style="text-align: right; vertical-align: top">
                            <span v-for="goals in at_goals">
                                {{ goals.player }} {{ goals.time }} <br>
                            </span>
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
                {{ convertdatetime(matchData.fixture.timestamp) }}
            </div>
            <!-- venue content ----------------------------------------------------------------------------------->
            <div class="timedate_header">
                <img src="/images/icons/venue_icon.png" style="margin-top: 4px">
                <span id="venue_title">VENUE</span>
            </div>
            <div class="timedate_content">
                {{ matchData.fixture.venue.name + ', ' + matchData.fixture.venue.city }}
            </div>
            <!-- referee content --------------------------------------------------------------------------------->
            <div class="timedate_header">
                <img src="/images/icons/ref_icon.png" style="margin-top: 4px">
                <span id="ref_title">REFEREE</span>
            </div>
            <div class="timedate_content">
                {{ matchData.fixture.referee }}
            </div>
            <!-- league content ---------------------------------------------------------------------------------->
            <div class="timedate_header">
                <img src="/images/icons/league_icon.png" style="margin-top: 4px">
                <span id="league_title">LEAGUE</span>
            </div>
            <div class="timedate_content">
                {{ matchData.league.name }}{{ matchData.league.round ? ', ' + matchData.league.round : ''}}
            </div>
            <!-- formations content ------------------------------------------------------------------------------>
            <div class="timedate_header">
                <img src="/images/icons/formations_icon.png" style="margin-top: 4px">
                <span id="formation_title">FORMATIONS</span>
            </div>
            <div class="timedate_content">
                <div id="formation_content"><div style="float: left">{{ matchData.lineups[0].formation }}</div><div style="float: right">
                    {{ matchData.lineups[1].formation }}</div></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "goalscorers",
        props: ['matchid'],

        data() {
            return {
                matchData: {},
                goalsArr: [],
                ht_goals: [],
                at_goals: []
            }
        },

        methods: {
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

            getGoals() {
                this.matchData.events.forEach((ele) => {
                    if(ele.type == "Goal") {
                        // check which team scored, hometeam or awayteam?
                        if(ele.team.id === this.matchData.teams.home.id) {
                            this.ht_goals.push({"time": ele.time.elapsed, "player": ele.player.name});
                        }   else {
                            this.at_goals.push({"time": ele.time.elapsed, "player": ele.player.name});
                        }
                    }
                });
            },

            loadGame(e) {
                // get the 10 last matches that correspondents with the form
                axios.get("https://v3.football.api-sports.io/fixtures?id=" + e, {
                    headers: {
                        "X-RapidAPI-Host": process.env.MIX_API_URL,
                        "X-RapidAPI-Key": process.env.MIX_API_KEY
                    }
                }).then((response) => {
                    this.matchData = response.data.response[0];
                    this.getGoals();
                }).catch((error) => {
                    console.log(error);
                });
            },


        },

        created() {
            this.loadGame(this.matchid);
        }

    }
</script>

<style scoped>

    .form_goals {
        font-size: 10px;
        color: #ccc;
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
        border-bottom: 1px solid #ccc;
        height: 150px
    }

    #form_bg_gradient {
        z-index: 9;
        height: inherit;
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
        font-size: 16px;
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

