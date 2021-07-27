<template>
    <div class="container">
        <div class="team_header">
            <img class="header_flag" :src="flag">
            <span>{{details}}</span>
        </div>
        <h1>Form:
            <span v-for="result in lastTenForm" :key="result">
                <a href="#" v-if="result === 'W'" class="form_button button_win">{{ result }}</a>
                <a href="#" v-else-if="result === 'L'" class="form_button button_lose">{{ result }}</a>
                <a href="#" v-else-if="result === 'D'" class="form_button button_draw">{{ result }}</a>
            </span>
        </h1>
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
            }
        },

        methods: {
            callData() {
                axios.get("https://v3.football.api-sports.io/teams/statistics?league=4&season=2020&team=" + this.teamid, {
                    headers: {
                        "X-RapidAPI-Host": "api-football-v1.p.rapidapi.com",
                        "X-RapidAPI-Key": "b1ae4a3fca89630148dadaa295a0b5b7"
                    }
                }).then((response) => {
                    //this.data = response.data.api.fixtures[0];
                    this.form = response.data.response.form;
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
        line-height: 20px;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        color: #515151;
        text-transform: uppercase;
        background-color: lightblue;
        padding: 12px 0 8px 15px;
        vertical-align: middle;
    }

    .header_flag {
        height: 45px;
        width: 45px;
        margin-right: 23px;
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
    }

    .button_win {border-radius: 100%; background-color: green;}
    .button_lose {border-radius: 100%; background-color: red;}
    .button_draw {border-radius: 100%; background-color: grey;}
</style>
