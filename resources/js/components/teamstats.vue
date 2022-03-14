<template>
    <div class="teamstats_container">
        <div class="teamstats_header">team statistics</div>
        <!-- seperator -->
        <div class="separator_bar"></div>
    </div>
</template>

<script>
    export default {
        name: "teamstats",
        props: ['teamid']
    }
</script>

<style scoped>
    .teamstats_container {
        position: relative;
        margin-left: -9px;
        background: rgb(63,94,251);
        background: -moz-radial-gradient(circle, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%);
        background: -webkit-radial-gradient(circle, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%);
        background: radial-gradient(circle, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#3f5efb",endColorstr="#fc466b",GradientType=1);
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
