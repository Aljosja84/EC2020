<template>
    <div>
        <div class="scoreboard_comp">
            <scoreboard :data="data"></scoreboard>
        </div>

        <div class="lineup_home">
            <lineup :data="data" team="hometeam"></lineup>
        </div>

        <div class="event_win">
            <events-window :data="data"></events-window>
        </div>

        <div class="lineup_away">
            <lineup :data="data" team="awayteam"></lineup>
        </div>

        <div class="stats_win">
            <stats-win :data="data"></stats-win>
        </div>
    </div>
</template>

<script>
    export default {

        name: "Match",
        props: ['matchid'],
        data() {
            return {
                data: Object,
            }
        },

        mounted() {
            axios.get("https://v2.api-football.com/fixtures/id/" + this.matchid, {
                headers: {
                    "X-RapidAPI-Host": "api-football-v1.p.rapidapi.com",
                    "X-RapidAPI-Key": "b1ae4a3fca89630148dadaa295a0b5b7"
                }
            }).then((response)=> {
                this.data = response.data.api.fixtures[0];
            })
        }
    }
</script>

<style>

</style>
