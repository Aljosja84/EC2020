<template>
    <div v-show="loaded">
        <template v-if="topmenu">
            <div @click.stop.prevent="sayHello">
                <img v-if="followed.length > 0" src="/images/follow_game.png" />
                <img v-else src="/images/unfollow_game.png" />
            </div>
        </template>
        <template v-else>
            <div class="follow_container">
                <p>{{ topText }}</p>
                <div class="button " :class="buttonStyle" @click="setFollow(following, gameId)">
                    <img v-if="following" src="/images/unfollow_game.png">
                    <img v-else src="/images/follow_game.png">
                    <span v-if="following">Unfollow this game</span>
                    <span v-else>Follow this game</span>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
    export default {
        name: "followGameButton",

        data() {
            return {
                buttonImage: '',
                following: false,
                loaded: false,
            }
        },

        props: {
            topmenu: false,
            matchId: Number,
            gameId: Number,
            followed: Array,
        },

        methods: {
            toggleFollow() {
                this.following = !this.following;
            },

            setFollow(followStatus, gameId) {
                const url = '/user/setfollow/' + gameId + '/' + followStatus;

                axios.get(url)
                    .then(response => {
                        if(response.data === 1) {
                            this.following = true;
                        }   else {
                            this.following = false;
                        }
                    })
                    .catch(error => {
                        console.log('ERROR WITH SETTING FOLLOW STATUS: ', error);
                    })
            },

            sayHello() {
                console.log('HELLO');
            },

            loadFollow($gameId) {
                axios.get('/user/following/' + $gameId)
                    .then(response => {
                        // set loaded to true so we can show the component
                        this.loaded = true;

                        if(response.data === 1) {
                            this.following = true;
                             console.log('following!')
                        }   else {
                            this.following = false;
                             console.log('not following!');
                        }

                    })
                    .catch(error => {
                        console.log('ERROR FOLLOWING DATA: ', error);
                    })

            }
        },

        computed: {
            buttonStyle() {
                return this.following === true ? 'not_following' : 'following';
            },

            topText() {
                return this.following === true ? 'You are following this game' : 'You are not following this game';
            }
        },

        mounted() {
            if(!this.topmenu) {
                this.loadFollow(this.gameId);
                console.log('requesting user data regarding: ' + this.gameId);
            }

            if(this.topmenu) {
                if(this.followed.length > 0) {

                    // logged in user is following
                    console.log('FOLLOWED FROM MAIN MENU');
                    this.loaded = true;
                }   else {
                    console.log('NOT FOLLOWED FROM MAIN MENU');
                    this.loaded = true;
                }
            }
        }
    }
</script>

<style scoped>
    .follow_container {
        background-color: white;
        width: 200px;
        height: 85px;
        margin-left: 7px;
        padding: 4px 8px 4px 8px;
        font-family: "Roboto", sans-serif;
        font-size: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .follow_container p {
        padding: 6px 0 12px 0;
    }

    .button {
        position: relative;
        cursor: pointer;
        width: 85%;
        height: 50%;
        border-radius: 10px;
        transition: all 0.1s;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        padding: 12px 16px;
        font-size: 12px;
    }

    .button img {
        position: absolute;
        top: 8px;
        left: 5px;
    }

    .not_following {
        --var-red: red;
        border: 1px solid var(--var-red);
        border-bottom: 5px solid var(--var-red);
        color: var(--var-red);
    }

    .following {
        --var-green: #7ed63e;
        border: 1px solid var(--var-green);
        border-bottom: 5px solid var(--var-green);
        color: var(--var-green);
    }



    .button:active {
        border-bottom: 2px solid;
    }
</style>
