<template>
    <div class="teamstats_container">
        <div v-bind:style="doneloading" class="loading_div_teamstats"><div id="pulseloader"/></div>
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
                        <donut-test v-if="!loading" v-bind:centertext="gamesCharts[0].total" v-bind:fontsize="24" v-bind:chart-data="this.gamesCharts[0]" :canvas_id="'played'+teamid"/>
                    </div>
                </div>
                <div class="games_chart_div">
                    <div class="games_title">wins</div>
                    <div class="games_chart">
                        <donut-test v-if="!loading" v-bind:centertext="gamesCharts[1].total" v-bind:fontsize="24" v-bind:chart-data="this.gamesCharts[1]" :canvas_id="'wins'+teamid"/>
                    </div>
                </div>
                <div class="games_chart_div">
                    <div class="games_title">draws</div>
                    <div class="games_chart">
                        <donut-test v-if="!loading" v-bind:centertext="gamesCharts[2].total" v-bind:fontsize="24" v-bind:chart-data="this.gamesCharts[2]" :canvas_id="'draws'+teamid"/>
                    </div>
                </div>
                <div class="games_chart_div">
                    <div class="games_title">loses</div>
                    <div class="games_chart">
                        <donut-test v-if="!loading" v-bind:centertext="gamesCharts[3].total" v-bind:fontsize="24" v-bind:chart-data="this.gamesCharts[3]" :canvas_id="'loses'+teamid"/>
                    </div>
                </div>
            </div>
            <div class="separator_div" style="float: left"></div>
            <div id="goals_container">
                <div id="for_container">
                    <span style="color: #8ba752">for</span>
                    <div class="for_title_bar"><span>home</span><span>away</span><span>total</span></div>
                    <div class="for_data_bar" v-if="!loading"><span>{{ teamStats[0]["goals"].for.total.home }}</span><span>{{ teamStats[0]["goals"].for.total.away }}</span><span>{{ teamStats[0]["goals"].for.total.total }}</span></div>
                    <div id="for_chart_container">
                        <bar-chart v-if="!loading" v-bind:chart-data="goalsCharts[0]" :canvas_id="'for_bar'+teamid"></bar-chart>
                    </div>
                </div>
                <div id="against_container">
                    <span style="color: #d4530d">against</span>
                    <div class="for_title_bar"><span>home</span><span>away</span><span>total</span></div>
                    <div class="for_data_bar" v-if="!loading"><span>{{ teamStats[0]["goals"].against.total.home }}</span><span>{{ teamStats[0]["goals"].against.total.away }}</span><span>{{ teamStats[0]["goals"].against.total.total }}</span></div>
                    <div id="against_chart_container">
                        <bar-chart v-if="!loading" v-bind:chart-data="goalsCharts[1]" :canvas_id="'against_bar'+teamid"></bar-chart>
                    </div>
                </div>

            </div>
            <div class="separator_div" style="float: left"></div>
            <div id="extra_container" v-if="!loading">
                <div id="biggest_container">
                    <div style="margin-bottom: 6px">biggest</div>
                    <div class="streak_header">streak</div>
                    <div class="streak_content"><span>win: {{ teamStats[0]["biggest"].streak.wins }} | draw: {{ teamStats[0]["biggest"].streak.draws }} | loss: {{ teamStats[0]["biggest"].streak.loses }}</span></div>
                    <div id="wins_header">wins</div>
                    <div id="wins_content"><span>home: {{ teamStats[0]["biggest"].wins.home }} | away: {{ teamStats[0]["biggest"].wins.away }}</span></div>
                    <!-- penalty data -->
                    <div style="margin-bottom: 6px">penalty</div>
                    <div class="streak_header">scored</div>
                    <div class="streak_content" style="width: 40px; text-align: center">{{ teamStats[0]["penalty"].scored.total }}</div>
                    <div class="streak_content" style="width: 133px; text-align: center">{{ teamStats[0]["penalty"].scored.percentage }}</div>
                    <div class="streak_header">missed</div>
                    <div class="streak_content" style="width: 40px; text-align: center">{{ teamStats[0]["penalty"].missed.total }}</div>
                    <div class="streak_content" style="width: 133px; text-align: center">{{ teamStats[0]["penalty"].missed.percentage }}</div>
                    <!-- miscellaneous -->
                    <div id="misc_header">
                        <div id="misc_home">home</div>
                        <div id="misc_away">away</div>
                        <div id="misc_total">total</div>
                    </div>
                    <div class="failed_to_score_header">failed to score</div>
                    <div class="fts_home">{{ teamStats[0]["failed_to_score"].home }}</div>
                    <div class="fts_away">{{ teamStats[0]["failed_to_score"].away }}</div>
                    <div class="fts_total">{{ teamStats[0]["failed_to_score"].total }}</div>
                    <div class="failed_to_score_header">clean sheet</div>
                    <div class="fts_home">{{ teamStats[0]["clean_sheet"].home }}</div>
                    <div class="fts_away">{{ teamStats[0]["clean_sheet"].away }}</div>
                    <div class="fts_total">{{ teamStats[0]["clean_sheet"].total }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script defer>
    import donutTest from "./donutTest";
    import BarChart from "./barchart";

    export default {
        name: "teamstats",
        props: ['teamid'],
        components: { donutTest, BarChart },

        data() {
            return {
                loading: true,
                loaded: false,
                gamesCharts: [],
                teamStats: [],
                goalsCharts: [],
                forGoalsArr: [],
                againstGoalsArr: []
            }
        },
        methods: {
            /*
            *
            * Call external api with team id
            *
            */
            loadTeamStats(e) {
                axios.get("https://v3.football.api-sports.io/teams/statistics?league=4&season=2020&team=" + e, {
                    headers: {
                        "X-RapidAPI-Host": process.env.MIX_API_URL,
                        "X-RapidAPI-Key": process.env.MIX_API_KEY
                    }
                }).then((response) => {
                    e = response.data.response;
                    /*
                    *
                    * doughnut charts
                    *
                    */
                    this.gamesCharts.push(
                        {
                        'total': e.fixtures.played.total,
                        'type': 'doughnut',
                        'data': {
                            'labels': ['home', 'away'],
                            'datasets': [
                                {
                                    'data': [e.fixtures.played.home, e.fixtures.played.away],
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
                    },

                        {
                            'total': e.fixtures.wins.total,
                            'type': 'doughnut',
                            'data': {
                                'labels': ['home', 'away'],
                                'datasets': [
                                    {
                                        'data': [e.fixtures.wins.home, e.fixtures.wins.away],
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
                        },

                        {
                            'total': e.fixtures.draws.total,
                            'type': 'doughnut',
                            'data': {
                                'labels': ['home', 'away'],
                                'datasets': [
                                    {
                                        'data': [e.fixtures.draws.home, e.fixtures.draws.away],
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
                        },

                        {
                            'total': e.fixtures.loses.total,
                            'type': 'doughnut',
                            'data': {
                                'labels': ['home', 'away'],
                                'datasets': [
                                    {
                                        'data': [e.fixtures.loses.home, e.fixtures.loses.away],
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
                        }
                    );
                    this.loaded = true;

                    /*
                    *
                    * bar charts
                    *
                    */
                    var forGoals = e.goals.for.minute;
                    var againstGoals = e.goals.against.minute;

                    // since api shows keys as numbers, which JS cannot parse we use a slight detour
                    for(const key in forGoals) { this.forGoalsArr.push(forGoals[key]) };
                    for(const key in againstGoals) { this.againstGoalsArr.push(againstGoals[key]) };
                    // push the goals in the array
                    this.goalsCharts.push(
                        {
                            type: 'bar',
                            data: {
                                labels: ["0-15", "16-30", "31-45", "46-60", "61-75", "76-90", "90+"],
                                datasets: [
                                    {
                                        indexAxis: 'x',
                                        label: "Goals",
                                        backgroundColor: ["#8ba752"],
                                        hoverBackgroundColor: ["#6b883b"],
                                        data:
                                        [
                                            this.forGoalsArr[0].total,
                                            this.forGoalsArr[1].total,
                                            this.forGoalsArr[2].total,
                                            this.forGoalsArr[3].total,
                                            this.forGoalsArr[4].total,
                                            this.forGoalsArr[5].total,
                                            this.forGoalsArr[6].total + this.againstGoalsArr[7].total
                                        ]
                                    }
                                ],
                            },
                            options: {
                                scales: {
                                    y: {
                                        display: true,
                                        beginAtZero: true
                                    }
                                }
                            }
                        },

                        {
                            type: 'bar',
                            data: {
                                labels: ["0-15", "16-30", "31-45", "46-60", "61-75", "76-90", "90+"],
                                datasets: [
                                    {
                                        indexAxis: 'x',
                                        label: "Goals",
                                        backgroundColor: ["#d4530d"],
                                        hoverBackgroundColor: ["#b43f06"],
                                        data:
                                            [
                                                this.againstGoalsArr[0].total,
                                                this.againstGoalsArr[1].total,
                                                this.againstGoalsArr[2].total,
                                                this.againstGoalsArr[3].total,
                                                this.againstGoalsArr[4].total,
                                                this.againstGoalsArr[5].total,
                                                this.againstGoalsArr[6].total + this.againstGoalsArr[7].total
                                            ]
                                    }
                                ],
                            },
                            options: {
                                scales: {
                                    y: {
                                        display: true,
                                        beginAtZero: true
                                    }
                                }
                            }
                        }
                    );

                    this.teamStats.push(e);
                    this.loading = false;

                }).catch((error) => {
                    console.log(error);
                });

            }
        },

        created() {
            //this.loadTeamStats(this.teamid)
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
        z-index: 1111;
        opacity: 100%;
        -webkit-transition: all 0.6s ease-in-out 0.1s;
        -moz-transition: all 0.6s ease-in-out 0.1s;
        -ms-transition: all 0.6s ease-in-out 0.1s;
        transition: all 0.6s ease-in-out 0.1s;
        visibility: visible;
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
    .streak_header, #wins_header {
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
    .streak_content, #wins_content {
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
        margin-right: 2px;
    }
    #streak_content, #wins_content span {
        font-weight: normal;
    }

    #misc_header {
        margin-right: 6px;
        margin-top: 6px;
        float: right;
        font-family: "Roboto Light", sans-serif;
        font-size: 16px;
        height: 35px;
        line-height: 35px;
    }
    #misc_home, #misc_away, #misc_total {
        float: left;
        margin-right: 2px;
        background-color: #c1e4b6;
        padding: 0 3px 0 4px;
    }

    .failed_to_score_header {
        width: 103px;
        float: left;
        clear: both;
        font-family: "Roboto Light", sans-serif;
        font-size: 16px;
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
    .fts_home, .fts_away, .fts_total {
        float: left;
        margin-right: 2px;
        background-color: transparent;
        text-align: center;
        font-family: "Roboto Light", sans-serif;
        font-size: 16px;
        height: 35px;
        line-height: 35px;
        width: 43px;
        font-weight: bold;
    }
</style>
