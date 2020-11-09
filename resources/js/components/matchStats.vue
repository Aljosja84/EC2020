<template>
    <div id="stats_container">
        <div id="title">game statistics</div>

        <div class="stats_title">total shots</div>
        <div class="bar_container">
            <div class="stats_num_left">{{ total_shots_home }}</div>
            <div class="progress_left">
                <div class="bar_left" :style="{width: total_shots_home_bar+'%'}"></div>
            </div>
            <div class="stats_num_right">{{ total_shots_away }}</div>
            <div class="progress_right">
                <div class="bar_right" :style="{width: total_shots_away_bar+'%'}"></div>
            </div>
        </div>

        <div class="stats_title">shots on goal</div>
        <div class="bar_container">
            <div class="stats_num_left">{{ shots_on_goal_home }}</div>
            <div class="progress_left">
                <div class="bar_left" :style="{width: shots_on_goal_home_bar+'%'}"></div>
            </div>
            <div class="stats_num_right">{{ shots_on_goal_away }}</div>
            <div class="progress_right">
                <div class="bar_right" :style="{width: shots_on_goal_away_bar+'%'}"></div>
            </div>
        </div>

        <div class="stats_title">fouls</div>
        <div class="bar_container">
            <div class="stats_num_left">{{ fouls_home }}</div>
            <div class="progress_left">
                <div class="bar_left" :style="{width: fouls_home_bar+'%'}"></div>
            </div>
            <div class="stats_num_right">{{ fouls_away }}</div>
            <div class="progress_right">
                <div class="bar_right" :style="{width: fouls_away_bar+'%'}"></div>
            </div>
        </div>

        <div class="stats_title">corner kicks</div>
        <div class="bar_container">
            <div class="stats_num_left">{{ corners_home }}</div>
            <div class="progress_left">
                <div class="bar_left" :style="{width: corners_home_bar+'%'}"></div>
            </div>
            <div class="stats_num_right">{{ corners_away }}</div>
            <div class="progress_right">
                <div class="bar_right" :style="{width: corners_away_bar+'%'}"></div>
            </div>
        </div>

        <div class="stats_title">offsides</div>
        <div class="bar_container">
            <div class="stats_num_left">{{ offside_home }}</div>
            <div class="progress_left">
                <div class="bar_left" :style="{width: offside_home_bar+'%'}"></div>
            </div>
            <div class="stats_num_right">{{ offside_away }}</div>
            <div class="progress_right">
                <div class="bar_right" :style="{width: offside_away_bar+'%'}"></div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                /* total shots ---------------- */
                total_shots_home: 0,
                total_shots_away: 0,
                total_shots: 0,
                total_shots_home_bar: 0,
                total_shots_away_bar: 0,
                /* shots on goal ---------------*/
                shots_on_goal_home: 0,
                shots_on_goal_away: 0,
                total_shots_on_goal: 0,
                shots_on_goal_home_bar: 0,
                shots_on_goal_away_bar: 0,
                /* fouls -----------------------*/
                fouls_home: 0,
                fouls_away: 0,
                total_fouls: 0,
                fouls_home_bar: 0,
                fouls_away_bar: 0,
                /* corner -----------------------*/
                corners_home: 0,
                corners_away: 0,
                total_corners: 0,
                corners_home_bar: 0,
                corners_away_bar: 0,
                /* offsides ---------------------*/
                offside_home: 0,
                offside_away: 0,
                total_offside: 0,
                offside_home_bar: 0,
                offside_away_bar: 0,
            }
        },

        mounted() {
            axios.get("https://v2.api-football.com/fixtures/id/573209", {
                headers: {
                    "X-RapidAPI-Host": "api-football-v1.p.rapidapi.com",
                    "X-RapidAPI-Key": "b1ae4a3fca89630148dadaa295a0b5b7"
                }
            }).then((response)=> {
                var stats = response.data.api.fixtures[0].statistics;
                /* total shots -----------------------------------------------------------------------------------*/
                this.total_shots_home = parseInt(stats["Total Shots"].home);
                this.total_shots_away = parseInt(stats["Total Shots"].away);
                this.total_shots = this.total_shots_home + this.total_shots_away;
                this.total_shots_home_bar = Math.round(this.total_shots_home/this.total_shots * 100);
                this.total_shots_away_bar = Math.round(this.total_shots_away/this.total_shots * 100);
                /* shots on goal ---------------------------------------------------------------------------------*/
                this.shots_on_goal_home = parseInt(stats["Shots on Goal"].home);
                this.shots_on_goal_away = parseInt(stats["Shots on Goal"].away);
                this.total_shots_on_goal = this.shots_on_goal_home + this.shots_on_goal_away;
                this.shots_on_goal_home_bar = Math.round(this.shots_on_goal_home/this.total_shots_on_goal * 100);
                this.shots_on_goal_away_bar = Math.round(this.shots_on_goal_away/this.total_shots_on_goal * 100);
                /* fouls -----------------------------------------------------------------------------------------*/
                this.fouls_home = parseInt(stats["Fouls"].home);
                this.fouls_away = parseInt(stats["Fouls"].away);
                this.total_fouls = this.fouls_home + this.fouls_away;
                this.fouls_home_bar = Math.round(this.fouls_home/this.total_fouls * 100);
                this.fouls_away_bar = Math.round(this.fouls_away/this.total_fouls * 100);
                /* corner kicks ----------------------------------------------------------------------------------*/
                this.corners_home = parseInt(stats["Corner Kicks"].home);
                this.corners_away = parseInt(stats["Corner Kicks"].away);
                this.total_corners = this.corners_home + this.corners_away;
                this.corners_home_bar = Math.round(this.corners_home/this.total_corners * 100);
                this.corners_away_bar = Math.round(this.corners_away/this.total_corners * 100);
                /* offsides --------------------------------------------------------------------------------------*/
                this.offside_home = parseInt(stats["Offsides"].home);
                this.offside_away = parseInt(stats["Offsides"].away);
                this.total_offside = this.offside_home + this.offside_away;
                this.offside_home_bar = Math.round(this.offside_home/this.total_offside * 100);
                this.offside_away_bar = Math.round(this.offside_away/this.total_offside * 100);
            })
        },


        name: "LoadingBar"
    }
