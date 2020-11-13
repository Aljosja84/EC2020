<template>
    <div class="container">
        <ul>
            <li class="header">coach</li>
            <li class="non_player">{{ coach }}</li>
            <li class="header">starting XI</li>
            <li v-for="player in players" class="player"><span class="player_number">{{player.number}}</span>{{player.player}}</li>
            <li class="header">substitutes</li>
            <li v-for="player in subs" class="player"><span class="player_number">{{player.number}}</span>{{player.player}}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "lineup",

        props: {
            data: {
                type: Object,
            },
            team: {
                type: String,
            }
        },

        data() {
            return {
                players: [],
                subs: [],
                coach: String,
            }
        },

        watch: {
            data: {
                immediate: true,
                handler() {
                    var team = this.team === 'hometeam' ? this.data.homeTeam.team_name : this.data.awayTeam.team_name;
                    this.players = this.data.lineups[team].startXI;
                    this.subs = this.data.lineups[team].substitutes;
                    this.coach = this.data.lineups[team].coach;

                }
            }
        },

    }
</script>

<style scoped>
    .container {
        background-color: white;
        height: 588px;
        width: 250px;
        overflow-y: auto;
    }

    .header {
        font-family: 'Oswald', sans-serif;
        font-size: 11px;
        line-height: 11px;
        background-color: #f5f7f9;
        color: #515151;
        height: 26px;
        padding: 8px 0 5px 24px;
        border-bottom: 1px solid #e3e7ed;
        text-transform: uppercase;
    }

    .non_player {
        font-family: 'Roboto', sans-serif;
        font-size: 12px;
        line-height: 12px;
        color: #515151;
        border-bottom: 1px solid #e3e7ed;
        height: 26px;
        padding: 7px 0 5px 54px;

    }

    .player {
        font-family: 'Roboto', sans-serif;
        font-size: 12px;
        line-height: 12px;
        color: #515151;
        border-bottom: 1px solid #e3e7ed;
        height: 26px;
        padding: 7px 0 5px 24px;
    }

    .player_number {
        text-align: left;
        display: inline-block;
        color: #9c9fa4;
        min-width: 30px;
    }
</style>
