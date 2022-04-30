<template>
<div id="container">
    <div id="country_flags" :style="flaglistStyle">
        <transition-group name="country_list" tag="div">
            <span v-for="country in countries" :key="country.id" id="country_list-item" @click="chooseFlagItem(country)" :content="country.name" v-tippy="{placement: 'top', appendTo: 'parent', arrow : true, arrowType : 'round', animation : 'scale', animateFill: true, followCursor: 'horizontal', theme: 'login'}">
                <img :src="'/images/country_flags/' + country.flag_url" height="60px" width="60px" alt="country"></img>
            </span>
        </transition-group>
    </div>

    <div id="avatars" :style="avatarslistStyle">
        <transition-group name="country_list" tag="div">
            <span v-for="gamer in avatars" :key="gamer.id" id="avatar_list-item" @click="chooseAvaItem(gamer)">
                <img :src="'/images/avatars/' + gamer.url" height="60px" width="60px" alt="profilepic"></img>
            </span>
        </transition-group>
    </div>

</div>
</template>

<script>
    export default {
        name: "countryList",

        props: ['countries', 'avatars'],

        data() {
            return {
                flaglist: false,
                avatarlist: false,
                flaglistStyle: '',
                avatarslistStyle: ''
            }
        },

        methods: {
            getImgUrl(src) {
                return require('/images/country_flags/'+src);
            },

            toggleFlagList() {
                document.getElementById('country_flags').scrollTop = 0;
                this.flaglist = !this.flaglist;
                this.flaglist ? this.flaglistStyle = "height: 80px; width: 80px; overflow-y:hidden; padding: 0" : this.flaglistStyle = "height: 335px; width: 200px; overflow-y: scroll";
                /*
                return this.countries = _.shuffle(this.countries);
                */
            },

            toggleAvaList() {
                document.getElementById('avatars').scrollTop = 0;
                this.avatarlist = !this.avatarlist;
                this.avatarlist ? this.avatarslistStyle = "height: 80px; width: 80px; overflow-y:hidden; padding: 0" : this.avatarslistStyle = "height: 335px; width: 200px; overflow-y: scroll";
                /*
                return this.countries = _.shuffle(this.countries);
                */
            },

            chooseFlagItem(self) {
                // what index does the item have?
                if(!this.flaglist) {
                    let index = this.countries.findIndex(i => i.id === self.id)
                    this.countries.splice(index, 1);
                    this.countries.unshift(self);
                }
                // collapse menu
                this.toggleFlagList();
            },

            chooseAvaItem(self) {
                // what index does the item have?
                if(!this.avatarlist) {
                    let index = this.avatars.findIndex(i => i.id === self.id)
                    this.avatars.splice(index, 1);
                    this.avatars.unshift(self);
                }
                // collapse menu
                this.toggleAvaList();
            },

        }
    }
</script>

<style>
    #country_flags, #avatars {
        border-radius: 8px;
        float: left;
        margin-right: 25px;
        padding: 10px 0 10px 15px;
        text-align: left;
        width: 200px;
        height: 335px;
        background-color:white;
        overflow-y: scroll;
        overflow-x: hidden;
        transition: all 500ms cubic-bezier(1.000, 0.000, 0.000, 1.000); /* easeInOutExpo */
        transition-timing-function: cubic-bezier(1.000, 0.000, 0.000, 1.000); /* easeInOutExpo */
        /* scrollbar vars */
        --scrollbarBG: white;
        --thumbBG: #90A4AE;
        scrollbar-width: thin;
        scrollbar-color: var(--thumbBG) var(--scrollbarBG);
        scroll-behavior: smooth;
    }

    #country_list-item, #avatar_list-item {
        border: 1px solid #ccc;
        border-radius: 6px;
        padding: 6px;
        transition: all 0.3s ease-out;
        display: inline-block;
        margin: 3px;
        cursor: pointer;
        background-color: #efeded;
        box-shadow: inset 0 2px 0 0 hsla(0,0%,100%,0.8);
    }

    #country_flags::-webkit-scrollbar, #avatars::-webkit-scrollbar {
        width: 11px;
    }

    #country_flags::-webkit-scrollbar-track, #avatars::-webkit-scrollbar-track {
        background: var(--scrollbarBG);
    }
    #country_flags::-webkit-scrollbar-thumb, #avatars::-webkit-scrollbar-thumb {
        background-color: var(--thumbBG) ;
        border-radius: 6px;
        border: 3px solid var(--scrollbarBG);
    }

    .tippy-tooltip.login-theme {
        background-color: #ccc;
        color: #3382a0;
        font-size: 11px;
        box-shadow: inset 0 1px 0 0 hsla(0,0%,100%,0.8);
        border: 1px solid #999898;
    }
    .tippy-tooltip.login-theme .tippy-roundarrow{
        fill: #ccc;
    }
</style>
