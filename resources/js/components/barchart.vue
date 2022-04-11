<template>
    <div class="relative" id="canvas_div">
        <canvas height="305" :id=this.canvas_id></canvas>
    </div>
</template>

<script>
    import Chart from 'chart.js/auto'

    // setting some default options for the bar chart
    Chart.defaults.scale.grid.display = true;
    Chart.defaults.plugins.decimation.enabled = false;
    Chart.defaults.scale.ticks.precision = 0;
    Chart.defaults.plugins.legend.display = false;
    Chart.defaults.font.size = 10;
    Chart.defaults.color = "#000";

    export default {
        name: "barchart",

        props: ['chartData', 'options', 'centertext','canvas_id', 'fontsize'],

        mounted() {
            const ctx = document.getElementById(this.canvas_id);
            const jelle = new Chart(ctx, this.chartData);
        }
    }
</script>

<style scoped>
    .relative {
        margin-top: 3px;
        position: relative;
    }

    canvas {
        position: relative;
        z-index: 1;
    }
</style>
