<template>
<div class="container">
    <div class="home_container">
        <img :src="home_img" v-cloak>
        <span class="countryhome" v-cloak>{{ home_team }}</span>
        <span class="scorehome" v-cloak>{{ home_score}}</span>
    </div>
    <div class="status_container">
        <span class="status" v-cloak>{{ status }}</span>
        <p v-cloak>{{ elapsed + '\'' }}</p>
    </div>
    <div class="away_container">
        <img v-cloak :src=away_img>
        <span class="countryaway" v-cloak>{{ away_team }}</span>
        <span class="scoreaway" v-cloak>{{ away_score }}</span>
    </div>
</div>
</template>

<script>
    export default {
        name: "scoreboard",

        data() {
            return {
                home_team: '',
                away_team: '',
                home_img: '',
                away_img: '',
                home_score: '',
                away_score: '',
                elapsed: '',
                status: ''
            }
        },
        mounted() {
            axios.get("httpsss://v2.api-football.com/fixtures/id/65", {
                headers: {
                    "X-RapidAPI-Host": "api-football-v1.p.rapidapi.com",
                    "X-RapidAPI-Key": "b1ae4a3fca89630148dadaa295a0b5b7"
                }
            }).then((response)=> {
                var data = response.data.api.fixtures[0]

                this.home_team = data.homeTeam.team_name;
                this.away_team = data.awayTeam.team_name;
                this.home_img = data.homeTeam.logo;
                this.away_img = data.awayTeam.logo;
                this.home_score = data.goalsHomeTeam;
                this.away_score = data.goalsAwayTeam;
                this.elapsed = data.elapsed;
                this.status = data.status;
            })
        }
    }
</script>

<style scoped>
    .container {
        background-color: white;
        width: 1100px;
        height: 85px;

    }

    [v-cloak] {
        display: none;
    }

    .home_container {
        width: 250px;
        float: left;
        height: inherit;
        padding: 12px 0 0 12px;
    }

    .home_container img {
        float: left;
        width: 45px;
        height: 45px;
        margin-right: 12px;
    }

    .status_container {
        position: relative;
        float: left;
        width: 600px;
        height: inherit;
        align-content: center;
        padding: 12px 0 0 0;
    }

    .status_container p {
        font-family: 'Roboto', sans-serif;
        font-size: 36px;
        color: #515151;
        width: 50%;
        margin: 0 auto;
        background-color: white;
        text-align: center;
    }

    .away_container {
        width: 250px;
        height: inherit;
        float: right;
        padding: 12px 12px 0 0;
    }

    .away_container img {
        float: right;
        width: 45px;
        height: 45px;
        margin-left: 12px;
    }

    .countryhome {
        display: block;
        float: left;
        font-family: 'Oswald', sans-serif;
        text-transform: uppercase;
        font-size: 20px;
        line-height: 24px;
        color: #515151;
        padding-top: 8px;
    }

    .scoreaway {
        text-align: right;
        display: block;
        float: left;
        font-family: 'Oswald', sans-serif;
        font-size: 72px;
        line-height: 50px;
        color: #515151;
    }

    .countryaway {
        display: block;
        float: right;
        font-family: 'Oswald', sans-serif;
        text-transform: uppercase;
        font-size: 20px;
        line-height: 24px;
        color: #515151;
        padding-top: 8px;
    }

    .scorehome {
        text-align: right;
        display: block;
        float: right;
        font-family: 'Oswald', sans-serif;
        font-size: 72px;
        line-height: 50px;
        color: #515151;
    }

    .status {
        text-align: center;
        background-color: #ccc;
        display: block;
        width: 50%;
        margin: 0 auto;
    }
</style>
