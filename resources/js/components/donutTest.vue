<template>
    <div class="relative" id="canvas_div">
        <canvas :id=this.canvas_id></canvas>
        <div class="absolute-center text-center">
            <p>{{ centertext }}</p>
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js/auto'
    export default {
        name: "donutTest",

        props: ['chartData', 'options', 'centertext','canvas_id'],

        mounted() {
            const ctx = document.getElementById(this.canvas_id);
            const jelle = new Chart(ctx, this.chartData);
        },
    }
</script>

<style scoped>
    .relative {
        position: relative;
    }

    .absolute-center {
        position:absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -55%);
    }

    .text-center{
        text-align: center;
        z-index: 0;
    }

    p {
        font-family: 'Oswald', sans-serif;
        font-size: 34px;
        color: #515151;
    }
    canvas {
        position: relative;
        z-index: 1;
    }
</style>
