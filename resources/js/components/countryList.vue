<template>
<div id="container">
    Which team do you root for?
    <br>
    
</div>
</template>

<script>
    export default {
        name: "countryList",

        props: ['countries', 'avatars']


    }
</script>

<style scoped>
    #container {
        text-align: center;
        padding: 20px 0 0 0;
        font-family: "Roboto", sans-serif;
        font-size: 14px;
        color: #3382a0;
        width: 793px;
        height: 885px;
        background-color: whitesmoke;
    }
</style>
