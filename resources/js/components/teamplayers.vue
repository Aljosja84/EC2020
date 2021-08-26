<template>
    <div class="teamplayers_container">
        <div class="teamplayer_header">
            players<button v-on:click="shuffle">Shuffle</button>
        </div>
        <!-- seperator -->
        <div class="separator_bar"></div>
        <!-- player photos ----------->
        <div id="midfield_div">
            <transition-group name="players_list" tag="ul">
                <span v-for="person in playersArr" :key="person.player.id" class="players_list-item">
                    <img :src=person.player.photo>
                </span>
            </transition-group>
        </div>
        <!-------------------------->
        <div class="player_stats_header"><span>player statistics</span></div>

        <div class="player_stats_container">
            content
        </div>
    </div>
</template>

<script>
    export default {
        name: "teamplayers",
        props: ['teamid'],

        data() {
            return {
                playersArr: []
            }
        },

        methods: {
            loadPlayers(e) {
                // get the players (including qualifiers) from a particular team (e)
                axios.get("https://v3.football.api-sports.io/players?league=4&season=2020&team=" + e, {
                    headers: {
                        "X-RapidAPI-Host": process.env.MIX_API_URL,
                        "X-RapidAPI-Key": process.env.MIX_API_KEY
                    }
                }).then((response) => {
                    response.data.response.forEach((element) => {
                        this.playersArr.push(element);
                    });
                }).catch((error) => {
                    console.log(error);
                });
            },

            shuffle() {
                this.playersArr = _.shuffle(this.playersArr);
            }
        },

        created() {
            this.loadPlayers(this.teamid);
        }
    }
</script>

<style scoped>
    .teamplayers_container {
        position: relative;
        margin-left: -9px;
        background-color: white;
        width: 975px;
        height: 659px
    }

    .teamplayer_header {
        width: 100%;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        color: #515151;
        text-transform: uppercase;
        text-align: center;
        background-image: url("images/light_wool.png");
        padding: 10px 0 8px 15px;
    }

    .player_stats_header {
        position: relative;
        z-index: 15;
        width: 100%;
        height: 35px;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        color: #515151;
        text-transform: uppercase;
        text-align: center;
        line-height: 30px;
        background-image: url("images/light_wool.png");
        padding: 0 0 10px 15px;
        border-top: 1px solid #dcdcdc;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;
    }

    .separator_bar {
        height: 2px;
        background-image: linear-gradient(to right, transparent, #b5b5b5, transparent);
    }

    .players_list-item img {
        width: 75px;
        height: 75px;
        border-radius: 100%;
        box-shadow: rgba(17, 17, 26, 0.35) 0 4px 16px, rgba(17, 17, 26, 0.05) 0 8px 32px;
    }

    #midfield_div {
        height: 188px;
        padding: 10px 5px 0 14px;
        width: 100%;
    }

    .players_list-item {
        transition: all .5s;
        display: inline-block;
        padding: 5px;
        margin-right: 10px;
    }

    .player_stats_container {
        z-index: 14;
        width: 100%;
        height: 380px;
        background: -moz-linear-gradient(180deg, rgba(255,255,255,1) 16%, rgba(255,210,164,1) 100%);
        background: -webkit-linear-gradient(180deg, rgba(255,255,255,1) 16%, rgba(255,210,164,1) 100%);
        background: linear-gradient(180deg, rgba(255,255,255,1) 16%, rgba(255,210,164,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff",endColorstr="#ffd2a4",GradientType=1);
    }
</style>
