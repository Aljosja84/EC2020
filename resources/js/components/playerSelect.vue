<template>
    <div>
        Select a country to get players from:
        <select style="width: 100%; margin-bottom:7px;" v-model="selectedCountry">
            <option v-for="country in countries" :value="country.api_country_code">{{ country.name }}</option>
        </select>
        <div class="button" @click="findFixture(selectedCountry)">
            <p class="button_text">
                load players
            </p>
        </div>
        players loaded:
        <select style="width: 100%; margin-bottom:7px;" v-model="countryPlayers">
            <option v-for="player in players" :value="player.player.id">{{ player.player.name }}</option>
        </select>
        <div class="button">
            <p class="button_text">
                submit to database
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "playerSelect",

        props: ['countries'],

        data() {
            return {
                selectedCountry: this.countries[0].api_country_code,
                players: Array,
                countryPlayers: '',
            }
        },

        methods: {
            findFixture(id) {
                axios.post('/comment/fixture/' + id)
                    .then(response => {
                        console.log(response.data)
                        this.getPlayers(response.data, id);
                    })
                    .catch(error => {
                        console.log('Error getting fixture Id: ', error);
                    })
            },

            getPlayers(fixtureId, teamId) {
                axios.get("https://v3.football.api-sports.io/fixtures/lineups?fixture=" + fixtureId + "&team=" + teamId, {
                    headers: {
                        "x-rapidapi-host": process.env.MIX_API_URL,
                        "x-rapidapi-key": process.env.MIX_API_KEY
                    }
                }).then((response)=> {
                    // list the starting players
                    let startXI = response.data.response[0].startXI;
                    // list the benched players
                    let bench = response.data.response[0].substitutes;
                    // add them together to create the full team
                    this.players = startXI.concat(bench);
                    // set the dropdown menu to the first player
                    this.countryPlayers = this.players[0].player.id;
                });
            }
        }
    }
</script>

<style scoped>
    .button {
        cursor: pointer;
        min-width: 100%;
        border-radius: 16px;
        border: 2px solid #e5e5e5;
        border-bottom: 6px solid #e5e5e5;
        transition: all 0.1s;
        display: inline-flex;
        padding: 12px 16px;
    }
    .button:hover {
        background-color: #ddf4ff;
        border-color: #1cb0f6;
    }

    .button:active {
        border-bottom: 2px solid #1cb0f6;
    }
</style>
