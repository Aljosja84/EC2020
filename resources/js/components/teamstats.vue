<template>
    <div class="teamstats_container">
        <div class="loading_div_teamstats" v-bind:style="doneloading"><div id="pulseloader"/></div>
        <div class="teamstats_header">team statistics (including qualifiers)</div>
        <!-- seperator -->
        <div class="separator_bar"></div>
        <div id="header_bar_container">
            <div id="games_header">games</div>
            <div id="goals_header">goals</div>
            <div id="extra_header">extra</div>
        </div>
        <div id="stats_container">
            <div id="games_container">
                <div class="games_chart_div">
                    <div class="games_title">played</div>
                    <div class="games_chart">
                        <donut-test v-show="loaded" v-bind:centertext="12" v-bind:fontsize="24" v-bind:chart-data="playedChart[0]" :canvas_id="'played'+teamid"/>
                    </div>
                </div>
                <div class="games_chart_div">
                    <div class="games_title">wins</div>
                    <div class="games_chart">
                        <donut-test v-show="loaded" v-bind:centertext="12" v-bind:fontsize="24" v-bind:chart-data="playedChart[0]" :canvas_id="'wins'+teamid"/>
                    </div>
                </div>
                <div class="games_chart_div">
                    <div class="games_title">draws</div>
                    <div class="games_chart">
                        <donut-test v-show="loaded" v-bind:centertext="12" v-bind:fontsize="24" v-bind:chart-data="playedChart[0]" :canvas_id="'draws'+teamid"/>
                    </div>
                </div>
                <div class="games_chart_div">
                    <div class="games_title">loses</div>
                    <div class="games_chart">
                        <donut-test v-show="loaded" v-bind:centertext="12" v-bind:fontsize="24" v-bind:chart-data="playedChart[0]" :canvas_id="'loses'+teamid"/>
                    </div>
                </div>
            </div>
            <div class="separator_div" style="float: left"></div>
            <div id="goals_container">
                <div id="for_container">
                    <span style="color: #8ba752">for</span>
                    <div class="for_title_bar"><span>home</span><span>away</span><span>total</span></div>
                    <div class="for_data_bar"><span>16</span><span>7</span><span>23</span></div>
                    <div id="for_chart_container">
                        <bar-chart v-bind:chart-data="forChart[0]" :canvas_id="'for_bar'+teamid"></bar-chart>
                    </div>
                </div>
                <div id="against_container">
                    <span style="color: #d4530d">against</span>
                    <div class="for_title_bar"><span>home</span><span>away</span><span>total</span></div>
                    <div class="for_data_bar"><span>16</span><span>7</span><span>23</span></div>
                    <div id="against_chart_container">
                        <bar-chart v-bind:chart-data="againstChart[0]" :canvas_id="'against_bar'+teamid"></bar-chart>
                    </div>
                </div>

            </div>
            <div class="separator_div" style="float: left"></div>
            <div id="extra_container">
                <div id="biggest_container">
                    <div style="margin-bottom: 6px">biggest</div>
                    <div id="streak_header">streak</div>
                    <div id="streak_content"><span>win: 3 | draw: 3 | loss: 5</span></div>
                    <div id="wins_header">wins</div>
                    <div id="wins_content"><span>home: 4-0 | away: 0-6</span></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import donutTest from "./donutTest";
    import BarChart from "./barchart";

    export default {
        name: "teamstats",
        props: ['teamid'],
        components: { donutTest, BarChart },

        data() {
            return {
                loading: false,
                loaded: true,
                /*
                *
                * doughnut chart
                *
                */
                playedChart: [{
                    'playerid': 12,
                    'type': 'doughnut',
                    'data': {
                        'labels': ['home', 'away'],
                        'datasets': [
                            {
                                'data': [8, 4],
                                'backgroundColor': [
                                    // green
                                    '#74c89b',
                                    // red
                                    '#2b6c41'
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
                        'hoverOffset': 7,
                        'responsive': true,
                        'maintainAspectRatio': true,
                        'borderWidth': 0
                    }
                }],
                /*
                *
                * Bar chart
                *
                */
                forChart: [{
                    type: 'bar',
                    data: {
                        labels: ["0-15", "15-30", "30-45", "45-60", "60-75", "75-90", "90+"],
                        datasets: [
                            {
                                indexAxis: 'x',
                                label: "Goals",
                                backgroundColor: ["#8ba752"],
                                hoverBackgroundColor: ["#6b883b"],
                                data: [1, 2, 1, 4, 3, 2, 3]
                            }
                        ],
                    },
                    options: {
                        scales: {
                            y: {
                                display: false,
                                beginAtZero: true
                            }
                        }
                    }
                }],
                /*
                *
                * Bar chart
                *
                */
                againstChart: [{
                    type: 'bar',
                    data: {
                        labels: ["0-15", "15-30", "30-45", "45-60", "60-75", "75-90", "90+"],
                        datasets: [
                            {
                                indexAxis: 'x',
                                label: "Goals",
                                backgroundColor: ["#d4530d"],
                                hoverBackgroundColor: ["#b43f06"],
                                data: [2, 1, 1, 2, 5, 2, 1]
                            }
                        ],
                    },
                    options: {
                        scales: {
                            y: {
                                display: false,
                                    beginAtZero: true
                            }
                        }
                    }
                }],
            }
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

<style scoped>
    .loading_div_teamstats {
        position: absolute;
        width: 100%;
        height: 435px;
        background-color: whitesmoke;
        z-index: 999;
        opacity: 100%;
        transition: all .2s ease-in;
    }

    #pulseloader {
        z-index: 1000;
        background-image: url("images/pulseloader_3.gif");
        width: 84px;
        height: 84px;
        position: absolute;
        top: 41%;
        left: 45%;
    }
    .teamstats_container {
        position: relative;
        margin-top: 10px;
        width: 975px;
        height: 435px;
        box-shadow: rgba(0, 0, 0, 0.16) 0 3px 6px, rgba(0, 0, 0, 0.23) 0 3px 6px;
        background-color: white;
    }

    .teamstats_header {
        position: relative;
        width: 100%;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        color: #515151;
        text-transform: uppercase;
        text-align: center;
        background-image: url("images/light_wool.png");
        padding: 5px 0 5px 8px;
        line-height: 24px;
        height: 35px;
        box-shadow: rgba(33, 35, 38, 0.1) 0px 10px 10px -10px;
        z-index: 999;
    }

    .separator_bar {
        height: 2px;
        background-image: linear-gradient(to right, transparent, #b5b5b5, transparent);
    }

    #header_bar_container {
        position: relative;
        width: 100%;
        height: 40px;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        color: #515151;
        text-transform: uppercase;
        line-height: 40px;
        text-align: center;
        border-bottom: 1px solid #d0d0d0;
        background-color: whitesmoke;
        z-index: 0;
    }

    #games_header {
        float: left;
        text-align: inherit;
        width: 230px;
    }
    #goals_header {
        float: left;
        text-align: inherit;
        width: 488px;
    }
    #extra_header {
        float: left;
        text-align: inherit;
        width: 257px;
    }

    #stats_container {
        width: 100%;
        height: 358px;
        background: rgb(255,255,255);
        background: -moz-linear-gradient(180deg, rgba(255,255,255,1) 0%, rgba(203,211,113,1) 100%);
        background: -webkit-linear-gradient(180deg, rgba(255,255,255,1) 0%, rgba(203,211,113,1) 100%);
        background: linear-gradient(180deg, rgba(255,255,255,1) 0%, rgba(203,211,113,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff",endColorstr="#cbd371",GradientType=1);
    }

    .separator_div {
        width: 1px;
        height: 100%;
        background-image: linear-gradient(to top, transparent, #b5b5b5, transparent);
    }

    #games_container {
        padding-top: 5px;
        float: left;
        width: 230px;
        height: 100%;
        background-color: transparent;
    }
    #goals_container {
        border-image: linear-gradient(to top, transparent, whitesmoke, transparent) 1;
        border-width: 1px;
        border-style: solid;
        border-right: none;
        border-bottom: none;
        border-top: none;
        float: left;
        width: 486px;
        height: 100%;
        background-color: transparent;
        padding: 5px 15px 0 15px;
    }
    #extra_container {
        border-image: linear-gradient(to top, transparent, whitesmoke, transparent) 1;
        border-width: 1px;
        border-style: solid;
        border-right: none;
        border-bottom: none;
        border-top: none;
        float: left;
        width: 257px;
        height: 100%;
        background-color: transparent;
    }

    .games_chart_div {
        padding-left: 10px;
        width: 100%;
        height: 85px;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        color: #515151;
        text-transform: lowercase;
        line-height: 85px;
    }
    .games_title {
        width: 30%;
        float: left;
    }
    .games_chart {
        padding-left: 30px;
        width: 129px;
        height: 85px;
        float: left;
    }

    #for_container, #against_container {
        font-family: 'Oswald', sans-serif;
        font-size: 25px;
        color: #515151;
        float: left;
        width: 226px;
        height: 100%;
    }

    #against_container {
        text-align: right;
    }

    .for_title_bar {
        margin-top: 6px;
        font-family: "Roboto Light", sans-serif;
        font-size: 16px;
        width: 224px;
        height: 35px;
        border-top: 1px solid #336026;
        display: flex;
        justify-content: space-between;
        line-height: 35px;
        background: rgb(189, 232, 177);
        background: -moz-linear-gradient(180deg, rgba(189, 232, 177, 1) 0%, rgba(98, 176, 75, 1) 5%, rgba(169, 226, 153, 1) 100%);
        background: -webkit-linear-gradient(180deg, rgba(189, 232, 177, 1) 0%, rgba(98, 176, 75, 1) 5%, rgba(169, 226, 153, 1) 100%);
        background: linear-gradient(180deg, rgba(189, 232, 177, 1) 0%, rgba(98, 176, 75, 1) 5%, rgba(169, 226, 153, 1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#bde8b1", endColorstr="#a9e299", GradientType=1);
        padding: 0 6px 0 6px;
    }
   .for_data_bar {
        font-family: "Roboto Light", sans-serif;
        font-size: 16px;
        margin-top: 2px;
        width: 224px;
        height: 35px;
        border-top: 1px solid #336026;
        display: flex;
        justify-content: space-between;
        background-color: #c1e4b6;
        padding: 0 6px 0 6px;
        line-height: 35px;
    }
   .for_data_bar span {
       font-weight: bold;
   }

    #for_chart_container {
        float: left;
        width: 224px;
        height: 224px;
        margin-top: 5px;
    }
    #against_chart_container {
        float: left;
        width: 224px;
        height: 224px;
        margin-top: 5px;
    }

    #biggest_container {
        font-family: 'Oswald', sans-serif;
        font-size: 25px;
        color: #515151;
        text-align: center;
        width: 100%;
        height: 100%;
        background-color: transparent;
        padding: 5px 1px 5px 10px;
    }
    #streak_header, #wins_header {
        float: left;
        font-family: "Roboto Light", sans-serif;
        font-size: 16px;
        width: 61px;
        height: 35px;
        border-top: 1px solid #336026;
        text-align: center;
        line-height: 35px;
        background: rgb(189, 232, 177);
        background: -moz-linear-gradient(180deg, rgba(189, 232, 177, 1) 0%, rgba(98, 176, 75, 1) 5%, rgba(169, 226, 153, 1) 100%);
        background: -webkit-linear-gradient(180deg, rgba(189, 232, 177, 1) 0%, rgba(98, 176, 75, 1) 5%, rgba(169, 226, 153, 1) 100%);
        background: linear-gradient(180deg, rgba(189, 232, 177, 1) 0%, rgba(98, 176, 75, 1) 5%, rgba(169, 226, 153, 1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#bde8b1", endColorstr="#a9e299", GradientType=1);
        margin-right: 2px;
    }
    #streak_content, #wins_content {
        float: left;
        width: 175px;
        font-family: "Roboto Light", sans-serif;
        font-size: 16px;
        height: 35px;
        border-top: 1px solid #336026;
        background-color: #c1e4b6;
        padding: 0 6px 0 6px;
        line-height: 35px;
        text-align: left;
        margin-bottom: 2px;
    }
    #streak_content, #wins_content span {
        font-weight: normal;
    }
</style>
