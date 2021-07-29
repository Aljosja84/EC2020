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
            {{ lastTenMatches }}
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
                form: '',
                lastTenMatches: []
            }
        },

        methods: {
            callData() {
                // get the form info
                axios.get("https://v3.football.api-sports.io/teams/statistics?league=4&season=2020&team=" + this.teamid, {
                    headers: {
                        "X-RapidAPI-Host": process.env.MIX_API_URL,
                        "X-RapidAPI-Key": process.env.MIX_API_KEY
                    }
                }).then((response) => {
                    this.form = response.data.response.form;
                });

                // get the 10 last matches that correspondents with the form
                axios.get("https://v3.football.api-sports.io/fixtures?team=" + this.teamid + "&last=10", {
                    headers: {
                        "X-RapidAPI-Host": process.env.MIX_API_URL,
                        "X-RapidAPI-Key": process.env.MIX_API_KEY
                    }
                }).then((response) => {
                    this.lastTenMatches = response.data.response;
                });
            },
        },

        computed: {
            // get the last ten games of the country/team
            // and put them in an array so they each can be converted to buttons
            lastTenForm: function() {
                return Array.from(this.form.slice(this.form.length - 10));
            }
        },


        mounted() {
            console.log('Component mounted.');
            this.callData();
            //this.form = ["W", "L", "D", "D", "L", "W", "W", "L", "D", "W"];
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
        background-image: url("light_wool.png");
        padding: 10px 0 8px 15px;
    }

    .header_flag {
        height: 45px;
        width: 45px;
        margin-right: 17px;
    }

    .form_container {
        padding: 8px 0 0 5px;
        height: 40px;
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
</style>
