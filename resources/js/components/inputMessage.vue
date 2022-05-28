<template>
    <div class="relative h-10 m-1">
        <div style="border-top: 1px solid lightgray; margin-top:15px; padding-top: 5px">
            <input type="text" style="width: 100%; height: 30px" v-model="message" @keyup.enter="sendMessage()" @keyup="isTyping()" placeholder="Say something...">
            <button @click="sendMessage()" style="width: 100%">Send</button>
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

</style>
