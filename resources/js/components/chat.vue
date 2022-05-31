<template>
    <div>
        <div id="online_container">
            <div class="online_header">
                online members
            </div>
            <div class="separator_bar"></div>
            <div class="online_win">
                <transition-group name="online_members">
                    <span v-for="member in activeUsers" :key="member.id" style="position: relative">
                        <img :src="member.avatar_url" width="50px" height="50px" :content="member.name" v-tippy="{placement: 'top', arrow : true, arrowType : 'round', animation : 'scale', animateFill: true, followCursor: 'horizontal', theme: 'chat'}">
                        <span v-if="typing_users.includes(member.id)" class="typing-bubble"></span>
                    </span>
                </transition-group>
            </div>
        </div>
        <div class="message_container">
            <div class="message_contents">
                <ul>
                    <transition-group name="chat">
                        <li v-for="(message, index) in messages" :key="message.id" :class="`message${message.user.id === userid ? ' sent' : ' received'}`">
                            <div :class="`text_container${message.user.id === userid ? ' sent' : ' received'}`">
                                <img v-if="message.user.id !== userid" :src="`/images/avatars/${message.user.avatar.url}`" width="31px" height="31px" />
                                <div class="text">
                                    <span v-if="(getLastUserId(index) !== message.user.id)" style="font-weight: bold">{{ message.user.name }}<br></span>
                                    <span>{{ message.message }}</span>
                                </div>
                                <img v-if="message.user.id === userid" :src="`/images/avatars/${message.user.avatar.url}`" width="31px" height="31px" />
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
                messages: [],
                activeUsers: [],
                user: '',
                typing: false,
                typing_id: null,
                typing_users: []
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

            getLastUserId(e) {
                if(e >= 1) {
                    return this.messages[e - 1].user_id;
                }
            }


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
                    // set typing id for the active users avatar typing bubble
                    this.typing_id = e.user.id;
                    var message = {};
                    message.user = e.user;
                    message.message = "is typing...";
                    // set a key for the list element
                    message.id = e.user.created_at;
                    // if typing is false, remove the indicator from the messages array
                    // this.typing ? this.messages.push(message) : this.messages.pop();
                    if(this.typing) {
                        _this.typing_users.push(_this.typing_id);
                        return this.typing_users;
                    }   else {
                        Array.prototype.unset = function(value) {
                            if(this.indexOf(value) !== -1) { // Make sure the value exists
                                this.splice(this.indexOf(value), 1);
                            }
                        }
                        this.typing_users.unset(this.typing_id);
                    }

                })
                .listen('.message.new', (e) => {
                    this.pushNewMessage(e);
                })
        }


    }
</script>

<style lang="scss">
    #online_container {
        background-color: white;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
    }
    .online_header {
        width: 100%;
        height: 40px;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        color: #515151;
        text-align: center;
        background-image: url("images/light_wool.png");
    }
    .separator_bar {
        height: 2px;
        background-image: linear-gradient(to right, transparent, #b5b5b5, transparent);
    }

    .online_win {
        width: 500px;
        height: 60px;
        background-color: white;
        overflow: hidden;
        padding: 5px;
        border-bottom-color: black;
        border-bottom-width: 1px;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    .online_win span {
        display: block;
        float: left;
    }

    .typing-bubble {
        position: absolute;
        top: -5px;
        right: -10px;
        padding: 0px 2px 0px 5px;
        background-color: #79b256;
        color: white;
        font-size: 0.95em;
        border-radius: 20%;
        width: 21px;
        height: 25px;
        z-index: 1000;
        transition: all 0.2s ease-in;
    }
    .typing-bubble:after {
        content: ' .';
        animation: dots 1.5s steps(5, end) infinite;
    }
    @keyframes dots {
        0%, 20% {
            color: rgba(0,0,0,0);
            text-shadow:
                .25em 0 0 rgba(0,0,0,0),
                .5em 0 0 rgba(0,0,0,0);
        }
        40% {
            color: white;
            text-shadow:
                .25em 0 0 rgba(0,0,0,0),
                .5em 0 0 rgba(0,0,0,0);
        }
        60% {
            text-shadow:
                .25em 0 0 white,
                .5em 0 0 rgba(0,0,0,0);
        }
        80%, 100% {
            text-shadow:
                .25em 0 0 white,
                .5em 0 0 white;
        }
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
        border-radius: 5px;
        width: 500px;
        height: 700px;
        background-color: white;
        display: flex;
        flex-direction: column-reverse;
        overflow-y: scroll;
        overflow-x: hidden;
        margin-top: 10px;
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
    .chat-leave {
        opacity: 0;
        transform: translateX(100px);
    }
    .chat-leave-to {
        opacity: 0;
        transform: translateX(100px);
    }
    .chat-leave-active {
        transition: all 0.3s ease;
    }

    .tippy-tooltip.chat-theme {
        font-family: "Terminal Dosis", sans-serif;
        background-color: #40656c;
        color: white;
        font-size: 15px;
        border-top: 1px solid #2a8092;
        box-shadow: inset 0 1px 0 0 hsla(0,0%,100%,0.3);
    }
    .tippy-tooltip.chat-theme .tippy-roundarrow{
        fill: #40656c;
        border-right-color: #1d5f6d;
    }

    .message_contents {
        ul {
            list-style-type: none;
            padding: 5px;

            li {

                &.message {
                    margin: 1px 0;
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
                    margin: 3px;
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
                        border: solid;
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
                        border-left-color: lightskyblue;
                        border-width: 5px;
                        margin-top: -5px;
                    }
                }

                .text_container {
                    display:inline-block;
                    position: relative;
                    word-break: break-word;

                    &.received {
                        justify-content: start;
                        vertical-align: middle;

                        img {
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
