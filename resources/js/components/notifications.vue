<template>
    <div style="padding-top: 10px;">
        <button style="border:none" @click="toggleMenu">
            <div id="icon_notification"><span class="notify-bubble" v-show="unreadbadge">{{ unreadbadge }}</span></div>
        </button>
        <div class="notify_ul" :style="menuStyle">
            <div id="notify_menu_header">
                <div id="header_title" @click="setAsRead">
                    Your Notifications
                </div>
                <div class="mark_as_read" v-if="notifications.length > 0">
                    <a href="#" @click.prevent="setAllUnreadAsRead()">Mark all as read</a> | <a href="#" @click.prevent="deleteAllNotifications()">Delete all</a>
                </div>
                <div class="mark_as_read" v-else>
                    <a href="#" class="inactive_link">Mark all as read</a> | <a href="#" class="inactive_link">Delete all</a>
                </div>
            </div>
                <div id="notify_items" v-cloak v-if="notifications.length > 0" :key="1">
                        <li @click=setAsRead(notification) :class=setStyleReadStatus(notification) v-for="(notification, index) in notifications" v-bind:key=notification.id @mouseenter="showDelete(index)" @mouseleave="hideDelete()">
                            <div class="notify_delete" @click.stop=whichDelete(notification)><img src="/images/sign-delete-light.png" width="16px" height="16px" /></div>
                            <div class="notify_comment" style="padding-right: 20px">
                                <img :src="notification['data'].comment_avatar" class="notify_user_icon"/>
                                <div style="margin-left: 10px">
                                    <span><a href="#">{{ notification['data'].comment_from_name }}</a></span>
                                    commented on your betslip:
                                    <span>"{{ notification['data'].comment_body }}"</span>
                                </div>
                            </div>
                            <div class="notify_timestamp">{{ notification['sent_date'] }}</div>
                        </li>
                </div>
                <div v-else class="notify_none" :key="2">
                    <img src="/images/no_notifications.png" id="notify_none_bgimage">
                    <div>No notifications yet.</div>
                </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "notifications",


        data() {
            return {
                menuStyle: '',
                menuActive: true,
                notifications: [],
                unreadbadge: null,
                hoveredItem: null
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
                        "visibility: visible";
            },

            setStyleReadStatus(e) {
                return e.read_at == null ? 'notify_unread' : 'notify_read';
            },

            closeMenu() {
                this.menuStyle = "top: 70px;" +
                    "opacity: 0%;" +
                    "visibility: hidden"
            },

            // set a notification as read
            setAsRead(notification) {
                let notificationId = notification.id;
                if(notification.read_at !== null) {
                    console.log('notification is already marked as read');
                    return;
                }
                console.log('setting notification as read');
                axios.post('/notifications/' + notificationId + '/mark-as-read')
                    .then(response => {
                        this.notifications = response.data;
                        this.notifications.length === 0 ? this.unreadbadge = null : this.unreadbadge = response.data[0].unread_count;
                    })
                    // something went wrong with setting the notification as read
                    .catch(error => {
                        console.error('Error marking notification as read:', error);
                    })
            },

            // set all unread notifications as read
            setAllUnreadAsRead() {
                axios.get('/notifications/mark-all-as-read')
                    .then(response => {
                        this.notifications = response.data;
                        this.notifications.length === 0 ? this.unreadbadge = null : this.unreadbadge = response.data[0].unread_count;
                    })
                    // something went wrong with setting the unread notifications as read
                    .catch(error => {
                        console.error('Error marking all unread notifications as read:', error);
                    })
            },

            // fetch notifications
            fetchNotifications() {
                axios.get('/notifications')
                    .then(response => {
                        this.notifications = response.data;
                        this.notifications.length === 0 ? this.unreadbadge = null : this.unreadbadge = response.data[0].unread_count;
                        //console.log(this.notifications);
                    })
                .catch(error => {
                    // something went wrong
                    console.error('Error fetching notifications:', error);
                });
            },

            showDelete(index) {
                this.hoveredItem = index;
            },

            hideDelete() {
                this.hoveredItem = null;
            },

            whichDelete(notification) {
                // find what position the notification takes in the (multidim) array
                // and then remove it from the array. After that, tell the
                // backend to remove it from the database as well and ask for a refresh.
                let index = this.notifications.map((el) => el.id).indexOf(notification.id);
                //this.notifications.splice(index, 1);

                let notificationId = notification.id;
                // delete notification
                axios.post('/notifications/' + notificationId + '/delete')
                    .then(response => {
                        this.notifications = response.data;
                        this.notifications.length === 0 ? this.unreadbadge = null : this.unreadbadge = response.data[0].unread_count;
                    })
                    // something went wrong trying to delete the notification
                    .catch(error => {
                        console.log('Error deleting notification:', error);
                })
                console.log("deleted notification with id:" + notificationId );

            },

            deleteAllNotifications() {
                // delete all notifications from database
                axios.get('/notifications/delete-all')
                    .then(response => {
                        this.notifications = response.data;
                        this.notifications.length === 0 ? this.unreadbadge = null : this.unreadbadge = response.data[0].unread_count;
                    })
                    // something went wrong deleting all notifications
                    .catch(error => {
                        console.log('Error deleting all notifications: '. error);
                    });
            }



        },

        mounted() {
            this.$root.$on('closeSister', () => {
                this.menuActive = true;
                this.closeMenu();
            });

            // fetch notifications for logged in user
            this.fetchNotifications();
            // check for new notifications every 3 seconds
            setInterval(() => {
                this.fetchNotifications();
                console.log("loaded");
            }, 3000);
        }
    }
