<template>
    <div>
        <div>
            <div class="choice_field" @click="showResults()">{{ chooseText }}</div>
            <ul class="games_window" ref="list" :style="resultStyle">
                <li v-for="(date, index) in sortedDates" :key="index" class="group">
                    {{ formatDate(date) }}
                    <ul>
                        <li v-for="game in sortedGames(date)" :key="game.id" class="game" :id="game.api_id" @click="setGame(game.id)" @mouseenter="onOptionMouseMove($event, game.api_id)">
                            <img :src="getFlagUrl(game.home_team.flag_url)"><span>{{ game.home_team.name }}</span><span> VS </span><span>{{ game.away_team.name }}</span><img :src="getFlagUrl(game.away_team.flag_url)">
                        </li>
                    </ul>
                </li>
            </ul>
            <player-dropdown :items="this.players"></player-dropdown>
            <div class="options">
                Type of notification
                <div style="width: 100%">
                    <select style="width: 100%">
                        <option value="goal" selected>Goal</option>
                        <option value="yellow card">Yellow card</option>
                        <option value="red card">Red card</option>
                    </select>
                </div>
                This happened in minute:
                <div>
                    <input type="text" id="minute" placeholder="Enter minute of Event">
                </div>
            </div>
            <div class="button">
                Send Notification
            </div>
        </div>
    </div>
</template>

<script>
    import playerDropdown from './playerDropdown.vue';

    export default {
        components: {
           playerDropdown
        },

        name: "followedGamesDropdown",

        props: ['followedgames'],

        data() {
            return {
                chooseText: 'Choose a game you follow (' + this.followedgames.length + ')',
                resultWin : false,
                selectedGame : null,
                players: [],
            }
        },

        methods: {
            showResults() {
                this.resultWin = !this.resultWin;
            },

            setGame(gameId) {
                this.resultWin = false;
                // find the game we just selected
                this.selectedGame = this.followedgames.find(game => game.id === gameId);
                // set game in the choice field
                this.chooseText = this.selectedGame.home_team.name + ' VS ' + this.selectedGame.away_team.name;
                // get all players from home_team and away_team
                axios.get('/players/game/' + gameId)
                    .then(response => {
                        this.players = response.data;
                    })
                    .catch(error => {
                        console.log('error fetching players: ', error);
                    })
            },

            handleClickOutside(event) {
                if (!this.$el.contains(event.target)) {
                    this.resultWin = false;
                }
            },

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
            },

            resultStyle() {
               return this.resultWin === true ? 'opacity: 100%; visibility: visible'
                    : 'opacity: 0%; visibility: hidden';
            }
        },

        mounted() {
            document.addEventListener('click', this.handleClickOutside);
        },

        destroyed() {
            document.removeEventListener('click', this.handleClickOutside);;
        }
    }
</script>

<style scoped>
    .choice_field {
        width: 100%;
        border: 1px slategray solid;
        border-radius: 6px;
        padding: 6px 20px 6px 30px;
        user-select: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        font-family: "Terminal Dosis", sans-serif;
        font-size: 14px;
        color: slategray;
    }

    .games_window {
        position: absolute;
        width: 100%;
        z-index: 1000;
        font-family: "Terminal Dosis", sans-serif;
        font-size: 13px;
        border: 1px solid #eee;
        background-color: white;
        height: fit-content;
        max-height: 250px;
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
        width: 100%;
        font-family: 'Roboto', sans-serif;
        font-weight: bold;
        font-size: 14px;
        color: #9badbf;
        padding: 2px 2px 2px 0;
    }

    .autocomplete-results li:last-child {
        margin-bottom: 5px;
    }

    .game {
        font-family: "Terminal Dosis", sans-serif;
        font-size: 14px;
        font-weight: normal;
        list-style: none;
        text-align: left;
        padding: 5px 2px 5px 2px;
        margin: 0 2px 0 4px;
        cursor: pointer;
        transition: all 0.3s ease-out;
        border-radius: 5px;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        -webkit-user-select: none; /* Chrome, Safari, Opera */
        -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
        user-select: none; /* Non-prefixed version */

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

    .options {
        margin: 10px 0 10px 0;
    }

    #minute {
        width: 100%;
        border: 1px slategray solid;
        border-radius: 6px;
        padding: 9px 20px 9px 30px;
        user-select: none;
        display: flex;
        align-items: center;
        font-family: "Terminal Dosis", sans-serif;
        font-size: 14px;
        color: slategray;
    }

    .button {
        cursor: pointer;
        min-width: 100%;
        border-radius: 16px;
        border: 2px solid #e5e5e5;
        border-bottom: 6px solid #e5e5e5;
        transition: all 0.1s;
        display: inline-flex;
        padding: 12px 16px;
        user-select: none;
    }
    .button:hover {
        background-color: #ddf4ff;
        border-color: #1cb0f6;
    }

    .button:active {
        border-bottom: 2px solid #1cb0f6;
    }
</style>
