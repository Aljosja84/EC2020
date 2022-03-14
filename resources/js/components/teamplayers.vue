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
            <div class="player_passport">
                <div class="card">
                    <div class="header" id="header-blur">Denzel Justus Morris Dumfries</div>
                    <div class="avatar">
                        <img src="/images/player_example.png" alt="" />
                    </div>
                    <div class="content">
                        <div class="content_header">AGE</div>
                        <table style="margin-top: 8px">
                            <tr>
                                <td style="width: 80px; height: 20px; padding-left: 6px">born</td><td>16-07-1984 (37)</td>
                            </tr>
                            <tr>
                                <td style="width: 80px; height: 20px; padding-left: 6px">birthplace</td><td>Rotterdam, The Netherlands</td>
                            </tr>
                            <tr>
                                <td style="width: 80px; height: 20px; padding-left: 6px">squad rank</td>
                                <td style="vertical-align: top; width: 155px">
                                    <!-- loading bar disguised as a rank bar -->
                                    <div class="progress_left">
                                        <div class="bar_left" :style="{width: bar_per_1+'%'}"></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div class="content_header">PHYSICAL</div>
                        <table style="margin-top: 8px">
                            <tr>
                                <td style="width: 80px; height: 20px; padding-left: 6px">height</td><td>188cm</td>
                            </tr>
                            <tr>
                                <td style="width: 80px; height: 20px; padding-left: 6px">squad rank</td>
                                <td style="vertical-align: top; width: 155px">
                                    <!-- loading bar disguised as a rank bar -->
                                    <div class="progress_left">
                                        <div class="bar_left" :style="{width: bar_per_2+'%'}"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 80px; height: 20px; padding-left: 6px">weight</td><td>89kg</td>
                            </tr>
                            <tr>
                                <td style="width: 80px; height: 20px; padding-left: 6px">squad rank</td>
                                <td style="vertical-align: top; width: 155px">
                                    <!-- loading bar disguised as a rank bar -->
                                    <div class="progress_left">
                                        <div class="bar_left" :style="{width: bar_per_3+'%'}"></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="player_stats_left">
                player stats
            </div>

            <div class="player_stats_right_top">
                graphs
            </div>
            <div class="player_stats_right_bottom">
                more stats
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "teamplayers",
        props: ['teamid'],

        data() {
            return {
                playersArr: [],
                playersAgeArr: [],
                bar_per_1: 30,
                bar_per_2: 45,
                bar_per_3: 60
            }
        },

        methods: {
             DatetoTimestamp(strDate){
                var datum = Date.parse(strDate);
                return datum/1000;
            },

            rankedAge(playerid) {
                 return this.ageSortedArr.findIndex(i => i.playerid === playerid)
            },

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
                        // push the player and his birth date to the age array
                        this.playersAgeArr.push({'playerid': element.player.id, 'bdayTimestamp': this.DatetoTimestamp(element.player.birth.date)})
                    });
                }).catch((error) => {
                    console.log(error);
                });
            },

            shuffle() {
                 this.bar_per_1 = _.random(0, 100);
                 this.bar_per_2 = _.random(0, 100);
                 this.bar_per_3 = _.random(0, 100);
                //this.playersArr = _.shuffle(this.playersArr);
                //console.log(this.ageSortedArr.findIndex(i => i.playerid === 26240))
            }
        },

        created() {
            //this.loadPlayers(this.teamid);
        },

        computed:
            {
                ageSortedArr: function () {
                    // sort the ages from young to old
                    return this.playersAgeArr = _.sortBy(this.playersAgeArr, 'bdayTimestamp')
                }
            }
    }
</script>

<style scoped>
    .teamplayers_container {
        position: relative;
        margin-left: -9px;
        background-color: white;
        width: 975px;
        height: 659px;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
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
        padding: 5px;
    }

    .player_passport {
        width: 255px;
        height: 370px;
        /*border: solid 1px #ff7800;*/
        float: left;
        margin-right: 5px;
    }

    .player_stats_left {
        width: 218px;
        height: 370px;
        border: solid 1px #ff7800;
        float: left;
        margin-right: 5px;
    }

    .player_stats_right_top {
        width: 480px;
        height: 210px;
        border: solid 1px #ff7800;
        float: left;
        margin-bottom: 5px;
    }

    .player_stats_right_bottom {
        width: 480px;
        height: 155px;
        border: solid 1px #ff7800;
        float: left;
    }

    .card {
        float: left;
        overflow: hidden;
        position: relative;
        width: 100%;
        height: 100%;
        border: 1px solid #ff7800;
        border-radius: 5px;
        text-align: center;
    }
    .card .header {
        font-family: 'Oswald', sans-serif;
        color: #515151;
        font-size: 18px;
        line-height: 18px;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 55px;
        z-index: 1;
        background: #e58d36;
        padding-top: 4px;
    }
    .avatar {
        position: relative;
        margin-top: 25px;
        z-index: 100;
    }
    .avatar img {
        width: 75px;
        height: 75px;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        border: 5px solid rgba(0,0,30,0.8);
        box-shadow: rgba(0, 0, 0, 0.45) 0 25px 20px -20px;
    }

    .content {
        padding : 0;
        font-family: "Roboto", sans-serif;
        font-size: 12px;
        color: #515151;
    }

    .content td {
        text-align: left;
    }

    .content_header {
        width: 100%;
        background-color: transparent;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        color: #515151;
        line-height: 21px;
        margin-top: 10px;
    }

    .progress_left {
        float: left;
        width: 100%;
        position: relative;
        animation: all 0.4s ease;
        margin-top: 5px;
        border: solid 1px #515151;
    }

    .bar_left {
        border-radius: 0 1px 1px 0;
        float:left;
        height: 9px;
        background-color: #ff7800;
        width: 30%;
        transition: all 0.5s ease-out;
    }

</style>
