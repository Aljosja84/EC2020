<template>
    <div>
        <div>
            <ul class="games_window" ref="list">
                <li v-for="(date, index) in sortedDates" :key="index" class="group">
                    {{ formatDate(date) }}
                    <ul>
                        <li v-for="game in sortedGames(date)" :key="game.id" class="game" :id="game.api_id" @mouseenter="onOptionMouseMove($event, game.api_id)">
                            <img :src="getFlagUrl(game.home_team.flag_url)"><span>{{ game.home_team.name }}</span><span> VS </span><span>{{ game.away_team.name }}</span><img :src="getFlagUrl(game.away_team.flag_url)">
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "followedGamesDropdown",

        props: ['followedgames'],

        methods: {
            formatDate(date) {
                // You may use a library like moment.js to format dates, or use JavaScript Date methods
                const dateString =  new Date(date).toLocaleDateString();
                const dateParts = dateString.split('-');
                const year = parseInt(dateParts[2]);
                const month = parseInt(dateParts[1]) - 1; // Months are zero-based in JavaScript
                const day = parseInt(dateParts[0]);

                const datum = new Date(year, month, day);

                const options = { weekday: 'long', month: 'long', day: 'numeric' };
                return datum.toLocaleDateString('en-US', options);
            },

            formatTime(dateTime) {
                // Convert dateTime to Amsterdam time zone
                // and make the clock 24 hours instead of AM or PM
                const amsterdamTime = new Date(dateTime);
                const amsterdamOptions = { timeZone: 'Europe/Amsterdam', hour12: false, hour: '2-digit', minute: '2-digit' };
                return amsterdamTime.toLocaleTimeString('nl-NL', amsterdamOptions);
            },

            sortedGames(date) {
                // Sort games within each group (date) based on their times
                return this.groupedGames[date].sort((a, b) => new Date(a.game_date) - new Date(b.game_date));
            },

            onOptionMouseMove(event, index) {
                const element = document.getElementById(index);
                if (element) {
                    const listContainer = this.$refs.list;
                    element.scrollIntoView && element.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
                }
            },
            getFlagUrl(flagUrl) {
                // Construct full URL for flag image
                return `/images/${flagUrl}`;
            },
        },

        computed: {
            groupedGames() {
                // Group games by date
                const grouped = {};
                this.followedgames.forEach(game => {
                    const date = game.game_date.split('T')[0]; // Extract date without time
                    if (!grouped[date]) {
                        grouped[date] = [];
                    }
                    grouped[date].push(game);
                });
                return grouped;
            },
            sortedDates() {
                // Sort dates in ascending order
                return Object.keys(this.groupedGames).sort();
            }
        },
    }
</script>

<style scoped>
    .games_window {
        font-family: "Roboto", sans-serif;
        font-size: 13px;
        margin: 3px;
        border: 1px solid #eee;
        height: fit-content;
        max-height: 300px;
        overflow-y: auto;
        transition: all 0.3s ease-out;
        /* scrollbar vars */
        --scrollbarBG: #90A4AE;
        --thumbBG: #90A4AE;
        scroll-behavior: smooth;
        border-radius: 5px;
        /* shadow */
        box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
    }
    .games_window::-webkit-scrollbar {
        width: 7px;
    }

    .games_window::-webkit-scrollbar-track {
        background: var(--scrollbarBG);
        display: none;
        -webkit-box-shadow: none;
    }
    .games_window::-webkit-scrollbar-thumb {
        background-color: var(--thumbBG) ;
        border-radius: 6px;
        border: 3px solid var(--scrollbarBG);
    }

    .games_window ul {
        list-style: none;

    }

    .group {
        font-family: 'Roboto', sans-serif;
        font-weight: bold;
        font-size: 14px;
        color: #9badbf;
        padding: 2px 2px 2px 10px;
    }

    .autocomplete-results li:last-child {
        margin-bottom: 5px;
    }

    .game {
        font-family: "Roboto", sans-serif;
        font-size: 13px;
        font-weight: normal;
        list-style: none;
        text-align: left;
        padding: 5px 2px 5px 7px;
        margin: 0 2px 0 2px;
        cursor: pointer;
        transition: all 0.3s ease-out;
        border-radius: 5px;
        display: flex;
        justify-content: space-around;
        align-items: center;


    }

    .game img {
        width: 16px;
        height: 16px;
    }

    .game.is-active,
    .game:hover {
        background-color: #e6f3ff;
        color: slategray;
    }
</style>
