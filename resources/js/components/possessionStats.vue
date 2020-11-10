<template>
    <div>
        <div class="stats_title">possession</div>
        <div class="bar_container">
            <div class="stats_num_left">{{ possession_home }}</div>
            <div class="progress_left">
                <div class="bar_left" :style="{width: possession_home}"></div>
            </div>
            <div class="stats_num_right">{{ possession_away }}</div>
            <div class="progress_right">
                <div class="bar_right" :style="{width: possession_away}"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "possessionStats",
        props: ['stats'],
        data() {
            return {
                possession_home: '0',
                possession_away: '0'            }
        },

        watch: {
            stats: {
                immediate: true,
                handler() {
                    this.possession_home = this.stats["Ball Possession"].home;
                    this.possession_away = this.stats["Ball Possession"].away;

                }
            }
        },

    }
</script>
