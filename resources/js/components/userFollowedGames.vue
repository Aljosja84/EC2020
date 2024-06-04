<template>
    <div>
        <div id="filter_horizontal">
            <div id="filter_columns">
                <div class="gamedays_header">
                    followed games by date
                </div>
                <div id="gamedays_container">
                    <div v-for="date in gamesdates" class="gamedate_option">
                        <span>
                            {{ formatDate(date.date) }}
                            <span v-if="followedGamesByDate[date.date]" style="color: darkorange">[ {{ followedGamesByDate[date.date].length }} ]</span>
                        </span>
                    </div>
                </div>
                <div class="gamedays_header">
                    followed games by teams
                </div>
                <div id="filter_teams">
                    <div class="flag-container">
                        <div v-for="country in countries" class="flag-item">
                            <img :src="countryFlag(country)" class="flag-img">
                        </div>
                    </div>
                </div>
            </div>
            <div class="filter_games">
                <div ref="list" id="allgames_container">
                    <div v-for="(date, index) in sortedDates" :key="index">
                        <div class="allgames_date_header">{{ formatDate(date) }}</div>
                        <div class="allgames_date_container">
                            <div v-for="game in sortedGames(date)" :key="game.id"  :id="game.api_id" class="button non_active">
                                <div class="button_column">
                                    <div class="button_flex">
                                        <span class="separator">{{ game.home_team.abv }}</span><img class="teamflagimg" :src="getFlagUrl(game.home_team.flag_url)"><span class="separator_vs">vs</span><img class="teamflagimg" :src="getFlagUrl(game.away_team.flag_url)"><span class="separator">{{ game.away_team.abv }}</span>
                                    </div>
                                    <div class="button_extra_info">
                                        <div>{{ formatTime(game.game_date) }}, {{ game.stadium.city}}</div>
                                        <div>{{ game.stadium.name }}</div>
                                    </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "userFollowedGames",

        props: {
            'user' :            Object,
            'gamesdates' :      Array,
            'followedgames' :   Array,
            'countries' :       Array,
            'games' :           Array,
        },

        data() {
            return {

            }
        },

        methods: {
            formatDate(dateString) {
                // Parse the date string into a Date object
                const date = new Date(dateString);

                // Define arrays for days of the week and months
                const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

                // Extract day of the week, month, and day of the month
                const dayOfWeek = daysOfWeek[date.getDay()];
                const month = months[date.getMonth()];
                const dayOfMonth = date.getDate();

                // Format the date as 'Friday June 11'
                return `${dayOfWeek} ${month} ${dayOfMonth}`;
            },

            formatTime(dateString) {
                // Create a new Date object from the given string
                const date = new Date(dateString);

                // Get the hours and minutes from the Date object
                const hours = date.getHours().toString().padStart(2, '0');
                const minutes = date.getMinutes().toString().padStart(2, '0');

                // Combine hours and minutes into the desired format
                return `${hours}:${minutes}`;
            },

            countryFlag(e) {
                return "/images/" + e.flag_url;
            },

            sortedGames(date) {
                // Sort games within each group (date) based on their times
                return this.groupedGames[date].sort((a, b) => new Date(a.game_date) - new Date(b.game_date));
            },

            getFlagUrl(flagUrl) {
                // Construct full URL for flag image
                return `/images/${flagUrl}`;
            },

        },

        computed: {
            followedGamesByDate() {
                return this.followedgames.reduce((acc, game) => {
                    const date = game.game_date.split('T')[0];
                    if(!acc[date]) {
                        acc[date] = [];
                    }
                    acc[date].push(game);
                    const plural = acc.length > 1 ? 'games' : 'game';
                    return acc;
                }, {});
            },

            groupedGames() {
                // Group games by date
                const grouped = {};
                this.games.forEach(game => {
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
            },

            resultStyle() {
                return this.resultWin === true ? 'opacity: 100%; visibility: visible'
                    : 'opacity: 0%; visibility: hidden';
            }

        }

    }
</script>

<style scoped>
    .gamedays_header {
        width: 220px;
        height: 50px;
        background-image: url("/images/light_wool.png");
        font-family: 'Oswald', sans-serif;
        font-size: 18px;
        color: #515151;
        text-transform: uppercase;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #filter_horizontal {
        display: flex;
        justify-content: left;
    }

    #filter_columns {
        display: flex;
        flex-direction: column;
    }

    #filter_teams {
        width: 220px;
        height: fit-content;
        background-color: whitesmoke;
        box-shadow: rgba(0, 0, 0, 0.16) 0 3px 6px, rgba(0, 0, 0, 0.23) 0 3px 6px;
        padding: 2px 2px 2px 2px;
        border-radius: 3px;
    }

    .filter_games {
        margin-left: 10px;
        width: 610px;
        height: calc(100vh - 75px); /* 100% of the viewport height minus the header height */
        background-color: whitesmoke;
        box-shadow: rgba(0, 0, 0, 0.16) 0 3px 6px, rgba(0, 0, 0, 0.23) 0 3px 6px;
        padding: 2px 2px 2px 2px;
        border-radius: 3px;
        overflow-y: scroll;
        scroll-behavior: smooth;
        /* scrollbar vars */
        --scrollbarBG: #90A4AE;
        --thumbBG: #90A4AE;
    }
    .filter_games::-webkit-scrollbar {
        width: 7px;
    }

    .filter_games::-webkit-scrollbar-track {
        background: var(--scrollbarBG);
        display: none;
        -webkit-box-shadow: none;
    }
    .filter_games::-webkit-scrollbar-thumb {
        background-color: var(--thumbBG) ;
        border-radius: 6px;
        border: 3px solid var(--scrollbarBG);
    }


    .allgames_date_header {
        width: 100%;
        height: 45px;
        background-image: url("/images/light_wool.png");
        color: #515151;
        font-family: 'Oswald', sans-serif;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-transform: uppercase;
    }

    .allgames_date_container {
        height: 200px;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        justify-items: center;
        -webkit-user-select: none; /* Chrome, Safari, Opera */
        -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
        user-select: none; /* Non-prefixed version */
    }

    .flag-container {
        display: grid;
        grid-template-columns: repeat(5, 1fr); /* 5 equal-width columns */
        grid-template-rows: repeat(4, 1fr); /* 4 equal-height rows */
        grid-gap: 10px; /* Optional gap between grid items */
    }

    .flag-item {
        background-color: whitesmoke; /* Optional background color for better visibility */
        padding: 2px; /* Optional padding for content */
    }

    .flag-img {
        filter: drop-shadow(0px 2px 2px rgba(0, 0, 0, 0.5));
        width: 27px; height: 27px;
    }

    .teamflagimg {
        filter: drop-shadow(0px 1px 1px rgba(0, 0, 0, 0.5));
        width: 23px; height:23px;
    }

    #gamedays_container {
        width: 220px;
        height: fit-content;
        background-color: whitesmoke;
        box-shadow: rgba(0, 0, 0, 0.16) 0 3px 6px, rgba(0, 0, 0, 0.23) 0 3px 6px;
        padding: 2px 2px 2px 2px;
        border-radius: 3px;
        margin-bottom: 10px;
    }

    .gamedate_option {
        display: flex;
        align-items: center;
        justify-content: left;
        width: 100%;
        height: 30px;
        font-family: "Terminal Dosis", sans-serif;
        font-size: 14px;
        color: slategray;
        line-height: 14px;
        cursor: pointer;
        transition: all 0.3s ease-out;
        border-radius: 5px;
        -webkit-user-select: none; /* Chrome, Safari, Opera */
        -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
        user-select: none; /* Non-prefixed version */
    }

    .gamedate_option span {
        padding: 5px 0 5px 5px;
    }

    .gamedate_option.is-active,
    .gamedate_option:hover {
        background-color: #cde5fc;
        color: slategray;
        padding-left: 5px;
    }

    .button {
        font-family: "Terminal Dosis", sans-serif;
        font-size: 14px;
        color: slategray;
        background-color: white;
        cursor: pointer;
        width: fit-content;
        padding: 0 6px 0 6px;
        height: 100px;
        border-radius: 16px;
        border: 1px solid #e5e5e5;
        border-bottom: 5px solid #e5e5e5;
        transition: color 0.4s, background-color 0.4s, transform 0.4s, opacity 0.4s, margin 0.4s, padding 0.4s, border-color 0.4s, filter 0.4s;
        user-select: none;
        text-transform: uppercase;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .non_active {
        color: slategray;
        filter: grayscale(100%);
    }

    .button:hover {
        background-color: #ddf4ff;
        border-color: #1cb0f6;
        color: #515151;
        filter: grayscale(0%);
    }

    .button:active {
        border-bottom: 1px solid #1cb0f6;
    }

    .button_flex {
        display: flex;
        justify-items: center;
        align-content: center;
    }

    .button_column {
        display: flex;
        flex-direction: column;
        justify-items: center;
        align-content: center;
    }

    .button_extra_info {
        margin-top: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        font-size: 12px;
        text-transform: initial !important;
    }

    .separator {
        margin: 3px;
    }
    .separator_vs {
        margin: 5px;
        text-transform: lowercase !important;
    }

</style>
