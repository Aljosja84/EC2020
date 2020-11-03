<template>
    <div>
        <div id="progress">
            <span id="percent">30%</span>
            <div id="bar" :style="{width: lekker}"></div>
        </div>
        <button @click="zetLekker">zetLekker</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                lekker: "30%"
            }
        },

        methods: {
          zetLekker() {
              this.lekker = "100%";
          }
        },

        name: "LoadingBar"
    }
</script>

<style scoped>
    #progress {
        float: left;
        width: 500px;
        border: 1px solid black;
        position: relative;
        padding: 3px;
        animation: all 0.4s ease;
    }

    #percent {
        position: absolute;
        left: 50%;
    }

    #bar {
        float:right;
        height: 20px;
        background-color: green;
        width: 30%;
        transition: all 0.4s ease;
    }
    #bar:hover {
        width: 100%;
    }

</style>
