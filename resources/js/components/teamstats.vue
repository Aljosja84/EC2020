<template>
    <div class="teamstats_container">
        <div class="loading_div_teamstats" v-bind:style="doneloading"><div id="pulseloader"/></div>
        <div class="teamstats_header">team statistics</div>
        <!-- seperator -->
        <div class="separator_bar"></div>
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
        background: rgb(255,255,255);
        background: -moz-linear-gradient(180deg, rgba(255,255,255,1) 0%, rgba(203,211,113,1) 100%);
        background: -webkit-linear-gradient(180deg, rgba(255,255,255,1) 0%, rgba(203,211,113,1) 100%);
        background: linear-gradient(180deg, rgba(255,255,255,1) 0%, rgba(203,211,113,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff",endColorstr="#cbd371",GradientType=1);
        width: 975px;
        height: 435px;
        box-shadow: rgba(0, 0, 0, 0.16) 0 3px 6px, rgba(0, 0, 0, 0.23) 0 3px 6px;
    }

    .teamstats_header {
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
    }

    .separator_bar {
        height: 2px;
        background-image: linear-gradient(to right, transparent, #b5b5b5, transparent);
    }
</style>
