<template>
    <div class="message_container">
        <div class="message_contents">
            <ul>
                <li v-for="message in messages" :key="message.id" :class="`message${message.user.id === userid ? ' sent' : ' received'}`">
                    <div class="text">
                       <b>{{ message.user.name }}</b>: {{ message.message }}
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "messageContainer",
        props: ['messages', 'userid'],
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
