<template>
    <div id="events_container">
        <div class="timeline">
            <ul>
                <transition-group name="new_event">
                    <li class="homeTeam" v-bind:key="timer"><div class="homeTeamcontent"></div><div class="clock"><img :src="'/images/start_timer.png'"></div></li>
                    <li v-for="event in events" v-bind:class="whichteam(event)" v-bind:key="event.time.elapsed+event.type">
                        <div v-bind:class="whichteam(event) + 'content'">
                            <p v-html="notice(event)"></p>
                        </div>
                        <div v-bind:class="whichteam(event) + 'point'">{{ event.time.elapsed + '\'' }}</div>
                    </li>
                    <li v-show="fulltime" class="homeTeam" v-bind:key="fulltime"><div class="homeTeamcontent"></div><div class="fulltime">FULL TIME</div></li>
                </transition-group>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EventsWindow",

        props: {
            data: {
                default: 'loading...'
            }
        },

        data() {
            return {
                events: [],
                answer: '',
                hometeam: '',
                awayteam: '',
                timer: 'start',
                fulltime: false,
                priorSub: []
            }
        },

        methods: {
            addEvent() {
                this.fulltime = true;
            },

            notice(e) {
                if(e.team.id === this.hometeam) {
                    switch(e.type) {
                        case "Goal":
                            var answer = '<span style="color: #CCC">(' + e.detail + ')</span> ' + e.player.name + ' <img src=' + assetBaseUrl + 'images/goal.png />';
                            break;
                        case "Card":
                            var card = e.detail === 'Yellow Card' ? ' <img src=' + assetBaseUrl + 'images/yellowcard.png />' : ' <img src=' + assetBaseUrl + 'images/redcard.png />';
                            var answer = e.player.name + card;
                            break;
                        case "Var":
                            var answer ='<span style="color: #CCC">(' + e.detail + ')</span>' + e.player.name + '&nbsp;<img src=' + assetBaseUrl + 'images/var.png />';
                            break;
                        case "subst":
                            var answer = this.whichPlayerHome(e);
                            break;
                    }
                }   else {
                    switch(e.type) {
                        case "Goal":
                            var answer = '<img src=' + assetBaseUrl + 'images/goal.png /> ' + e.player.name + ' <span style="color: #CCC">(' + e.detail + ')</span>';
                            break;
                        case "Card":
                            var card = e.detail === 'Yellow Card' ? '<img src=' + assetBaseUrl + 'images/yellowcard.png /> ' : '<img src=' + assetBaseUrl + 'images/redcard.png /> ';
                            var answer = card + e.player.name;
                            break;
                        case "Var":
                            var answer = '<img src=' + assetBaseUrl + 'images/var.png />&nbsp;' + e.player.name + ' <span style="color: #CCC">(' + e.detail + ')</span>';
                            break;
                        case "subst":
                            var answer = this.whichPlayerAway(e);
                            break;
                    }
                }
                return answer;
            },

            whichteam(e) {
                // determine which team called the event.
                return e.team.id === this.hometeam ? 'homeTeam' : 'awayTeam';
            },

            whichPlayerHome(e) {
                /* --- notice: the API I'm consuming forced me to have this workaround ------*/
                // set teamname and the starting XI of that team
                var teamname = e.team.id;
                var team = this.fixture.lineups[0].startXI;
                // check if the event's player was in the starting XI
                // if so, that player will be subbed off in 99% of the cases
                for (var i = 0; i < team.length; ++i) {
                    if (team[i].player.id === e.player.id) {
                        // if the player was in the starting XI, set the subbed on player in the subbed list
                        // in case that player must also be subbed off due to injury or a coach's dismay
                        if (!this.priorSub.includes(e.assist.id))
                        {
                            this.priorSub.push(e.assist.id);
                        }
                        return '<span style="color: #CCC">' + e.player.name + '</span> <img src=' + assetBaseUrl + 'images/sub_off.png /> ' + e.assist.name + ' <img src=' + assetBaseUrl + 'images/sub_on.png />';
                    }
                }
                // check if the subbed player made a sub already
                if(this.priorSub.includes(e.player.id)) {
                    return '<span style="color: #CCC">' + e.player.name + '</span> <img src=' + assetBaseUrl + 'images/sub_off.png /> ' + e.assist.name + ' <img src=' + assetBaseUrl + 'images/sub_on.png />';
                }

                return '<span style="color: #CCC">' + e.assist.name + '</span> <img src=' + assetBaseUrl + 'images/sub_off.png /> ' + e.player.name + ' <img src=' + assetBaseUrl + 'images/sub_on.png />';
            },

            whichPlayerAway(e) {
                // set teamname and the starting XI of that team
                var teamname = e.teamName;
                var team = this.fixture.lineups[1].startXI;
                // check if the event's player was in the starting XI
                // if so, that player will be subbed off in 99% of the cases
                for (var i = 0; i < team.length; ++i) {
                    if (team[i].player.id === e.player.id) {
                        if (!this.priorSub.includes(e.assist.id))
                        {
                            this.priorSub.push(e.assist.id);
                        }
                        return '<img src=' + assetBaseUrl + 'images/sub_on.png /> ' + e.assist.name + ' <img src=' + assetBaseUrl + 'images/sub_off.png /><span style="color: #CCC"> ' + e.player.name + '</span>';
                    }
                }
                // check if the subbed player made a sub already
                if(this.priorSub.includes(e.player_id)) {
                    return '<img src=' + assetBaseUrl + 'images/sub_on.png /> ' + e.assist.name + ' <img src=' + assetBaseUrl + 'images/sub_off.png /><span style="color: #CCC"> ' + e.player.name + '</span>';
                }

                return '<img src=' + assetBaseUrl + 'images/sub_on.png /> ' + e.player.name + ' <img src=' + assetBaseUrl + 'images/sub_off.png /><span style="color: #CCC"> ' + e.assist.name + '</span>';
            },

        },

        computed: {

        },

        watch: {
            data: {
                // here we check for changes
                immediate: false,
                handler() {
                    this.fixture = this.data;
                    this.events = this.data.events;
                    this.fulltime = this.data.fixture.status.short === 'FT';
                    this.hometeam = this.data.teams.home.id;
                    this.awayteam = this.data.teams.away.id;
                }
            }
        }
    }
