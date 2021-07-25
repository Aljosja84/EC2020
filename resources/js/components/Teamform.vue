<template>
    <div class="container">
        <h1>{{details}}</h1>
        <h1><img :src="flag"></h1>
        <h1>Form: {{ lastTenForm[4] }}</h1>
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
    }
</style>
