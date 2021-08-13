<template>
    <div class="teamplayers_container">
        <div class="teamplayer_header">
            players<button v-on:click="shuffle">Shuffle</button>
        </div>
        <!-- seperator -->
        <div id="separator_bar"></div>
        <!-- midfielders ----------->
        <div id="midfield_div">
            <transition-group name="players_list" tag="ul">
                <span v-for="person in playersArr" :key="person.player.id" class="players_list-item">
                    <img :src=person.player.photo>
                </span>
            </transition-group>
        </div>
        <!-------------------------->
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
        margin-left: -9px;
        background-color: white;
        width: 975px;
        height: 557px
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

    #separator_bar {
        height: 2px;
        background-image: linear-gradient(to right, transparent, #b5b5b5, transparent);
    }

    .players_list-item img {
        width: 75px;
        height: 75px;
        border-radius: 100%;
        box-shadow: rgba(17, 17, 26, 0.35) 0px 4px 16px, rgba(17, 17, 26, 0.05) 0px 8px 32px;
    }

    #midfield_div {
        padding: 10px 5px 0 14px;
        width: 100%;
    }

    .players_list-item {
        transition: all .5s;
        display: inline-block;
        padding: 5px;
        margin-right: 10px;
    }
</style>
