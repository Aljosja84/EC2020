<template>
    <div class="form_game_container" :id="matchid">
        <div class="scoreboard_header">
            <img id="scoreboard_icon" src="/images/icons/scoreboard_icon.png">
            <span id="scoreboard_title">SCOREBOARD</span>
        </div>
        <div id="form_bg_gradient">
            <!-- scoreboard content ------------------------------------------------------------------------------>
            <div class="scoreboard_content" v-if="loaded">
                <table class="form_table">
                    <tr>
                        <td>
                            <img id="form_home_flag" :src=matchData.teams.home.logo>
                        </td>
                        <td>{{ matchData.teams.home.name }}</td>
                        <td style="width: 35px; text-align: center; font-size: 16px"><span>{{ matchData.goals.home}}</span> - <span>{{ matchData.goals.away }}</span></td>
                        <td style="text-align: right">{{ matchData.teams.away.name }}</td>
                        <td style="text-align: right">
                            <img id="form_away_flag" :src=matchData.teams.away.logo>
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
                <img src="/images/icons/timedate_icon.png">
                <span id="timedate_title">date and time</span>
            </div>
            <div class="timedate_content" v-if="loaded">
                {{ convertdatetime(matchData.fixture.timestamp) }}
            </div>
            <!-- venue content ----------------------------------------------------------------------------------->
            <div class="timedate_header">
                <img src="/images/icons/venue_icon.png" style="margin-top: 4px">
                <span id="venue_title">venue</span>
            </div>
            <div class="timedate_content" v-if="loaded">
                {{ matchData.fixture.venue.name + ', ' + matchData.fixture.venue.city }}
            </div>
            <!-- referee content --------------------------------------------------------------------------------->
            <div class="timedate_header">
                <img src="/images/icons/ref_icon.png" style="margin-top: 4px">
                <span id="ref_title">referee</span>
            </div>
            <div class="timedate_content" v-if="loaded">
                {{ matchData.fixture.referee }}
            </div>
            <!-- league content ---------------------------------------------------------------------------------->
            <div class="timedate_header">
                <img src="/images/icons/league_icon.png" style="margin-top: 4px">
                <span id="league_title">league</span>
            </div>
            <div class="timedate_content" v-if="loaded">
                <div id="formation_content" v-if="loaded">
                    <div>{{ matchData.league.name }}{{ matchData.league.round ? ', ' + matchData.league.round : ''}}</div>
                </div>
            </div>
            <!-- formations content ------------------------------------------------------------------------------>
            <div class="timedate_header">
                <img src="/images/icons/formations_icon.png" style="margin-top: 4px">
                <span id="formation_title">formations</span>
            </div>
            <div class="timedate_content">
                <div id="formation_content" v-if="loaded">
                    <div style="float: left">{{ matchData.lineups[0].formation }}</div>
                    <div style="float: right">{{ matchData.lineups[1].formation }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "goalscorers",
        props: ['matchid', 'match', 'id'],

        data() {
            return {
                matchData: {},
                goalsArr: [],
                ht_goals: [],
                at_goals: [],
                loaded: false
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
                var minutes = date.getMinutes();
                // if less than 2 digits remain, add a zero
                if(minutes < 10) { minutes = '0' + minutes }
                // final date
                return dayOfWeek + ' ' + month + ' ' + day + ' ' + year + ' - ' + hours + ':' + minutes
            },

            getGoals(e) {
                this.matchData.events.forEach((ele) => {
                    if(ele.type === "Goal") {
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
                // for some reason this request gave a CORS header error
                // so we have to manually delete the X-Socket-Id header for this one.
                    transformRequest: [function (data, headers) {
                        delete headers['X-Socket-Id'];
                        return data;
                    }],
                    headers: {
                        "X-RapidAPI-Host": process.env.MIX_API_URL,
                        "X-RapidAPI-Key": process.env.MIX_API_KEY
                    }
                }).then((response) => {
                    // set all match data
                    this.matchData = response.data.response[0];
                    // see who scored and when
                    this.getGoals();
                    // all data has been loaded
                    this.loaded = true;
                    // tell parent window to scroll to right location
                    this.$parent.scrollFormWin(this.matchid);
                }).catch((error) => {
                    console.log(error);
                });
            },


        },

        created() {
            if(this.match === 1) {
                this.loadGame(this.matchid);
            }
        }

    }
</script>

<style scoped>

    .form_game_container {
        width: 335px;
        min-height: 557px;
    }

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
        height: 154px
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
        padding: 0 16px 0 16px;
        line-height: 35px;
        height: 36px;
        border-bottom: 1px solid #ccc;
    }

    #timedate_title {
        padding-left: 20%;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        font-weight: inherit;
        color: #ba7fb1;
        text-transform: uppercase;
    }
    #venue_title {
        padding-left: 30%;
        vertical-align: top;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        font-weight: inherit;
        color: #67bee9;
        line-height: 32px;
        text-transform: uppercase;
    }
    #ref_title {
        padding-left: 25%;
        vertical-align: top;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        font-weight: inherit;
        color: #e58d37;
        line-height: 32px;
        text-transform: uppercase;
    }
    #league_title {
        padding-left: 30%;
        vertical-align: text-top;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        font-weight: inherit;
        color: #c34c26;
        line-height: 4px;
        text-transform: uppercase;
    }
    #formation_title {
        padding-left: 20%;
        vertical-align: text-bottom;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        font-weight: inherit;
        color: #297c9b;
        text-transform: uppercase;
    }

    .timedate_content {
        padding: 0 16px 0 16px;
        border-bottom: 1px solid #ccc;
        text-align: center;
        font-family: "Roboto", sans-serif;
        font-size: 14px;
        color: #515151;
        height: 35px;
        line-height: 35px;
    }

</style>

