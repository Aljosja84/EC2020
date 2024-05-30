<template>
    <div>
        <div id="gamedays_container">
            Sunday
        </div>
    </div>
</template>

<script>
    export default {
        name: "userFollowedGames",

        props: {
            'user' :        Object,
            'gamesdates' :  Array,
        }

    }
</script>

<style scoped>
    #gamedays_container {
        width: 200px;
        height: 500px;
        background-color: whitesmoke;
        box-shadow: rgba(0, 0, 0, 0.16) 0 3px 6px, rgba(0, 0, 0, 0.23) 0 3px 6px;
    }
</style>
