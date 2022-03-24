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
            <div v-for="player in playersArr.slice(0,1)" class="player_container">
                <div class="player_passport">
                    <div class="card">
                        <div class="header" id="header-blur">{{player.player.firstname}} {{player.player.lastname}}</div>
                        <div class="avatar">
                            <img :src=player.player.photo alt="" />
                        </div>
                        <div class="content">
                            <div class="content_header">AGE</div>
                                <table style="margin-top: 8px">
                                    <tr>
                                        <td style="width: 80px; height: 20px; padding-left: 6px">born</td><td>{{player.player.birth.date}} ({{player.player.age}})</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 80px; height: 20px; padding-left: 6px">birthplace</td><td>{{player.player.birth.place}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 80px; height: 20px; padding-left: 6px">squad rank</td>
                                        <td style="vertical-align: top; width: 155px">
                                            <!-- loading bar disguised as a rank bar -->
                                            <div class="progress_left">
                                                <div class="bar_left" :style="{width: rankedAgeBarPct(player.player.id)+'%'}"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            <div title="jelle" class="content_header">PHYSICAL</div>
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
                    <div class="left_stats_header">
                        games this ec
                    </div>
                    <div class="left_stats_data">
                        4
                    </div>
                    <div class="left_stats_header">
                        starting XI
                    </div>
                    <div class="left_stats_data">
                        4
                    </div>
                    <div class="left_stats_header">
                        minutes
                    </div>
                    <div class="left_stats_data">
                        316
                    </div>
                    <div class="left_stats_header">
                        position
                    </div>
                    <div class="left_stats_data">
                        defender
                    </div>
                    <div class="left_stats_header">
                        rating
                    </div>
                    <div class="left_stats_data">
                        {{player.statistics[0].games.rating ? player.statistics[0].games.rating : '-'}}
                    </div>
                </div>

                <div class="player_stats_right_top">
                    <div class="player_stats_right_top_sub">
                        <div class="left_stats_header">
                            passes
                        </div>
                        <div style="background-color: transparent; margin-left: 10px; margin-top: 10px">
                            <donut-test v-if="loaded" v-bind:centertext="player.player.id" v-bind:chart-data="playerDoughnutStatsPasses[whichChartIndex(player.player.id)]" :canvas_id="player.player.id"/>
                        </div>
                    </div>
                    <div class="player_stats_right_top_sub">
                        <div class="left_stats_header">
                            duels
                        </div>
                        <div style="background-color: transparent; margin-left: 10px; margin-top: 10px">
                            <donut-test v-if="loaded" v-bind:centertext="player.player.id" v-bind:chart-data="playerDoughnutStatsPasses[whichChartIndex(player.player.id)]" :canvas_id="player.player.id+999"/>
                        </div>
                    </div>
                    <div class="player_stats_right_top_sub">
                        <div class="left_stats_header">
                            dribbles
                        </div>
                        <div style="background-color: transparent; margin-left: 10px; margin-top: 10px">
                            <donut-test v-if="loaded" v-bind:centertext="156" v-bind:chart-data="playerDoughnutStatsPasses[whichChartIndex(player.player.id)]" :canvas_id="player.player.id+1099"/>
                        </div>
                    </div>
                    <!--

                    -->
                </div>
                <div class="player_stats_right_bottom">
                    <div class="player_stats_right_bottom_sub" style="height: inherit">
                        <div class="player_stats_right_bottom_container">
                            <div class="player_stats_right_bottom_header">
                                shots
                            </div>
                            <div class="player_stats_right_bottom_data">
                                12
                            </div>
                        </div>

                        <div class="player_stats_right_bottom_container">
                            <div class="player_stats_right_bottom_header">
                                goals
                            </div>
                            <div class="player_stats_right_bottom_data">
                                2
                            </div>
                        </div>

                        <div class="player_stats_right_bottom_container">
                            <div class="player_stats_right_bottom_header">
                                cards
                            </div>
                            <div class="player_stats_right_bottom_data">
                                1
                            </div>
                        </div>

                        <div class="player_stats_right_bottom_container">
                            <div class="player_stats_right_bottom_header">
                                tackles
                            </div>
                            <div class="player_stats_right_bottom_data">
                                4
                            </div>
                        </div>

                        <div class="player_stats_right_bottom_container">
                            <div class="player_stats_right_bottom_header">
                                fouls
                            </div>
                            <div class="player_stats_right_bottom_data">
                                9
                            </div>
                        </div>

                        <div class="player_stats_right_bottom_container">
                            <div class="player_stats_right_bottom_header">
                                subs
                            </div>
                            <div class="player_stats_right_bottom_data">
                                0
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import donutTest from "./donutTest";
    export default {
        name: "teamplayers",
        props: ['teamid'],
        components: { donutTest },

        data() {
            return {
                loaded: false,
                playersArr: [],
                playersAgeArr: [],
                playerDoughnutStatsPasses: [],
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

            // this function returns the rank of the player, agewise, from oldest to youngest
            rankedAge(playerid) {
                 return _.sortBy(this.playersAgeArr, 'bdayTimestamp', 'desc').findIndex(i => i.playerid === playerid)
            },

            // this function will return the bar percentage, agewise, where bar is fully filled
            // for the oldest player and almost empty for the youngest
            rankedAgeBarPct(playerid) {
                 return 100 - (this.rankedAge(playerid)/this.playersArr.length)*100
            },

            // this function will return the players rank, height wise
            rankedHeight(playerid) {
                 return _.orderBy(this.playersArr, 'players.height', 'asc').findIndex((item) => item.player.id === playerid)
            },

            //this function will return the players rank, weight wise
            rankedWeight(playerid) {
                 return _.orderBy(this.playersArr, 'players.weight', 'asc').findIndex((item) => item.player.id === playerid)
            },

            // this function returns the index of the array where playerid is found
            whichChartIndex(playerid) {
                 return this.playerDoughnutStatsPasses.findIndex((item) => item.playerid === playerid);
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
                        this.playersAgeArr.push({'playerid': element.player.id, 'bdayTimestamp': this.DatetoTimestamp(element.player.birth.date)});
                        // push some stats for the dougnut charts
                        this.playerDoughnutStatsPasses.push({
                            'playerid': element.player.id,
                            'type': 'doughnut',
                            'data': {
                                'labels': ['accurate', 'not-accurate'],
                                'datasets': [
                                    {
                                        'data': [73,156-73],
                                        'backgroundColor': [
                                            // green
                                            '#68b451',
                                            // red
                                            '#c22d2d'
                                        ]
                                    },
                                ],

                            },
                            'options': {
                                'plugins': {
                                    'legend': {
                                        'display': false,
                                    }
                                },
                                'layout': {
                                    'padding': 10
                                },
                                'cutout': '50%',
                                'hoverOffset': 10,
                                'responsive': true,
                                'maintainAspectRatio': true,
                                'borderWidth': 0
                            }
                        });

                    });
                    console.log(this.whichChartIndex(18845));
                    this.loaded = true;
                }).catch((error) => {
                    console.log(error);
                });
            },

            shuffle() {
                 // sort the players, oldest to youngest
                 this.playersArr = _.shuffle(this.playersArr);
                 //this.playersArr = _.orderBy(this.playersArr, 'player.age', 'asc');
                //console.log(this.ageSortedArr.findIndex(i => i.playerid === 26240))
            }
        },

        created() {
            this.loadPlayers(this.teamid);
        },

    }
