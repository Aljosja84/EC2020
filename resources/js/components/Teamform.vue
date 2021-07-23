<template>
    <div class="container">
        <h1>{{details}}</h1>
        <h1><img :src="flag"></h1>
    </div>
</template>

<script>
    export default {
        name: "Teamform",
        props: ['details', 'flag'],


        mounted() {
            console.log('Component mounted.')
        }
    }

</script>

<style scoped>
    .container {
        width: 335px;
        height: 610px;
        background-color: white;
    }
</style>
