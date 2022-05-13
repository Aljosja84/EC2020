<template>
    <div>
        <div class="message_container">
            <div class="message_contents">
                <ul>
                    <transition-group name="chat">
                        <li v-for="message in messages" :key="message.id" :class="`message${message.user.id === userid ? ' sent' : ' received'}`">
                            <div :class="`text_container${message.user.id === userid ? ' sent' : ' received'}`">
                                <div class="text">
                                    <span>{{ message.user.name }}:</span><br>
                                    <span>{{ message.message }}</span>
                                </div>
                                <div class="img_cont_msg">
                                    <img src="/images/avatars/gamer_1.png" width="31px" height="31px" />
                                </div>
                            </div>
                        </li>
                    </transition-group>
                </ul>
            </div>
        </div>
        <input-message :room="roomid" :user="userid" />
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
                messages: []
            }
        },

        methods: {
            getAva(userid) {
                axios.get('/ava/' + userid)
                .then(response => {
                    //console.log(response.data);
                    return response.data
                }).catch(error => {
                    console.log(error)
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

            pushNewMessage(e) {
                var message = {};
                message = e.chatMessage;
                message.user = e.user;
                this.messages.push(message);
            }
        },

        mounted() {
            this.getMessages();
            console.log("starting to listen");

            // start listening for fellow members
            window.Echo.private("chatroom." + this.roomid)
                .listen('.message.new', (e) => {
                    this.pushNewMessage(e);
                });
        }


    }
</script>

<style lang="scss" scoped>
    .message_container {
        padding-left: 39px;
        padding-right: 39px;
        width: 500px;
        height: 700px;
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
                    font-family: "Terminal Dosis", sans-serif;
                    font-size: 13px;
                    width: auto;
                    max-width: 250px;
                    border-radius: 5px;
                    padding: 3px 10px 6px 10px;
                    display: inline-block;
                    text-align: left;
                    position: relative;
                    background-repeat: no-repeat;
                    height: fit-content;
                }

                &.received {
                    text-align: left;

                    .text {
                        background: lightgray;
                    }

                    .text:after {
                        right: 100%;
                        top: 50%;
                        border: solid transparent;
                        content: "";
                        height: 0;
                        width: 0;
                        position: absolute;
                        pointer-events: none;
                        border-color: rgba(136, 183, 213, 0);
                        border-right-color:lightgray;
                        border-width: 5px;
                        margin-top: -5px;
                    }
                }

                &.sent {
                    text-align: right;
                    margin-right: 6px;

                    .text {
                        background: lightskyblue;
                    }

                    .text:after {
                        left: 100%;
                        top: 50%;
                        border: solid transparent;
                        content: "";
                        height: 0;
                        width: 0;
                        position: absolute;
                        pointer-events: none;
                        border-color: transparent;
                        border-left-color: lightskyblue;
                        border-width: 5px;
                        margin-top: -5px;
                    }
                }

                .text_container {
                    display:flex;
                    position: relative;

                    &.received {
                        justify-content: start;

                        img {
                            position: absolute;
                            bottom: 5px;
                            left: -39px;
                        }
                    }

                    &.sent {
                        justify-content: end;

                        img {
                            position: absolute;
                            bottom: 5px;
                            right: -39px;
                        }
                    }
                }
            }
        }
    }


</style>
