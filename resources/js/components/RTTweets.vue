<template>
    <div class="tweet_container">
        <div class="header">{{ numTweet }} People tweeting about this match:</div>
        <ul>
            <transition-group name="twit">
                <li class="tweet_body" v-for="(tweet, index) in list" :key="tweet[0]">
                    <div class="tweet_avatar">
                        <img :src="tweet[3]"/>
                    </div>

                    <div class="divider" />

                    <div class="tweet_text">
                        <span class="usertweeted"><span :class=tweet[4] >@{{ tweet[1] }} </span></span>tweeted: <br>
                        {{ tweet[2] }}
                    </div>
                </li>
            </transition-group>
        </ul>
    </div>

</template>

<script>
    export default {

        data() {
            return {
                id: 1,
                tweet: [],
                list: [],
                colours: ['green', 'orange', 'red', 'blue'],
                channel: null,
                numTweet: 0
            }
        },

        methods: {
            addNewTweet(tweet) {
                this.numTweet++;
                var tweetEvent = [this.idNum(), tweet["user_name"], tweet["text"], tweet["profile_image_url_https"], this.randColor()];

                if(this.list.length >= 14)
                {
                    this.list.pop();
                    this.list.unshift(tweetEvent);
                } else {
                    this.list.unshift(tweetEvent);
                }
            },

            removeTweet() {
                this.numTweet--;
                this.list.pop();
            },

            randColor() {
                return _.sample(this.colours);
            },

            idNum() {
                return Math.floor(Math.random() * 10000);
            }
        },

        created() {
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = false;

            let pusher = new Pusher('b058daf2bad752686e28', {
                cluster: 'eu'
            });
            // Subscribe to live-tweets channel
            this.channel = pusher.subscribe('live-tweets');

            this.channel.bind('tweets', (data) => this.addNewTweet(data.message));

        }
    }
</script>

<style scoped>
    .twit-enter-active {
        transition: all .5s;
    }
    .twit-enter {
        opacity: 0;
        transform: translateX(100px);
    }
    .twit-enter-to {
        opacity: 1;
    }
    .twit-leave-active {
        transition: all 0.5s;
    }
    .twit-leave {
        opacity: 1;
    }
    .twit-leave-to {
        opacity: 0;
        transform: translateY(30px);
    }
    .twit-move {
        transition: all .5s;
    }

    .tweet_container {
        overflow: hidden;
        font-family: "Roboto", sans-serif;
        font-size: 22px;
        color: #616161;
        width: 400px;
        height: 1200px;
        padding: 0;
    }

    .header {
        font-family: 'Oswald', sans-serif;
        line-height: 24px;
        padding: 7px 0 7px 7px;
        background-color: whitesmoke;
    }

    .tweets {
        font-size: 12px;
    }

    .tweet_container ul {
        padding-left: 0;
    }

    .tweet_container li {
        margin: 7px 0;
        list-style: none;
        overflow: auto;
        background-color: whitesmoke;
        -webkit-box-shadow: 0px 4px 5px 0px rgba(0,0,0,0.25);
        -moz-box-shadow: 0px 4px 5px 0px rgba(0,0,0,0.25);
        box-shadow: 0px 4px 5px 0px rgba(0,0,0,0.25);
    }

    .tweet_body {
        width: 400px;
        padding: 7px 7px 7px 7px;
    }

    .tweet_avatar {
        float: left;
        padding: 0 3px 0 0;
    }

    .divider {
        float: left;
        width: 2px;
        height: 48px;
        background-color: #cbcecf;
    }

    .tweet_text {
        font-family: "Roboto", sans-serif;
        font-size: 11px;
        line-height: 12px;
        padding-left: 58px;
    }

    .green{
        color: #c9d466;
    }
    .orange {
        color: #e58d37;
    }
    .red {
        color: #ed1c24;
    }
    .blue {
        color: #4cb4e7;
    }

    .usertweeted {
        font-family: "Oswald", sans-serif;
        font-size: 12px;
    }
</style>