</script>

<style>
    .teamplayers_container {
        position: relative;
        margin-left: -9px;
        background-color: white;
        width: 975px;
        height: 654px;
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
        height: 375px;
        background: -moz-linear-gradient(180deg, rgba(255,255,255,1) 16%, rgba(255,210,164,1) 100%);
        background: -webkit-linear-gradient(180deg, rgba(255,255,255,1) 16%, rgba(255,210,164,1) 100%);
        background: linear-gradient(180deg, rgba(255,255,255,1) 16%, rgba(255,210,164,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff",endColorstr="#ffd2a4",GradientType=1);
        padding: 5px 0 0 5px;
        overflow: hidden;
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
        height: 218px;
        float: left;
        margin-bottom: 5px;
    }

    .player_stats_right_bottom {
        width: 480px;
        height: 147px;
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
        color: #616161;
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

    .left_stats_header {
        padding-top: 2px;
        background-image: url("images/light_wool.png");
        height: 30px;
        width: 100%;
        text-transform: uppercase;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        color: #616161;
        text-align: center;
        line-height: 24px;
    }

    .left_stats_data {
        margin-top: 8px;
        margin-bottom: 6px;
        height: 30px;
        width: 100%;
        text-transform: uppercase;
        font-family: 'Oswald', sans-serif;
        font-size: 26px;
        color: #ff7800;
        text-align: center;
        line-height: 26px;
    }

    .player_container {
    }

    .player_stats_right_top_sub {
        width: 33%;
        float: left;
        height: 100%;
    }

    .player_stats_right_bottom_header {
        padding-top: 2px;
        background-image: url("images/light_wool.png");
        height: 30px;
        width: 100%;
        text-transform: lowercase;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        color: #616161;
        text-align: center;
        line-height: 24px;
    }

    .player_stats_right_bottom_data {
        font-family: 'Oswald', sans-serif;
        font-size: 50px;
        color: #ff7800;
        text-align: center;
        margin-top: 20px;
    }

    .player_stats_right_bottom_container {
        float: left;
        width: 79px;
        height: 100%
    }
</style>
