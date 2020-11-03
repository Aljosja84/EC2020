<template>
    <div>
        <h1>Events</h1>
        <table border="1px">
            <tr>
                <td>Minute</td>
                <td>Team</td>
                <td>Player</td>
                <td>Type</td>
            </tr>

            <tr v-for="event in onlyGoals" v-bind:key="event.id">
                <td>{{ event.elapsed }}</td>
                <td>{{ event.teamName }}</td>
                <td>{{ event.player }}</td>
                <td>{{ event.type }}</td>
            </tr>

        </table>
    </div>
</template>

<script>
    export default {
        name: "Events",

        data() {
            return {
                list: []
            }
        },

        computed: {
            onlyGoals: function() {
                return this.list.filter(x => x.type == 'Goal')
            }
        },

        mounted() {
            axios.get("httpppps://v2.api-football.com/events/292855", {
                headers: {
                    "X-RapidAPI-Host": "api-football-v1.p.rapidapi.com",
                    "X-RapidAPI-Key": "b1ae4a3fca89630148dadaa295a0b5b7"
                }
            }).then((response)=> {
                this.list = response.data.api.events;
                console.log(response);
            })

        }
    }
</script>
