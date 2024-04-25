<template>
    <div>
        <template v-if="topmenu">
            <div>
                <img src="/images/unfollow_game.png" />
            </div>
        </template>
        <template v-else>
            <div class="follow_container">
                <p>You're not following this game</p>
                <div class="button following" @click="toggleFollow">
                    <img src="/images/unfollow_game.png"><span>Follow this game: {{following}}</span>
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
                buttonStyle: '',
                buttonImage: '',
                following: false,
            }
        },

        props: {
            topmenu: false,
            matchId: Number,
            gameId: Number,
        },

        methods: {
            toggleFollow() {
                this.following = !this.following;
            },

            loadFollow($gameId) {
                axios.get('/user/following/' + $gameId)
                    .then(response => {
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

        mounted() {
            if(!this.topmenu) {
                this.loadFollow(this.gameId);
                console.log('requesting user data regarding: ' + this.gameId);
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
        --var-green: green;
        border: 1px solid var(--var-green);
        border-bottom: 5px solid var(--var-green);
        color: var(--var-green);
    }



    .button:active {
        border-bottom: 2px solid;
    }
</style>
