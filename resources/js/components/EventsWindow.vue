<template>
    <div id="events_container">
        <div class="timeline">
            <ul>
                <transition-group name="new_event">
                    <li class="homeTeam" v-bind:key="timer"><div class="homeTeamcontent"></div><div class="clock"><img src="images/start_timer.png"/></div></li>
                    <li v-for="event in events" v-bind:class="whichteam(event)" v-bind:key="event.elapsed+event.type">
                        <div v-bind:class="whichteam(event) + 'content'">
                            <p v-html="notice(event)"></p>
                        </div>
                        <div v-bind:class="whichteam(event) + 'point'">{{ event.elapsed + '\'' }}</div>
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
        data() {
            return {
                events: [],
                answer: '',
                hometeam: '',
                awayteam: '',
                timer: 'start',
                fulltime: false
            }
        },
        methods: {
            addEvent() {
                this.fulltime = true;
                },

            notice(e) {
                if(e.team_id === this.hometeam) {
                    switch(e.type) {
                        case "Goal":
                            var answer = '<span style="color: #CCC">(' + e.detail + ')</span> ' + e.player + ' <img src="images/goal.png" />';
                            break;
                        case "Card":
                            var card = e.detail === 'Yellow Card' ? ' <img src="images/yellowcard.png" />' : ' <img src="images/redcard.png" />';
                            var answer = e.player + card;
                            break;
                        case "subst":
                            var answer = '<span style="color: #CCC">' + e.assist + '</span> <img src="images/sub_off.png" /> ' + e.player + ' <img src="images/sub_on.png" />';
                            break;
                    }
                }   else {
                    switch(e.type) {
                        case "Goal":
                            var answer = '<img src="images/goal.png" /> ' + e.player + ' <span style="color: #CCC">(' + e.detail + ')</span>';
                            break;
                        case "Card":
                            var card = e.detail === 'Yellow Card' ? '<img src="images/yellowcard.png" /> ' : '<img src="images/redcard.png" /> ';
                            var answer = card + e.player;
                            break;
                        case "subst":
                            var answer = '<img src="images/sub_on.png" /> ' + e.player + ' <img src="images/sub_off.png" /><span style="color: #CCC"> ' + e.assist + '</span>';
                            break;
                    }
                }
                return answer;
            },

            whichteam(e) {
                return e.team_id === this.hometeam ? 'homeTeam' : 'awayTeam';
            }

        },
        computed: {

        },

        mounted() {
            axios.get("https://v2.api-football.com/fixtures/id/573209", {
                headers: {
                    "X-RapidAPI-Host": "api-football-v1.p.rapidapi.com",
                    "X-RapidAPI-Key": "b1ae4a3fca89630148dadaa295a0b5b7"
                }
            }).then((response)=> {
                this.events = response.data.api.fixtures[0].events;
                this.fulltime = response.data.api.fixtures[0].statusShort === 'FT';
                this.hometeam = response.data.api.fixtures[0].homeTeam.team_id;
                this.awayteam = response.data.api.fixtures[0].awayTeam.team_id;
                console.log(response);
            })
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
        font-family: 'Roboto', sans-serif;
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
        font-family: 'Roboto', sans-serif;
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
        font-family: 'Roboto', sans-serif;
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
        font-family: 'Roboto', sans-serif;
        color: #515151;
        font-size: 13px;
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

