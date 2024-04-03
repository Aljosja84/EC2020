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
            <li class="notify_unread">
                You have been invited to join bettingpool ‘<a href="3">Nappy Fam</a>’. Click <a href="#">here</a> to accept, or <a href="#">here</a> to politely decline.
                <div class="notify_timestamp">2 hours ago</div>
            </li>
            <li class="notify_read">
                Welcome aboard! This is your notification center.
                Looks like you aren’t in a betting pool yet. Create one <a href="#">here</a>!
                <div class="notify_timestamp">2 hours ago</div>
            </li>
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

            setAsRead() {
                // set style as read and let database know
            }
        },

        mounted() {
            this.$root.$on('closeSister', () => {
                this.menuActive = true;
                this.closeMenu();
            });
        }
    }
</script>

<style scoped>
#icon_notification {
    background: url('images/user__notification.png') no-repeat;
    filter: drop-shadow(0px 2px 2px rgba(0, 0, 0, 0.5));
    background-size: contain;
    width: 46px;
    height: 46px;
    cursor: pointer;
    position: relative;
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

.notify_ul {
    position: absolute;
    margin-left: -25px;
    padding: 0;
    right: 60%;
    top: 125%;
    width: 360px;
    background-color: white;
    height: 300px;
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
    background-color: #dfebf5;
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
</style>
