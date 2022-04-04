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
            <div id="games_container">games</div>
            <div class="separator_div" style="float: left"></div>
            <div id="goals_container">goals</div>
            <div class="separator_div" style="float: left"></div>
            <div id="extra_container">extra</div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "teamstats",
        props: ['teamid'],

        data() {
            return {
                loading: false
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
</style>
