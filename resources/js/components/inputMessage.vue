<template>
    <div class="relative h-10 m-1">
        <div class="inputform">
            <textarea class="input_text" v-model="message" @keyup.enter="sendMessage()" @keyup="isTyping()" placeholder="Say something..."/>
            <button id="submit" @click="sendMessage()">Send</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "inputMessage",
        props: ['room', 'user'],

        data() {
            return {
                message: '',
                oldmessage: ''
            }
        },

        methods: {
            /*
            *
            * Instead of letting the typing status disappear after .3 sec, we'll check
            * if the message field is empty or not. If it's empty, the status
            * disappears, but only if it has appeared.
            *
            */
            isTyping() {
                let channel = Echo.join('chatroom.' + this.room);

                // if old message is empty, nothing has been typed before
                // or the message has been sent
                if(this.oldmessage.length === 0)
                {
                    if(this.message.length > 0)
                    {
                        channel.whisper('typing', {
                            user: Laravel.user,
                            typing: true
                        });

                        this.oldmessage = this.message;
                    }
                }   else {
                    if(this.message.length === 0)
                    {
                        channel.whisper('typing', {
                            user: Laravel.user,
                            typing: false
                        });

                        this.oldmessage = this.message;
                    }
                }
            },

            sendMessage() {
                // if there is no message, do nothing
                if(!this.message) {
                    return;
                }

                axios.post('/bettingpool/' + this.room + '/message', {
                    message: this.message,
                    user: this.user
                })
                .then(response => {
                    if(response.status === 201) {
                        this.message = '';
                        this.oldmessage = '';
                        let channel = Echo.join('chatroom.' + this.room);
                        // let other people know we're done typing
                        channel.whisper('typing', {
                            user: Laravel.user,
                            typing: false
                        })
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
    .inputform {
        display: flex;
        align-content: space-between;
        padding-top: 10px;
    }

    .input_text {
        width: 390px;
        height: 60px;
        border-radius: 5px;
        font-family: "Terminal Dosis", sans-serif;
        font-size: 14px;
        color: #5a6268;
        padding: 4px;
        margin-right: 10px;
        resize: none;
    }

    #submit {
        width: 20%;
        height: 60px;
        text-align: center;
        text-transform: uppercase;
        font-family: 'Roboto Light', sans-serif;
        font-size: 16px;
        color: white;
        border: 1px solid darkolivegreen;
        border-radius: 5px;
        background-color: #79b256;
        box-shadow: inset 0 1px 0 0 hsla(0,0%,100%,0.4);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    #submit:hover {
        background-color: #6ea14f;
    }
</style>
