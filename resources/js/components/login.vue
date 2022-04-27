<template>
    <div>
        <div id="login_icons">
            <div id="icon_notification" @click="readMessages"><span v-if="unread" class="notify-bubble">{{ unread }}</span></div>
            <div id="icon_user" @click="toggleMenu"></div>
        </div>
        <!-- dropdown menu -->
        <div id="dropdown_container" :style="menuStyle">
            <div id="profile">
                <div id="username">Hello, {{ username }}</div>
                <div id="view_profile"><a href="#">View my profile</a></div>
            </div>
            <div id="options">
                <div id="my_bets">My bets</div>
                <div id="spoiler" @click="toggleSpoiler">
                    <span>Spoiler Alert</span>
                    <span style="padding-top:10px; padding-right: 5px">
                        <label class="switch">
                            <input id="spoilerCheck" type="checkbox">
                            <span class="slider round"></span>
                        </label>
                    </span>
                </div>
                <div id="groups" @click="accessGroups">
                    <span>Groups</span>
                    <span id="more_arrow"></span>
                </div>
                <div id="subgroups" :style="subGroupStyle">
                    <div v-for="group in groups" class="subgroup_option">{{group}}</div>
                </div>
                <div id="followed">Followed Games</div>
                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><div id="sign_out">Sign out</div></a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "login",

        data() {
            return {
                menuStyle: '',
                subGroupStyle: '',
                subGroupActive: true,
                menuActive: true
            }
        },

        props: ['unread',
                'username',
                'spoiler',
                'groups'
                ],

        methods: {
            /*
            *
            * toggle all notifications as read
            *
            */
            readMessages() {
                this.unread = false;
            },
            /*
            *
            *
            *
            */
            toggleMenu() {
                // check if groups menu is open and close it if it is
                !this.subGroupActive ? this.accessGroups() : '';
                // toggle the main menu
                this.menuActive = !this.menuActive;
                this.menuActive ?
                    this.menuStyle = "top: 70px;" +
                        "opacity: 0%;" +
                        "visibility: hidden"
                    :
                    this.menuStyle = "top: 85px;" +
                        "opacity: 100%;" +
                        "visibility: visible"
            },
            /*
            *
            * menu will animate to groups
            *
            */
            accessGroups() {
                console.log(this.subGroupActive);
                this.subGroupActive = !this.subGroupActive;
                this.subGroupActive ?
                    this.subGroupStyle = "height: 0px;"
                    :
                    this.subGroupStyle = "height: " +this.maxHeight

            },
            /*
            *
            * toggle slider for spoiler alert
            *
            */
            toggleSpoiler() {
                this.spoiler = !this.spoiler;
                document.getElementById('spoilerCheck').checked = this.spoiler;
            },

        },
        mounted() {
            document.getElementById('spoilerCheck').checked = this.spoiler;
        },
        computed : {
            maxHeight() {
                return this.groups.length * 37 + 'px';
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
        /* set var */
        --login_hover: #f7f9fa;
        --login_subgroup_hover: white;
        width: 195px;
        height: auto;
        background-color: white;
        position: absolute;
        right: 15px;
        top: 70px;
        border-radius: 5px;
        /* shadow */
        box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
        border-bottom: solid 5px #c9d466;
        visibility: hidden;
        opacity: 0;
        transition: all 0.2s ease-out;
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
        background-color: #f7f9fa;
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
    #view_profile a {
        color: inherit;
        text-decoration: none;
    }
    #view_profile a:hover {
        color: #c9d466;
        text-decoration: underline;
    }

    #options {
        position: relative;
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
        background-color: var(--login_hover);
        padding-left: 42px;
        color: #c9d466;
    }
    #spoiler {
        display: flex;
        justify-content: space-between;
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
        background-color:  var(--login_hover);
        padding-left: 42px;
        color: darkorange;
    }
    #groups {
        display: flex;
        justify-content: space-between;
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
        background-color:  var(--login_hover);
        padding-left: 42px;
        color: red;
    }

    #subgroups {
        z-index: 30;
        height: 0;
        visibility: visible;
        overflow: hidden;
        opacity: 100%;
        width: 100%;
        background-color: #f7f9fa;
        /* create a nice dropdown effect for the subgroup menu */
        transition: all 500ms cubic-bezier(0.680, -0.550, 0.265, 1.550); /* easeInOutBack */

        transition-timing-function: cubic-bezier(0.680, -0.550, 0.265, 1.550); /* easeInOutBack */
    }

    .subgroup_option {
        font-family: "Roboto", sans-serif;
        font-size: 12px;
        color: #69788a;
        width: 100%;
        height: 37px;
        cursor: pointer;
        padding-left: 40px;
        line-height: 36px;
        /* animation */
        transition: 0.2s linear;
    }

    .subgroup_option:hover {
        background-color: var(--login_subgroup_hover);
        padding-left: 42px;
        color: #515151;
    }

    #more_arrow {
        position: relative;
        right: 7px;
        top: 15px;
        background: url("images/login__arrow.png") no-repeat;
        width: 8px;
        height: 5px;
    }
    #followed {
        z-index: 40;
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
        background-color:  var(--login_hover);
        padding-left: 42px;
        color: mediumpurple;
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
        background-color:  var(--login_hover);
        padding-left: 42px;
        color: #5ba9f1;
    }

    /* switch button for spoiler alert menu item */
    .switch {
        position: relative;
        display: inline-block;
        width: 30px;
        height: 17px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 13px;
        width: 13px;
        left: 2px;
        bottom: 2px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: darkorange;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px darkorange;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(13px);
        -ms-transform: translateX(13px);
        transform: translateX(13px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