</script>

<style scoped>
    .container {
        overflow-x: hidden;
        position: relative;
    }

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
        min-height: 200px;
        max-height: 400px;
        overflow-y: scroll;
        /* scrollbar vars */
        --scrollbarBG: #90A4AE;
        --thumbBG: #90A4AE;
        scroll-behavior: smooth;
        overflow-x: hidden;
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
        opacity: 0;
        visibility: hidden;
        transition: all 0.2s ease-out;
    }

    .notify_ul li {
        width: 100%;
        height: auto;
        background-color: white;
        margin: 0;
        font-family: 'Terminal Dosis', sans-serif;
        font-size: 14px;
        padding: 5px 5px 5px 15px;
        border-bottom: 1px solid #f3f2f3;
        line-height: 15px;
        backface-visibility: hidden;
    }

    .notify_ul li:hover {
        background-color: #f7f9fa;
    }

    .notify_ul li:hover .notify_delete {
        opacity: 1;
        transition: all 0.2s ease-out;
    }

    .notify_ul li a {
        color: #e28633;
        font-weight: bold;
    }

    .notify_unread {
        border-left: 4px solid #c9d466;
        font-weight: bold;
        color: black !important;
        display: inline-block;
    }
    .notify_read {
        border-left: none;
        font-weight: normal;
        color: #a7a5a5;
        display: inline-block;
    }

    .notify_ul::after {
        content: "";
        position: absolute;
        top: -22px; /* At the top of the menu */
        left: 88%;
        margin-left: -5px;
        border-width: 11px;
        border-style: solid;
        border-color: transparent transparent #ffffff transparent;
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
    .mark_as_read {
        color: #a7acb7;
        font-family: 'Terminal Dosis', sans-serif;
        font-weight: normal !important;
        font-size: 14px;
        width: 100%;
        padding-left: 15px;
        line-height: 11px;
        padding-top: 5px;
    }
    .mark_as_read a {
        color: inherit;
        text-decoration: none;
    }
    .mark_as_read a:hover {
        color: #c9d466;
        text-decoration: underline;
    }
    .notify_comment {
        display: flex;
    }

    .notify_delete {
        width: fit-content;
        height: 0;
        width: -moz-fit-content;
        cursor: pointer;
        position: relative;
        right: -315px;
        top: 0;
        align-content: center;
        opacity: 0;
        transition: all 0.2s ease-out;
    }

    .notify_none {
        font-size: 12px;
        display: flex;
        justify-content: center;
        justify-items: center;
        align-items: center;
        flex-direction: column;
        min-height: 200px;
    }

    #notify_none_bgimage {
        width: 150px;
        height: 150px;
        opacity: 50%;
        margin-bottom: 20px;
    }

    .inactive_link {
        color: #c5c6c0; /* Change text color */
        cursor: not-allowed; /* Change cursor */
        pointer-events: none; /* Disable pointer events */
        text-decoration: none; /* Remove underline */
    }
</style>
