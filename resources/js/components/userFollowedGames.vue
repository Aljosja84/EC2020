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
            <div id="filter_games">
                <ul ref="list">
                    <li v-for="(date, index) in sortedDates" :key="index" >
                        {{ formatDate(date) }}
                        <ul>
                            <li v-for="game in sortedGames(date)" :key="game.id"  :id="game.api_id" @click="setGame(game.id)">
                                <img :src="getFlagUrl(game.home_team.flag_url)"><span>{{ game.home_team.name }}</span><span> VS </span><span>{{ game.away_team.name }}</span><img :src="getFlagUrl(game.away_team.flag_url)">
                            </li>
                        </ul>
                    </li>
                </ul>
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

    #filter_games {
        margin-left: 10px;
        width: 550px;
        height: calc(100vh - 75px); /* 100% of the viewport height minus the header height */
        background-color: whitesmoke;
        box-shadow: rgba(0, 0, 0, 0.16) 0 3px 6px, rgba(0, 0, 0, 0.23) 0 3px 6px;
        padding: 2px 2px 2px 2px;
        border-radius: 3px;
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

</style>
