<template>
    <div style="padding-top: 10px;">
        <button style="border:none" @click="toggleMenu">
            <div id="icon_notification"><span class="notify-bubble">3</span></div>
        </button>
        <ul class="notify_ul" :style="menuStyle" v-cloak>
            <div id="notify_menu_header">
                <div id="header_title" @click="setAsRead">
                    Your Notifications
                </div>
                <div id="mark_as_read">
                    <a href="#">Mark all as read</a>
                </div>
            </div>
            <div id="notify_items">
                <li class="notify_read">
                    You have been invited to join bettingpool ‘<a href="3">Nappy Fam</a>’. Click <a href="#">here</a> to accept, or <a href="#">here</a> to politely decline.
                    <div class="notify_timestamp">2 hours ago</div>
                </li>
                <li class="notify_read">
                    Welcome aboard! This is your notification center.
                    Looks like you aren’t in a betting pool yet. Create one <a href="#">here</a>!
                    <div class="notify_timestamp">2 hours ago</div>
                </li>
                <li class="notify_read">
                    <div class="notify_comment" style="padding-right: 20px">
                        <img :src="getAvatar()" class="notify_user_icon"/>
                        <div style="margin-left: 5px">
                            <span><a href="#">Gerda</a></span>
                            commented on your betslip:
                            <span>Wat een kankergare bets heb je joh. Nederland gaat echt niet winnen van Frankrijk lol.
                            En als je dat ook maar even serious neemt dan hoef je ook niet te komen janken</span>
                        </div>
                    </div>
                    <div class="notify_timestamp">2 hours ago</div>
                </li>
                <li class="notify_read">
                    <div class="notify_comment" style="padding-right: 20px">
                        <img src="/images/avatars/gamer_5.png" style="width: 40px; height: 40px; filter: drop-shadow(0px 2px 2px rgba(0, 0, 0, 0.5));"/>
                        <div style="margin-left: 5px">
                            <span><a href="#">Gabriel</a></span>
                            commented on your betslip:
                            <span>Veel geluk en plezier vanavond! :D</span>
                        </div>
                    </div>
                    <div class="notify_timestamp">7 hours ago</div>
                </li>
                <li class="notify_read">
                    <div class="notify_comment" style="padding-right: 20px">
                        <img src="/images/avatars/gamer_11.png" style="width: 40px; height: 40px; filter: drop-shadow(0px 2px 2px rgba(0, 0, 0, 0.5));"/>
                        <div style="margin-left: 5px">
                            <span><a href="#">Sh@nkie</a></span>
                            commented on your betslip:
                            <span>Vind het een prima slip, alleen gaat Depay er twee maken ipv 1 :P</span>
                        </div>
                    </div>
                    <div class="notify_timestamp">12 hours ago</div>
                </li>
            </div>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "notifications",

        data() {
            return {
                menuStyle: '',
                menuActive: true,
                avatar: '/images/avatars/gamer_1.png',
                notifications: [],
            }
        },

        methods: {
            toggleMenu() {
                // toggle the main menu
                this.menuActive = !this.menuActive;
                // close the user menu
                this.$root.$emit('closeBrother');
                this.menuActive ?
                    this.menuStyle = "top: 70px;" +
                        "opacity: 0%;" +
                        "visibility: hidden"
                    :
                    this.menuStyle = "top: 85px;" +
                        "opacity: 100%;" +
                        "visibility: visible"
            },

            closeMenu() {
                this.menuStyle = "top: 70px;" +
                    "opacity: 0%;" +
                    "visibility: hidden"
            },

            getAvatar() {
                return this.avatar;
            },

            setAsRead() {
              // do something
            },

            // fetch notifications
            fetchNotifications() {
                axios.get('/notifications')
                    .then(response => {
                        this.notifications = response.data;
                        console.log(response);
                    })
                .catch(error => {
             // something went wrong
                    console.error('Error fetching notifications:', error);
                });
            },

        },

        mounted() {
            this.$root.$on('closeSister', () => {
                this.menuActive = true;
                this.closeMenu();
            });

            // fetch notifications for logged in user
            this.fetchNotifications();
            // run test decipher
            const ciphertext = "ymj nxvzy nx tsq jmfi";
            const knownWord = "fire";
            console.log(this.decipher(ciphertext, knownWord));
        }
    }
