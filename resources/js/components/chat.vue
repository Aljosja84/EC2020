<template>
    <div>
        <div class="message_container">
            <div class="message_contents">
                <ul>
                    <transition-group name="chat">
                        <li v-for="message in messages" :key="message.id" :class="`message${message.user.id === userid ? ' sent' : ' received'}`">
                            <div class="text">
                               {{ message.user.name }}  : {{ message.message }}
                            </div>
                        </li>
                    </transition-group>
                </ul>
            </div>
        </div>
        <input-message :room="currentRoom" :user="userid" />
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
            getAva(userid) {
                axios.get('/ava/' + userid)
                .then(response => {
                    return response.data
                }).catch(error => {
                    console.log(error)
                })
            },

            connect() {
                if(this.currentRoom.id) {
                    //let vm = this;
                    this.getMessages();

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
            },

            saveNewMessage(e) {
                var message = {};
                message = e.chatMessage;
                message.user = e.user;
                this.messages.push(message);
            }
        },

        mounted() {
            this.loadRoom();
            console.log("starting to listen");
            window.Echo.private("chatroom." + this.roomid)
                .listen('.message.new', (e) => {
                    this.saveNewMessage(e);
                });
        }


    }
</script>

<style lang="scss" scoped>
    .message_container {
        width: 400px;
        height: 600px;
        background-color: white;
        display: flex;
        flex-direction: column-reverse;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    .chat-enter-active {
        transition: all .5s;
    }
    .chat-enter {
        opacity: 0;
        transform: translateX(100px);
    }
    .chat-enter-to {
        opacity: 1;
    }

    .chat-move {
        transition: all .5s;
    }

    .message_contents {
        ul {
            list-style-type: none;
            padding: 5px;

            li {

                &.message {
                    margin: 10px 0;
                    width: 100%;
                }

                .text {
                    font-family: "Roboto", sans-serif;
                    font-size: 14px;
                    width: auto;
                    max-width: 400px;
                    border-radius: 5px;
                    padding: 12px;
                    display: inline-block;
                    text-align: left;
                }

                &.received {
                    text-align: left;

                    .text {
                        background: lightgray;
                    }
                }

                &.sent {
                    text-align: right;

                    .text {
                        background: lightskyblue;
                    }
                }
            }
        }
    }


</style>
