<template>
    <div id="stats_container">
        <div id="title">game statistics</div>
        <div class="stats_title">total shots</div>
        <div id="bar_container">
            <div class="stats_num_left">{{ text_lekkerL }}</div>
            <div id="progress_left">
                <div id="bar_left" :style="{width: lekkerL+'%'}"></div>
            </div>
            <div class="stats_num_right">{{ text_lekkerR }}</div>
            <div id="progress_right">
                <div id="bar_right" :style="{width: lekkerR+'%'}"></div>
            </div>
        </div>
        <button @click="zetLekker">randomize BITCH</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                text_lekkerL: "0",
                text_lekkerR: "0",
                lekkerR: "0",
                lekkerL: "0",
            }
        },

        methods: {
          zetLekker() {
              setInterval(function() {
                  this.text_lekkerL = Math.floor(Math.random() * 100);
                  this.text_lekkerR = Math.floor(Math.random() * 100);
                  const totalVote = this.text_lekkerL + this.text_lekkerR;

                  // now set the bar lol
                  this.lekkerL = Math.round(this.text_lekkerL/totalVote * 100);
                  this.lekkerR = Math.round(this.text_lekkerR/totalVote * 100);
              }.bind(this), 500);
          }
        },

        name: "LoadingBar"
    }
</script>

<style scoped>
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
        font-family: 'Roboto', sans-serif;
        font-size: 13px;
        font-weight: bold;
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

    #progress_left {
        float: left;
        width: 505px;
        position: relative;
        animation: all 0.4s ease;
        background-color: #ebf0f6;
        margin-top: 5px;
    }

    #progress_right {
        float: right;
        width: 505px;
        position: relative;
        animation: all 0.4s ease;
        background-color: #ebf0f6;
        margin-top: 5px;
    }

    #bar_left {
        border-radius: 3px 0 0 3px;
        float:right;
        height: 6px;
        background-color: #00acff;
        width: 30%;
        transition: all 0.5s ease-out;
    }
    #bar_right {
        border-radius: 0 3px 3px 0;
        float:left;
        height: 6px;
        background-color: #8bed00;
        width: 30%;
        transition: all 0.5s ease-out;
    }
    #bar:hover {
        width: 100%;
    }

</style>
