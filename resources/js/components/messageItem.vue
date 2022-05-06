<template>
    <div>
        {{ message.user.name }}: {{ message.message }}
    </div>
</template>

<script>
    export default {
        name: "messageItem",
        props: ['message']
    }
</script>

<style scoped>

</style>
