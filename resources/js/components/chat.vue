<template>
    <div>
        <message-container :messages="messages" :userid="userid"/>
        <input-message :room="currentRoom" />
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

        watch: {
          currentRoom() {
              this.connect();
          }
        },

        methods: {
            connect() {
                if(this.currentRoom.id) {
                    //let vm = this;
                    this.getMessages();
                    window.Echo.private("chatroom." + this.currentRoom.id)
                    .listen('.message.new', e => {
                        this.getMessages();
                    });
                }
            },
            
            disconnect(room) {
                window.Echo.leave("chatroom." + room.id)
            },

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
