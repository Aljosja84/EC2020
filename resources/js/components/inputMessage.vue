<template>
    <div class="relative h-10 m-1">
        <div style="border-top: 1px solid lightgray; margin-top:15px; padding-top: 5px">
            <input type="text" style="width: 100%; height: 30px" v-model="message" @keyup.enter="sendMessage()" placeholder="Say something...">
            <button @click="sendMessage()" style="width: 100%">Send</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "inputMessage",
        props: ['room'],

        data() {
            return {
                message: ''
            }
        },

        methods: {
            sendMessage() {
                if(!this.message) {
                    return;
                }

                axios.post('/bettingpool/' + this.room.id + '/message', {
                    message: this.message
                })
                .then(response => {
                    if(response.status === 201) {
                        this.message = '';
                        this.$emit('messagesent');
                    }
                })
                .catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>

<style scoped>

</style>