</script>

<style scoped>
#icon_notification {
    background: url('/images/user__notification.png') no-repeat;
    filter: drop-shadow(0px 2px 2px rgba(0, 0, 0, 0.5));
    background-size: contain;
    width: 46px;
    height: 46px;
    cursor: pointer;
    position: relative;
}

.notify_user_icon {
    filter: drop-shadow(0px 2px 2px rgba(0, 0, 0, 0.5));
    width: 40px;
    height: 40px;
}

.notify-bubble {
    position: absolute;
    border: 2px solid white;
    top: -2px;
    right: -5px;
    width: 20px;
    height: 20px;
    background-color: red;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1em;
    border-radius: 50%;
}

#notify_items {
    height: fit-content;
    max-height: 600px;
    overflow-y: scroll;
    transition: all 800ms cubic-bezier(1.000, 0.000, 0.000, 1.000); /* easeInOutExpo */
    transition-timing-function: cubic-bezier(1.000, 0.000, 0.000, 1.000); /* easeInOutExpo */
    /* scrollbar vars */
    --scrollbarBG: #90A4AE;
    --thumbBG: #90A4AE;
    scroll-behavior: smooth;
}

#notify_items::-webkit-scrollbar {
    width: 7px;
}

#notify_items::-webkit-scrollbar-track {
    background: var(--scrollbarBG);
    display: none;
    -webkit-box-shadow: none;
}
#notify_items::-webkit-scrollbar-thumb {
    background-color: var(--thumbBG) ;
    border-radius: 6px;
    border: 3px solid var(--scrollbarBG);
}

.notify_ul {
    position: absolute;
    margin-left: -25px;
    padding: 0;
    right: 60%;
    top: 125%;
    width: 360px;
    background-color: white;
    /* shadow */
    box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
    border-radius: 1%;
    border-bottom: solid 5px #e28633;
    visibility: hidden;
    opacity: 0;
    transition: all 0.2s ease-out;
}

.notify_ul li {
    width: 100%;
    height: auto;
    background-color: white;
    margin: 0;
    font-family: Arial, sans-serif;
    font-size: 11px;
    padding: 5px 5px 5px 15px;
    border-bottom: 1px solid #f3f2f3;
    line-height: 15px;
    cursor: pointer;
    transition: all 0.2s ease-out;
}

.notify_ul li:hover {
    background-color: #f7f9fa;;
}
.notify_ul li a {
    color: #e28633;
    font-weight: bold;
}

.notify_unread {
    border-left: 4px solid #c9d466;
    font-weight: bold;
    color: black !important;
}
.notify_read {
    border-left: none;
    font-weight: normal;
    color: #ccc;
}

.notify_ul::after {
    content: "";
    position: absolute;
    top: -22px; /* At the top of the menu */
    left: 88%;
    margin-left: -5px;
    border-width: 11px;
    border-style: solid;
    border-color: transparent transparent #fafcfe transparent;
    border-radius: 1px;
}
.notify_timestamp {
    padding-top: 3px;
    font-size: 10px;
    color: #c9d466 !important;
}

#notify_menu_header {
    width: 100%;
    height: 67px;
    background-color: #f7f9fa;
}

#header_title {
    font-family: 'Roboto Light', sans-serif;
    font-size: 18px;
    width: 100%;
    height: 40px;
    color: #c9d466;
    padding-left: 15px;
    padding-top: 5px;
    line-height: 40px;
}
#mark_as_read {
    color: #a7acb7;
    font-family: 'Helvetica', sans-serif;
    font-weight: normal !important;
    font-size: 12px;
    width: 100%;
    padding-left: 15px;
    line-height: 11px;
    padding-top: 5px;
}
#mark_as_read a {
    color: inherit;
    text-decoration: none;
}
#mark_as_read a:hover {
    color: #c9d466;
    text-decoration: underline;
}
.notify_comment {
    display: flex;
}
</style>
