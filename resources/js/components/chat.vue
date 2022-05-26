<template>
    <div>
        <span>Active users</span>
        <div class="online_win">
            <transition-group name="online_members">
                <span v-for="member in activeUsers" :key="member.id"><img :src="member.avatar_url" width="50px" height="50px" :content="member.name" v-tippy="{placement: 'top', appendTo: 'parent', arrow : true, arrowType : 'round', animation : 'scale', animateFill: true, followCursor: 'horizontal', theme: 'chat'}"></span>
            </transition-group>
        </div>
        <div class="message_container">
            <div class="message_contents">
                <ul>
                    <transition-group name="chat">
                        <li v-for="(message, index) in messages" :key="message.id" :class="`message${message.user.id === userid ? ' sent' : ' received'}`">
                            <div :class="`text_container${message.user.id === userid ? ' sent' : ' received'}`">
                                <img :src="`/images/avatars/${message.user.avatar.url}`" width="31px" height="31px" />
                                <div class="text">
                                    <span v-if="message.user.id !== userid">{{ message.user.name }}<br></span>
                                    <span>{{ message.message }}</span>
                                </div>

                            </div>
                        </li>
                    </transition-group>
                </ul>
            </div>
        </div>
        <span v-show="typing" style="font-style: italic;">@{{ user }} is typing...</span>
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
                messages: [],
                activeUsers: [],
                user: '',
                typing: false
            }
        },

        methods: {
            /*
            *
            * get all messages by making a route call to /bettingpool/
            * and setting it's response to the message array
            * catch all errors, if there are any
            */
            getMessages() {
                axios.get('/bettingpool/' + this.poolid + '/messages')
                .then( response => {
                    this.messages = response.data;
                })
                .catch(error => {
                    console.log(error)
                })
            },

            /*
            *
            * push the message to the message array
            * which then gets displayed in the chat window
            *
            */
            pushNewMessage(e) {
                // initialize the message as an object so we can read param e
                var message = {};
                // set message object to the chatMessage instance
                message = e.chatMessage;
                // set user key
                message.user = e.user;
                // finally, push it to message array
                this.messages.push(message);
            },


        },

        mounted() {
            let _this = this;

            this.getMessages();
            console.log("starting to listen");

            // start listening for fellow members
            window.Echo.join("chatroom." + this.roomid)
                .here((users) => {
                    this.activeUsers = users;
                })
                .joining((user) => {
                    this.activeUsers.push(user);
                })
                .leaving((user) => {
                    this.activeUsers.splice(this.activeUsers.indexOf(user), 1);
                })
                .listenForWhisper('typing', (e) => {
                    this.user = e.user.name;
                    this.typing = e.typing;
                })
                .listen('.message.new', (e) => {
                    this.pushNewMessage(e);
                })
        }


    }
</script>

<style lang="scss" scoped>
    .online_win {
        width: 401px;
        height: 60px;
        background-color: white;
        overflow: hidden;
        padding: 5px;
    }

    .online_win span {
        display: block;
        float: left;
    }

    .online_members-enter-active {
        transition: all 0.5s;
    }
    .online_members-enter {
        opacity: 0;
        transform: translateY(50px);
    }
    .online_members-enter-to {
        opacity: 1;
    }
    .online_members-move {
        transition: all 0.5s;
    }
    .online_members-leave {
        opacity: 0;
        transform: translateY(30px);
    }
    .online_members-leave-active {
        transition: all 0.5s ease;
    }
    .online_members-leave-to {
        opacity: 0;
        transform: translateY(30px);
    }

    .message_container {
        padding-right: 39px;
        width: 500px;
        height: 700px;
        background-color: white;
        display: flex;
        flex-direction: column-reverse;
        overflow-y: scroll;
        overflow-x: hidden;
        margin-top: 25px;
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

    .tippy-tooltip.chat-theme {
        font-family: 'Oswald', sans-serif;
        background-color: black;
        color: orange;
        font-size: 14px;
        box-shadow: inset 0 2px 0 0 hsla(0,0%,100%,0.8);
        border: 1px solid #505050;
    }
    .tippy-tooltip.chat-theme .tippy-roundarrow{
        fill: black;
    }

    .message_contents {
        ul {
            list-style-type: none;
            padding: 5px;

            li {

                &.message {
                    margin: 10px 0;
                    width: 100%;
                    display: inline-block;
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
                        vertical-align: middle;
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
                        vertical-align: middle;
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
                    display:inline-block;
                    position: relative;
                    word-break: break-all;

                    &.received {
                        justify-content: start;
                        vertical-align: middle;

                        img {
                            display: inline-block;
                            left: -39px;
                            vertical-align: middle;
                        }
                    }

                    &.sent {
                        justify-content: end;

                        img {
                            right: 0;
                            vertical-align: middle;
                        }
                    }
                }
            }
        }
    }


</style>
