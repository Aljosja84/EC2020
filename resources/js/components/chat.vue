<template>
    <div>
        <message-container :messages="messages" :userid="userid"/>
        <input-message :room="currentRoom" v-on:messagesent="getMessages" />
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

        props: ['poolid', 'roomid', 'userid'],

        data() {
            return {
                currentRoom: [],
                messages: []
            }
        },

        methods: {
            loadRoom() {
                axios.get('/bettingpool/' + this.poolid + '/' + this.roomid)
                .then( response => {
                    this.setRoom(response.data);
                })
                .catch( error => {
                    console.log( error );
                })
            },

            getMessages() {
                axios.get('/bettingpool/' + this.poolid + '/messages')
                .then( response => {
                    this.messages = response.data;
                })
                .catch(error => {
                    console.log(error)
                })
            },

            setRoom(room) {
                this.currentRoom = room;
                this.getMessages();
            }
        },

        created() {
            this.loadRoom();
        }


    }
</script>

<style scoped>

</style>
