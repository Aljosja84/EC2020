<template>
    <div id="events_container">
        <div class="timeline">
            <ul>
                <li class="homeTeam">
                    <div class="contentLeft">
                        <p>lol</p>
                    </div>
                    <div class="point-home">22'</div>
                </li>
                <li class="awayTeam">
                    <div class="contentRight">
                        <p>dit is een lange tekst</p>
                    </div>
                    <div class="point-away">25'</div>
                </li>
                <li class="homeTeam">
                    <div class="contentLeft">
                        <p>Event 3 Description</p>
                    </div>
                    <div class="point-home">35'</div>
                </li>
                <li class="homeTeam">
                    <div class="contentLeft">
                        <p>H. Ziyech</p>
                    </div>
                    <div class="point-home">42'</div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EventsWindow"
    }
</script>

<style scoped>
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

