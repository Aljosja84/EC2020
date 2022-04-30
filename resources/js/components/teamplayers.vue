<template>
    <div class="teamplayers_container">
        <div v-bind:style="doneloading" class="loading_div"><div id="pulseloader"/></div>
        <div class="teamplayer_header">
            players
            <div style="float: right; padding-right: 10px; ; height: 100%; line-height: 1">
                <select name="orderPlayers" @change="orderPlayers($event)" v-model="key">
                    <option value="default">Order players by...</option>
                    <option value="age">Age</option>
                    <option value="height">Height</option>
                    <option value="weight">Weight</option>
                    <option value="rating">Rating</option>
                    <option value="passes">Passes</option>
                    <option value="minutes">Minutes</option>
                </select>
            </div>
        </div>
        <!-- seperator -->
        <div class="separator_bar"></div>
        <!-- player photos ----------->
        <div id="midfield_div">
            <transition-group name="players_list" tag="ul">
                <span v-for="(person, index, key) in playersArrPortraits" :key="person.player.id" class="players_list-item">
                    <img :class="{'active': activeIndex === person.player.id}" @click="setActive(person.player.id);scrollPlayerWin('player'+person.player.id)" :content="person.player.lastname" v-tippy="{arrow : true, arrowType : 'round', animation : 'scale', animateFill: true, followCursor: 'horizontal', theme: 'honeybee'}" :src=person.player.photo>
                </span>
            </transition-group>
        </div>
        <!-------------------------->
        <div class="player_stats_header"><span>player statistics</span></div>

        <div class="player_stats_container" id="allPlayerWindows">
            <div v-for="player in playersArr" class="player_container" :id="'player'+player.player.id">
                <div class="player_passport">
                    <div class="card">
                        <div class="header" id="header-blur">{{player.player.firstname}} {{player.player.lastname}}</div>
                        <div class="avatar">
                            <img :src=player.player.photo alt="" />
                        </div>
                        <div class="content">
                            <div class="content_header_pass">AGE</div>
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
                            <div class="content_header_pass">PHYSICAL</div>
                                <table style="margin-top: 8px">
                                    <tr>
                                        <td style="width: 80px; height: 20px; padding-left: 6px">height</td><td>{{ player.player.height }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 80px; height: 20px; padding-left: 6px">squad rank</td>
                                        <td style="vertical-align: top; width: 155px">
                                            <!-- loading bar disguised as a rank bar -->
                                            <div class="progress_left">
                                                <div class="bar_left" :style="{width: rankedHeightBarPct(player.player.id)+'%'}"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 80px; height: 20px; padding-left: 6px">weight</td><td>{{ player.player.weight }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 80px; height: 20px; padding-left: 6px">squad rank</td>
                                        <td style="vertical-align: top; width: 155px">
                                            <!-- loading bar disguised as a rank bar -->
                                            <div class="progress_left">
                                                <div class="bar_left" :style="{width: rankedWeightBarPct(player.player.id)+'%'}"></div>
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
                        {{player.statistics[0].games.appearences ? Number(player.statistics[0].games.appearences) : '-'}}
                    </div>
                    <div class="left_stats_header">
                        starting XI
                    </div>
                    <div class="left_stats_data">
                        {{player.statistics[0].games.lineups ? Number(player.statistics[0].games.lineups) : '-'}}
                    </div>
                    <div class="left_stats_header">
                        minutes
                    </div>
                    <div class="left_stats_data">
                        {{player.statistics[0].games.minutes ? Number(player.statistics[0].games.minutes) : '-'}}
                    </div>
                    <div class="left_stats_header">
                        position
                    </div>
                    <div class="left_stats_data">
                        {{player.statistics[0].games.position ? player.statistics[0].games.position : '-'}}
                    </div>
                    <div class="left_stats_header">
                        rating
                    </div>
                    <div class="left_stats_data">
                        {{player.statistics[0].games.rating ? Number(player.statistics[0].games.rating).toFixed(2) : '-'}}
                    </div>
                </div>

                <div class="player_stats_right_top">
                    <div class="player_stats_right_top_sub">
                        <div class="left_stats_header">
                            passes
                        </div>
                        <div style="background-color: transparent; margin-left: 10px; margin-top: 10px">
                            <donut-test v-show="loaded" v-if="player.statistics[0].passes.total != null" v-bind:fontsize="28" v-bind:centertext="player.statistics[0].passes.total" v-bind:chart-data="playerDoughnutStatsPasses[whichIndexPasses(player.player.id)]" :canvas_id="player.player.id"/>
                        </div>
                    </div>
                    <div class="player_stats_right_top_sub">
                        <div class="left_stats_header">
                            duels
                        </div>
                        <div style="background-color: transparent; margin-left: 10px; margin-top: 10px">
                            <donut-test v-show="loaded" v-if="player.statistics[0].duels.total != null" v-bind:fontsize="28" v-bind:centertext="player.statistics[0].duels.total" v-bind:chart-data="playerDoughnutStatsDuels[whichIndexDuels(player.player.id)]" :canvas_id="player.player.id+999"/>
                        </div>
                    </div>
                    <div class="player_stats_right_top_sub">
                        <div class="left_stats_header">
                            dribbles
                        </div>
                        <div style="background-color: transparent; margin-left: 10px; margin-top: 10px">
                            <donut-test v-show="loaded" v-if="player.statistics[0].dribbles.attempts != null && player.statistics[0].dribbles.attempts > 0" v-bind:fontsize="28" v-bind:centertext="player.statistics[0].dribbles.attempts" v-bind:chart-data="playerDoughnutStatsDribbles[whichIndexDribbles(player.player.id)]" :canvas_id="player.player.id+1099"/>
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
                                {{player.statistics[0].shots.total ? Number(player.statistics[0].shots.total) : '-'}}
                            </div>
                        </div>

                        <div class="player_stats_right_bottom_container">
                            <div class="player_stats_right_bottom_header">
                                goals
                            </div>
                            <div class="player_stats_right_bottom_data">
                                {{player.statistics[0].goals.total ? Number(player.statistics[0].goals.total) : '-'}}
                            </div>
                        </div>

                        <div class="player_stats_right_bottom_container">
                            <div class="player_stats_right_bottom_header">
                                cards
                            </div>
                            <div class="player_stats_right_bottom_data">
                                {{player.statistics[0].cards.red + player.statistics[0].cards.yellow}}
                            </div>
                        </div>

                        <div class="player_stats_right_bottom_container">
                            <div class="player_stats_right_bottom_header">
                                tackles
                            </div>
                            <div class="player_stats_right_bottom_data">
                                {{player.statistics[0].tackles.total ? Number(player.statistics[0].tackles.total) : '-'}}
                            </div>
                        </div>

                        <div class="player_stats_right_bottom_container">
                            <div class="player_stats_right_bottom_header">
                                fouls
                            </div>
                            <div class="player_stats_right_bottom_data">
                                {{player.statistics[0].fouls.committed ? Number(player.statistics[0].fouls.committed) : '-'}}
                            </div>
                        </div>

                        <div class="player_stats_right_bottom_container">
                            <div class="player_stats_right_bottom_header">
                                subs
                            </div>
                            <div class="player_stats_right_bottom_data">
                                {{player.statistics[0].substitutes.in + player.statistics[0].substitutes.out}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <team-stats :teamid="teamid"></team-stats>
    </div>

</template>

<script>
    import donutTest from "./donutTest";
    import teamstats from "./teamstats";

    export default {
        name: "teamplayers",
        props: ['teamid'],
        components: { donutTest, teamstats },

        data() {
            return {
                activeIndex: undefined,
                loading: true,
                key: "default",
                loaded: false,
                playersArr: [],
                playerImages: [],
                playersArrPortraits: [],
                playersAgeArr: [],
                playerDoughnutStatsPasses: [],
                playerDoughnutStatsDuels: [],
                playerDoughnutStatsDribbles: [],
                bar_per_1: 30,
                bar_per_2: 45,
                bar_per_3: 60
            }
        },

        methods: {
            setActive(index) { this.activeIndex = index },

            scrollPlayerWin(e) {
                // scroll to that offset to bring the div into view.
                // note the -5, which is to account for the padding of the inner div
                let y = document.getElementById(e).offsetTop-5;
                document.getElementById('allPlayerWindows').scroll({top: y})
            },

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
                 return _.orderBy(this.playersArr, 'player.height', 'desc').findIndex((item) => item.player.id === playerid)
            },

            // this function will return the bar percentage, heightwise.
            rankedHeightBarPct(playerid) {
                 return 100 - (this.rankedHeight(playerid)/this.playersArr.length)*100
            },

            //this function will return the players rank, weight wise
            rankedWeight(playerid) {
                 return _.orderBy(this.playersArr, 'player.weight', 'desc').findIndex((item) => item.player.id === playerid)
            },

            // this function will return the bar percentage, heightwise.
            rankedWeightBarPct(playerid) {
                return 100 - (this.rankedWeight(playerid)/this.playersArr.length)*100
            },

            // this function returns the index of the passes array where playerid is found
            whichIndexPasses(playerid) {
                 return this.playerDoughnutStatsPasses.findIndex((item) => item.playerid === playerid);
            },
            // this function returns the index of the passes array where playerid is found
            whichIndexDuels(playerid) {
                return this.playerDoughnutStatsDuels.findIndex((item) => item.playerid === playerid);
            },
            // this function returns the index of the passes array where playerid is found
            whichIndexDribbles(playerid) {
                return this.playerDoughnutStatsDribbles.findIndex((item) => item.playerid === playerid);
            },
            // the select dropdown will change how players are ordered and displayed on the page.
            orderPlayers(event) {
                let value = event.target.value;
                switch (value) {
                    /* physical attributes */
                    case "age":
                        return this.playersArrPortraits = _.orderBy(this.playersArrPortraits, 'player.birth.date', 'asc');
                    case "height":
                        return this.playersArrPortraits = _.orderBy(this.playersArrPortraits, 'player.height', 'desc');
                    case "weight":
                        return this.playersArrPortraits = _.orderBy(this.playersArrPortraits, 'player.weight', 'desc');
                    /* statistical attributes */
                    case "rating":
                        return this.playersArrPortraits = _.orderBy(this.playersArrPortraits, 'statistics[0].games.rating', 'desc');
                    case "passes":
                        return this.playersArrPortraits = _.orderBy(this.playersArrPortraits, 'statistics[0].passes.total', 'desc');
                    case "minutes":
                        return this.playersArrPortraits = _.orderBy(this.playersArrPortraits, 'statistics[0].games.minutes', 'desc');
                }
            },
            /*
            *
            * Here we'll check for the images to be done loading and remove the loading screen
            *
            */
            imageLoadedCheck() {
                let imageLoaded = 0;
                for (const imageSrc of this.playerImages) {
                    const img = new Image();
                    img.src = imageSrc;

                    img.onload = () => {
                        imageLoaded++;

                        if(imageLoaded === this.playerImages.length) {
                            console.log("all player portraits have loaded");
                            this.loading = false;
                        }
                    }
                }
            },
            // external API call and set most vars
            loadPlayers(e) {
                // get the players (including qualifiers) from a particular team (e)
                axios.get("https://v3.football.api-sports.io/players?league=4&season=2020&team=" + e, {
                    headers: {
                        "X-RapidAPI-Host": process.env.MIX_API_URL,
                        "X-RapidAPI-Key": process.env.MIX_API_KEY
                    }
                }).then((response) => {
                    response.data.response.forEach((element) => {
                        // this is the main array with all players data in it
                        this.playersArr.push(element);
                        /*
                        *
                        * Put all images in an array to preload, and only if they're all loaded
                        * remove the loading screen together with a check if the charts have loaded
                        *
                        */
                        this.playerImages.push(element.player.photo);
                        // this is the faux array, will only be used for the portraits on top of the page.
                        this.playersArrPortraits.push(element);
                        // push the player and his birth date to the age array
                        this.playersAgeArr.push({'playerid': element.player.id, 'bdayTimestamp': this.DatetoTimestamp(element.player.birth.date)});
                        // push passes in array for the doughtnut chart
                        this.playerDoughnutStatsPasses.push({
                            'playerid': element.player.id,
                            'type': 'doughnut',
                            'data': {
                                'labels': ['accurate', 'not-accurate'],
                                'datasets': [
                                    {
                                        'data': [
                                            Math.floor(element.statistics[0].passes.total*(element.statistics[0].passes.accuracy/100)),
                                            Math.ceil(element.statistics[0].passes.total - element.statistics[0].passes.total*(element.statistics[0].passes.accuracy/100))
                                        ],
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
                        // push duels in array for a doughnut chart
                        this.playerDoughnutStatsDuels.push({
                            'playerid': element.player.id,
                            'type': 'doughnut',
                            'data': {
                                'labels': ['won', 'lost'],
                                'datasets': [
                                    {
                                        'data': [
                                            element.statistics[0].duels.won,
                                            element.statistics[0].duels.total - element.statistics[0].duels.won
                                        ],
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
                        // push duels in array for a doughnut chart
                        this.playerDoughnutStatsDribbles.push({
                            'playerid': element.player.id,
                            'type': 'doughnut',
                            'data': {
                                'labels': ['success', 'fail'],
                                'datasets': [
                                    {
                                        'data': [
                                            element.statistics[0].dribbles.success,
                                            element.statistics[0].dribbles.attempts - element.statistics[0].dribbles.success
                                        ],
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
                    /*
                    *
                    * All data has been loaded and imageload check will be initiated
                    *
                    */
                    this.activeIndex = this.playersArrPortraits[0].player.id;
                    this.loaded = true;
                    this.imageLoadedCheck();

                }).catch((error) => {
                    console.log(error);
                });
            },
        },

        created() {
            this.loadPlayers(this.teamid);
        },
        computed: {
            doneloading() {
                if(!this.loading) {
                    return {opacity: 0, visibility: 'hidden'};
                }
            }
        }

    }
</script>

<style>
    .loading_div {
        width: 100%;
        position: absolute;
        height: 100%;
        z-index: 999;
        opacity: 100%;
        background-color: whitesmoke;
        -webkit-transition: all 0.2s ease-in-out 0s;
        -moz-transition: all 0.2s ease-in-out 0s;
        -ms-transition: all 0.2s ease-in-out 0s;
        transition: all 0.2s ease-in-out 0s;
        visibility: visible;
    }

    #pulseloader {
        z-index: 1000;
        background-image: url("images/pulseloader_3.gif");
        width: 84px;
        height: 84px;
        position: absolute;
        top: 39%;
        left: 45%;
    }

    .tippy-tooltip.honeybee-theme {
        background-color: #313131;
        color: orange;
    }
    .tippy-tooltip.honeybee-theme .tippy-roundarrow{
        fill: #313131;
    }

    .teamplayers_container {
        position: relative;
        margin-left: -9px;
        background-color: white;
        width: 975px;
        height: 654px;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0 3px 6px;
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
        transition: all .1s;
        width: 75px;
        height: 75px;
        border-radius: 100%;
        box-shadow: rgba(17, 17, 26, 0.35) 0 4px 16px, rgba(17, 17, 26, 0.05) 0 8px 32px;
    }

    .active {
        border: 4px solid #ff7800;
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
        cursor: pointer;
    }

    .player_stats_container {
        position: relative;
        z-index: 14;
        width: 100%;
        height: 375px;
        background: -moz-linear-gradient(180deg, rgba(255,255,255,1) 16%, rgba(255,210,164,1) 100%);
        background: -webkit-linear-gradient(180deg, rgba(255,255,255,1) 16%, rgba(255,210,164,1) 100%);
        background: linear-gradient(180deg, rgba(255,255,255,1) 16%, rgba(255,210,164,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff",endColorstr="#ffd2a4",GradientType=1);
        padding: 5px 0 0 5px;
        overflow-y: hidden;
        overflow-x: hidden;
        scroll-behavior: auto;
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
        border: 3px solid rgba(0,0,30,0.7);
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

    .content_header_pass {
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
        height: 375px;
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

    :root {
        --radius: 2px;
        --baseFg: white;
        --baseBg: #919191;
        --accentFg: #ff7800;
        --accentBg: #919191;
    }

    select {
        font: 400 14px/1.3 "Roboto Light";
        -webkit-appearance: none;
        appearance: none;
        color: var(--baseFg);
        border: 1px solid var(--baseFg);
        line-height: 1;
        outline: 0;
        padding: 0.65em 2.5em 0.55em 0.75em;
        border-radius: var(--radius);
        background-color: var(--baseBg);
        background-image: linear-gradient(var(--baseFg), var(--baseFg)),
        linear-gradient(-135deg, transparent 50%, var(--accentBg) 50%),
        linear-gradient(-225deg, transparent 50%, var(--accentBg) 50%),
        linear-gradient(var(--accentBg) 42%, var(--accentFg) 42%);
        background-repeat: no-repeat, no-repeat, no-repeat, no-repeat;
        background-size: 1px 100%, 20px 22px, 20px 22px, 20px 100%;
        background-position: right 20px center, right bottom, right bottom, right bottom;
    }

    select:hover {
        background-image: linear-gradient(var(--accentFg), var(--accentFg)),
        linear-gradient(-135deg, transparent 50%, var(--accentFg) 50%),
        linear-gradient(-225deg, transparent 50%, var(--accentFg) 50%),
        linear-gradient(var(--accentFg) 42%, var(--accentBg) 42%);
    }

    select:active {
        background-image: linear-gradient(var(--accentFg), var(--accentFg)),
        linear-gradient(-135deg, transparent 50%, var(--accentFg) 50%),
        linear-gradient(-225deg, transparent 50%, var(--accentFg) 50%),
        linear-gradient(var(--accentFg) 42%, var(--accentBg) 42%);
        color: var(--accentBg);
        border-color: var(--accentFg);
        background-color: var(--accentFg);
    }
</style>
