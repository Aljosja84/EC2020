<template>
    <div class="container">
        <div class="team_header">
            <img class="header_flag" :src="flag">
            <span>{{details}}</span>
        </div>
        <div id="separator_bar"></div>
        <div class="form_container">
            <span id="form_title">Form:</span>
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
                    inhoud
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
            }
        },

        methods: {
            convertResult(e) {
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
                alert('Hello')
            },

            whichTeam(e) {
               if(Number(e.teams.home.id) === Number(this.teamid)) {
                   return this.convertResult(e.teams.home.winner);
               }
               return this.convertResult(e.teams.away.winner);
            }
        },

        computed: {

        },


        mounted() {
            /*
            // get the 10 last matches that correspondents with the form
            axios.get("https://v3.football.api-sports.io/fixtures?team=" + this.teamid + "&last=10", {
                headers: {
                    "X-RapidAPI-Host": process.env.MIX_API_URL,
                    "X-RapidAPI-Key": process.env.MIX_API_KEY
                }
            }).then((response) => {
                response.data.response.forEach(element => this.lastTenForm.push(this.whichTeam(element)));
            });


             */

        }
    }
</script>

<style scoped>
    .container {
        width: 335px;
        height: 610px;
        background-color: white;
        padding: 0;
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
        padding: 4px 0 0 5px;
        height: 40px;
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

    #form_bg_gradient {
        z-index: 9;
        height: 464px;
        background: rgb(255,255,255);
        background: linear-gradient(180deg, rgba(255,255,255,1) 16%, rgba(187,236,239,1) 100%);
    }
</style>
