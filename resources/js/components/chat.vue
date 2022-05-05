<template>
    <div>
        <message-container />
        <input-message />
    </div>
</template>

<script>
    import MessageContainer from './messageContainer.vue'
    import InputMessage from './inputMessage.vue'
    export default {
        name: "chat",
        components: {
            MessageContainer, InputMessage
        },

    }
</script>

<style scoped>

</style>
