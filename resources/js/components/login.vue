<template>
    <div>
        <div id="login_icons">
            <div id="icon_notification" @click="readMessages"><span v-if="unread" class="notify-bubble">{{ unread }}</span></div>
            <div id="icon_user"></div>
        </div>
        <!-- dropdown menu -->
        <div id="dropdown_container">
            <div id="profile">
                <div id="username">Hello, {{ username }}</div>
                <div id="view_profile">View my profile</div>
            </div>
            <div id="my_bets">My bets</div>
            <div id="spoiler">Spoiler Alert</div>
            <div id="groups">Groups</div>
            <div id="followed">Followed Games</div>
            <div id="sign_out">Sign out</div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "login",

        props: ['unread', 'username'],

        methods: {
            readMessages() {
                this.unread = false;
            }
        }
    }
</script>

<style scoped>
    /* ----------------------------- user login ------------------------------------------------------- */
    #login_icons {
        height: 65px;
        width: 115px;
        position: absolute;
        background-color: transparent;
        right: 85px;
        top: 0;
        z-index: 5;
        display: flex;
        justify-content: space-between;
        padding-top: 10px;
    }

    #icon_notification {
        background: url("images/user__notification_2.png") no-repeat;
        filter: drop-shadow(0px 2px 2px rgba(0, 0, 0, 0.5));
        background-size: contain;
        width: 46px;
        cursor: pointer;
    }
    .notify-bubble {
        position: absolute;
        top: -2px;
        right: -5px;
        padding: 2px 5px 2px 5px;
        background-color: red;
        color: white;
        font-size: 0.65em;
        border-radius: 50%;
    }
    #icon_user {
        background: url("images/user__avatar.png") no-repeat;
        filter: drop-shadow(0px 2px 2px rgba(0, 0, 0, 0.5));
        background-size: contain;
        width: 46px;
        cursor: pointer;
    }

    #dropdown_container {
        width: 195px;
        height: 259px;
        background-color: white;
        position: absolute;
        right: 15px;
        top: 85px;
        border-radius: 5px;
        /* shadow */
        box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
        border-bottom: solid 5px #c9d466;
    }

    #dropdown_container::after {
        content: "";
        position: absolute;
        top: -22px; /* At the top of the menu */
        left: 50%;
        margin-left: -5px;
        border-width: 11px;
        border-style: solid;
        border-color: transparent transparent #fafcfe transparent;
        border-radius: 1px;
    }

    #profile {
        width: 100%;
        height: 67px;
        background-color: #fafcfe;
    }

    #username {
        font-family: 'Roboto Light', sans-serif;
        font-size: 18px;
        width: 100%;
        height: 40px;
        color: #c9d466;
        padding-left: 15px;
        padding-top: 5px;
        line-height: 40px;
    }
    #view_profile {
        color: #a7acb7;
        font-family: 'Helvetica', sans-serif;
        font-size: 12px;
        width: 100%;
        padding-left: 15px;
        line-height: 11px;
        padding-top: 5px;
    }

    #my_bets {
        font-family: 'Oswald', sans-serif;
        font-size: 15px;
        color: #69788a;
        width: 100%;
        height: 38px;
        background: url("images/login__bets.png") no-repeat 15px;
        padding-left: 40px;
        line-height: 36px;
        border-bottom: 1px solid #f3f2f3;
        cursor: pointer;
        /* animation */
        transition: ease 0.2s;
    }
    #my_bets:hover {
        background-color: #fafcfe;
        padding-left: 42px;
    }
    #spoiler {
        font-family: 'Oswald', sans-serif;
        font-size: 15px;
        color: #69788a;
        width: 100%;
        height: 37px;
        background: url("images/login__spoiler.png") no-repeat 15px;
        padding-left: 40px;
        line-height: 36px;
        cursor: pointer;
        /* animation */
        transition: ease 0.2s;
    }
    #spoiler:hover {
        background-color: #fafcfe;
        padding-left: 42px;
    }
    #groups {
        font-family: 'Oswald', sans-serif;
        font-size: 15px;
        color: #69788a;
        width: 100%;
        height: 37px;
        background: url("images/login__groups.png") no-repeat 14px;
        padding-left: 40px;
        line-height: 36px;
        cursor: pointer;
        /* animation */
        transition: ease 0.2s;
    }
    #groups:hover {
        background-color: #fafcfe;
        padding-left: 42px;
    }
    #followed {
        font-family: 'Oswald', sans-serif;
        font-size: 15px;
        color: #69788a;
        width: 100%;
        height: 37px;
        background: url("images/login__followed.png") no-repeat 15px;
        padding-left: 40px;
        line-height: 36px;
        border-bottom: 1px solid #f3f2f3;
        padding-bottom: 10px;
        cursor: pointer;
        /* animation */
        transition: ease 0.2s;
    }
    #followed:hover {
        background-color: #fafcfe;
        padding-left: 42px;
    }

    #sign_out {
        font-family: 'Oswald', sans-serif;
        font-size: 15px;
        color: #69788a;
        width: 100%;
        height: 38px;
        background: url("images/login__signout.png") no-repeat 15px;
        padding-left: 40px;
        line-height: 36px;
        cursor: pointer;
        /* animation */
        transition: ease 0.2s;
    }
    #sign_out:hover {
        background-color: #fafcfe;
        padding-left: 42px;
    }
</style>