</script>

<style scoped>
    .new_event-enter-active .new_event-leave-active{
        transition: all 0.3s;
    }
    .new_event-enter {
        opacity: 0;
    }
    .new_event-enter-to {
        opacity: 1;
    }

    #events_container {
        width: 586px;
        height: 588px;
        background-color: #ffffff;
        padding: 25px 0 0 5px;
        overflow-y: auto;
    }

    .timeline {
        position: relative;
        width: 100%;
    }

    .homeTeam{
        margin-bottom: 20px;
        list-style-type: none;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .homeTeampoint {
        min-width: 28px;
        height: 20px;
        background-color: #d7dff7;
        border-radius: 4px 4px 4px 4px;
        z-index: 2;
        position: relative;
        left: -13px;
        text-align: center;
        font-family: 'Terminal Dosis', sans-serif;
        color: #515151;
        font-size: 14px;
        padding-top: 2px;
    }

    .awayTeampoint {
        min-width: 28px;
        height: 20px;
        background-color: #d7dff7;
        border-radius: 4px 4px 4px 4px;
        z-index: 2;
        position: relative;
        left: 15px;
        text-align: center;
        font-family: 'Terminal Dosis', sans-serif;
        color: #515151;
        font-size: 14px;
        padding-top: 2px;
    }

    .clock {
        background-color: #ffffff;
        border-radius: 4px 4px 4px 4px;
        height: 21px;
        z-index: 2;
        position: relative;
        left: -8px;
        text-align: center;
        font-family: 'Terminal Dosis', sans-serif;
        color: #515151;
        font-size: 14px;
        padding-top: 2px;
    }

    .fulltime {
        background-color: #ffffff;
        border-radius: 4px 4px 4px 4px;
        height: 21px;
        z-index: 2;
        position: relative;
        left: -25px;
        text-align: center;
        color: #515151;
        font-size: 14px;
        line-height: 14px;
        padding-top: 0;
    }

    .timeline ul li {
        font-family: 'Terminal Dosis', sans-serif;
        color: #515151;
        font-size: 14px;
        height: auto;
        transition: 0.3s all linear;
    }
    .timeline ul li .homeTeamcontent {
        width: 50%;
        padding: 0 0;
        background-color: #ffffff;
    }

    .timeline ul li .awayTeamcontent {
        width: 50%;
        padding: 0 10px 0;
        background-color: #ffffff;
    }


    .timeline ul li .homeTeamcontent p {
        padding: 0 40px;
        margin-top: 0;
        text-align: right;
        width: 100%;
    }

    .timeline ul li .awayTeamcontent p {
        padding: 0 0 0 40px;
        margin-top: 0;
        text-align: left;
        width: 100%;
    }

    .awayTeam {
        margin-bottom: 20px;
        list-style-type: none;
        display: flex;
        flex-direction: row-reverse;
        align-items: center;
    }

    .timeline::before {
        content: "";
        position: absolute;
        height: 100%;
        width: 1px;
        left: 50%;
        background-color: #d7dff7;
    }
</style>
