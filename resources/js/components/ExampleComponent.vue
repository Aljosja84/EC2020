<template>
    <div>
        <h1>Events</h1>
    </div>
</template>

<script>
    export default {
        name: "Events",

        mounted() {
            axios.get("https://v2.api-football.com/events/292855", {
                headers: {
                    "X-RapidAPI-Host": "api-football-v1.p.rapidapi.com",
                    "X-RapidAPI-Key": "b1ae4a3fca89630148dadaa295a0b5b7"
                }
            }).then((response)=> {
                console.log(response);
            })

        }
    }
</script>
