<template>
    <div id="events_container">
        <div class="timeline">
            <ul>
                <transition-group name="new_event">
                    <li v-for="event in events" class="homeTeam" v-bind:key="event.event">
                        <div class="contentLeft">
                            <p>{{ event.event }}</p>
                        </div>
                        <div class="point-home">{{ event.time }}</div>
                    </li>
                </transition-group>
            </ul>
        </div>
        <button @click="addEvent">add goal Ziyech</button>
    </div>
</template>

<script>
    export default {
        name: "EventsWindow",
        data() {
            return {
                events: [{event: "test1", time: "12'"}, {event: "test2", time: "13'"}, {event: "test3", time: "80'"}]
            }
        },
        methods: {
            addEvent() {
                this.events.push({event: "H. Ziyech", time: "92'"});
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
        width: 588px;
        height: 588px;
        background-color: #ffffff;
        padding: 25px 0 0 45px;
    }

    .timeline {
        position: relative;
        width: 90%;
    }

    .homeTeam{
        margin-bottom: 20px;
        list-style-type: none;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .point-home {
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

    .point-away {
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

    .timeline ul li {
        font-family: 'Roboto', sans-serif;
        color: #515151;
        font-size: 14px;
        height: auto;
        transition: 0.3s all linear;
    }
    .timeline ul li .contentLeft {
        width: 50%;
        padding: 0 0;
    }

    .timeline ul li .contentRight {
        width: 50%;
        padding: 0 10px 0;
    }


    .timeline ul li .contentLeft p {
        padding: 0 60px;
        margin-top: 0;
        text-align: right;
    }

    .timeline ul li .contentRight p {
        padding: 0 0 0 50px;
        margin-top: 0;
        text-align: left;
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

