<template>
    <div class="relative" id="canvas_div">
        <canvas :id=this.canvas_id></canvas>
        <div class="absolute-center text-center">
            <p :style="style">{{ centertext }}</p>
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js/auto'
    export default {
        name: "donutTest",

        props: ['chartData', 'options', 'centertext','canvas_id', 'fontsize'],

        mounted() {
            const ctx = document.getElementById(this.canvas_id);
            const jelle = new Chart(ctx, this.chartData);
        },

        computed: {
            style() {
                return "font-family:'Oswald', sans-serif; color: #515151; font-size: " + this.fontsize +'px';
            }
        }
    }
</script>

<style scoped>
    .relative {
        position: relative;
    }

    .absolute-center {
        position:absolute;
        top: 53%;
        left: 49%;
        transform: translate(-50%, -55%);
    }

    .text-center{
        text-align: center;
        z-index: 0;
    }

    canvas {
        position: relative;
        z-index: 1;
    }
</style>
