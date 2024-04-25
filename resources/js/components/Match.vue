<template>
    <div>
        <div class="scoreboard_comp">
            <scoreboard v-bind:data="this.data"></scoreboard>
            <follow-game-button :topmenu="false" :gameId="gameid"></follow-game-button>
        </div>



        <div class="lineup_home">
            <lineup :data="this.data" team="hometeam"></lineup>
        </div>

        <div class="event_win">
            <events-window :data="this.data"></events-window>
        </div>

        <div class="lineup_away">
            <lineup :data="this.data" team="awayteam"></lineup>
        </div>

        <div class="tweets_win">
            <tweets></tweets>
        </div>

        <div class="stats_win">
            <stats-win v-bind:data="this.data"></stats-win>
        </div>
    </div>
</template>

<script>
    export default {

    name: "Match",
    props: ['matchid', 'gameid'],
    data() {
        return {
            data: Object,
            teller: 1,
        }
    },

    methods: { /**
        callData() {
            axios.get("https://v3.football.api-sports.io/fixtures?id=" + this.matchid, {
                headers: {
                    "x-rapidapi-host": process.env.MIX_API_URL,
                    "x-rapidapi-key": process.env.MIX_API_KEY
                }
            }).then((response)=> {
                console.log(response.data.response[0]);
                this.data = response.data.response[0];
                // if match is finished, stop the loading loop
                // as to save api calls.
                let MatchFinished = setInterval(() => {
                    if(this.data.fixture.status.short === 'FT') {
                        console.log('match is done');
                        clearInterval(MatchFinished);
                    }   else {
                        this.callData();
                    }
                }, 15000);
            });
        },
    },

    mounted() {
        this.callData();
        console.log('data is loaded from mounted hook');
        // now refresh every one and a half minute

*/

    }
}
</script>

<style>

</style>