</script>

<style scoped>
    .bar_container {
        padding-bottom: 5px;
    }
    .stats_num_left {
        float:left;
        color: #a3a7ab;
        font-family: 'Roboto', sans-serif;
        font-size: 13px;
        width: 35px;
        text-align: center;
        padding: 0 15px 0 0;
        margin-left: 10px
    }

    .stats_num_right {
        float: right;
        color: #a3a7ab;
        font-family: 'Roboto', sans-serif;
        font-size: 13px;
        width: 35px;
        text-align: center;
        padding: 0 0 0 15px;
        margin-right: 10px;
    }

    .stats_title {
        font-family: 'Oswald', sans-serif;
        font-size: 13px;
        text-align: center;
        margin: 10px 0 2px 0;
    }

    #title {
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        text-transform: uppercase;
        text-align: center;
        color: #515151;
        border-bottom: 1px solid #CCC;
    }

    #stats_container {
        width: 1100px;
        height: 475px;
        background-color: white;
    }

    .progress_left {
        float: left;
        width: 505px;
        position: relative;
        animation: all 0.4s ease;
        background-color: #ebf0f6;
        margin-top: 5px;
    }

    .progress_right {
        float: right;
        width: 505px;
        position: relative;
        animation: all 0.4s ease;
        background-color: #ebf0f6;
        margin-top: 5px;
    }

    .bar_left {
        border-radius: 3px 0 0 3px;
        float:right;
        height: 6px;
        background-color: #00acff;
        width: 30%;
        transition: all 0.5s ease-out;
    }
    .bar_right {
        border-radius: 0 3px 3px 0;
        float:left;
        height: 6px;
        background-color: #8bed00;
        width: 30%;
        transition: all 0.5s ease-out;
    }
</style>
