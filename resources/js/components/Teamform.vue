<template>
    <div class="container" :style="{height: 640 + 'px'}">
        <div class="team_header">
            <img class="header_flag" :src="flag">
            <span>{{details}}</span>
        </div>
        <div id="separator_bar"></div>
        <div class="form_container">
            <span id="form_title">Form</span>
                <span v-for="result in lastTenForm" :key="result.gameid">
                    <a @click="scrollFormWin(result.scrolldiv)" href="#" v-if="result.res === 'W'" class="form_button button_win">{{ result.res }}</a>
                    <a @click="scrollFormWin(result.scrolldiv)" href="#" v-else-if="result.res === 'L'" class="form_button button_lose">{{ result.res }}</a>
                    <a @click="scrollFormWin(result.scrolldiv)" href="#" v-else-if="result.res === 'D'" class="form_button button_draw">{{ result.res }}</a>
                </span>
        </div>
        <div class="last_ten_matches_container" id="form_container">
            <goalscorers v-for="games in lastTenMatchesIds" :matchid="games.match.fixture.id" :key="games.match.fixture.id" :id="games.scrolldiv"></goalscorers>
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
                lastTenMatchesIds: [],
                lastTenForm: [],
                timestamp: null,
                imagesource: null,
            }
        },

        methods: {

            scrollFormWin(e) {
                let y = document.getElementById(e).offsetTop;
                document.getElementById('form_container').scroll({top: y})
            },

            findPos(obj) {
                    var curtop = 0;
                    if (obj.offsetParent) {
                        do {
                            curtop += obj.offsetTop;
                        } while (obj = obj.offsetParent);
                        return [curtop];
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

            whichTeam(e) {
               if(Number(e.teams.home.id) === Number(this.teamid)) {
                   return this.convertResult(e.teams.home.winner);
               }
               return this.convertResult(e.teams.away.winner);
            },

            loadLatestGames(e) {
                // get the 10 last matches that correspondents with the form
                axios.get("https://v3.football.api-sports.io/fixtures?team=" + e + "&last=3", {
                    headers: {
                        "X-RapidAPI-Host": process.env.MIX_API_URL,
                        "X-RapidAPI-Key": process.env.MIX_API_KEY
                    }
                }).then((response) => {
                    let i = 1;
                    response.data.response.forEach((element) => {
                        this.lastTenForm.push({'gameid': element.fixture.id, 'res': this.whichTeam(element), 'scrolldiv':'match'+i});
                        this.lastTenMatchesIds.push({'match':element, 'scrolldiv':'match'+i});
                        i++;
                    });


                }).catch((error) => {
                    console.log(error);
                });
            },

        },

        computed: {

        },

        created() {
            this.loadLatestGames(this.teamid);
        }
    }

</script>

<style scoped>
    .container {
        width: 335px;
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
        position: relative;
        width: 100%;
        height: 557px;
        overflow-y: hidden;
        scroll-behavior: smooth;
    }

    .scoreboard_content table{
        width: 100%;
        border: none;
    }

    .scoreboard_content td {
        border: none;
    }

</style>
