<template>
    <div class="container">{{ naam }}</div>
</template>

<script>
    export default {
        name: "test",

        props: {
            naam: String,
        },

        data() {
            return {

            }
        }
    }
</script>

<style scoped>
.container {
    width: 1100px;
    height: 475px;
    background-color: #00ffc4;
}
</style>
