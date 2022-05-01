<template>
<div id="container_countrylist">
    <div id="container_countries">
        <div class="choose_item">Which team do you root for?</div>
        <div id="country_flags" :style="flaglistStyle">
            <transition-group name="country_list" tag="div">
                <span v-for="country in countries" :key="country.id" id="country_list-item" @click="chooseFlagItem(country)" :content="country.name" v-tippy="{placement: 'top', appendTo: 'parent', arrow : true, arrowType : 'round', animation : 'scale', animateFill: true, followCursor: 'horizontal', theme: 'login'}">
                    <img :src="'/images/country_flags/' + country.flag_url" height="60px" width="60px" alt="country"></img>
                </span>
            </transition-group>
        </div>
    </div>

    <div id="container_avatars">
        <div class="choose_item">Choose your default avatar</div>
        <div id="avatars" :style="avatarslistStyle">
            <transition-group name="country_list" tag="div">
            <span v-for="gamer in avatars" :key="gamer.id" id="avatar_list-item" @click="chooseAvaItem(gamer)">
                <img :src="'/images/avatars/' + gamer.url" height="60px" width="60px" alt="profilepic"></img>
            </span>
            </transition-group>
        </div>
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
                this.flaglist ? this.flaglistStyle = "height: 80px; width: 80px; overflow-y:hidden; padding: 0" : this.flaglistStyle = "height: 340px; width: 195px; overflow-y: scroll";
                /*
                return this.countries = _.shuffle(this.countries);
                */
            },

            toggleAvaList() {
                document.getElementById('avatars').scrollTop = 0;
                this.avatarlist = !this.avatarlist;
                this.avatarlist ? this.avatarslistStyle = "height: 80px; width: 80px; overflow-y:hidden; padding: 0" : this.avatarslistStyle = "height: 340px; width: 195px; overflow-y: scroll";
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
                // set hidden text field
                document.getElementById('rooting').value = self.id;
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
                // set hidden text field
                document.getElementById('avatar').value = self.id
            },

        },

        mounted() {
            document.getElementById('rooting').value="1";
            document.getElementById('avatar').value="1";
        }
    }
</script>

<style>
    #container_countrylist {
        width: 440px;
        height: 360px;
        position: absolute;
        background: rgb(240,240,241);
        background: linear-gradient(180deg, rgba(240,240,241,1) 0%, rgba(255,255,255,1) 100%);
    }

    #container_countries {
        float: left;
    }

    #container_avatars {
        float: left;
    }

    .choose_item {
        font-family: 'Oswald', sans-serif;
        font-size: small;
        letter-spacing: .03rem;
        color: #3382a0;
        text-align: left;
        width: 220px;
        height:20px;
        padding-left: 5px;
    }
    #country_flags, #avatars {
        border-radius: 8px;
        margin-right: 25px;
        padding: 10px 0 10px 15px;
        text-align: left;
        float: left;
        width: 195px;
        height: 340px;
        overflow-y: scroll;
        overflow-x: hidden;
        transition: all 800ms cubic-bezier(1.000, 0.000, 0.000, 1.000); /* easeInOutExpo */
        transition-timing-function: cubic-bezier(1.000, 0.000, 0.000, 1.000); /* easeInOutExpo */
        /* scrollbar vars */
        --scrollbarBG: #90A4AE;
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

    #country_list-item:hover, #avatar_list-item:hover {
        background-color: #dedcdc;
    }

    #country_flags::-webkit-scrollbar, #avatars::-webkit-scrollbar {
        width: 7px;
    }

    #country_flags::-webkit-scrollbar-track, #avatars::-webkit-scrollbar-track {
        background: var(--scrollbarBG);
        display: none;
        -webkit-box-shadow: none;
    }
    #country_flags::-webkit-scrollbar-thumb, #avatars::-webkit-scrollbar-thumb {
        background-color: var(--thumbBG) ;
        border-radius: 6px;
        border: 3px solid var(--scrollbarBG);
    }

    .tippy-tooltip.login-theme {
        font-family: 'Oswald', sans-serif;
        background-color: #ccc;
        color: #3382a0;
        font-size: 12px;
        box-shadow: inset 0 1px 0 0 hsla(0,0%,100%,0.8);
        border: 1px solid #999898;
    }
    .tippy-tooltip.login-theme .tippy-roundarrow{
        fill: #ccc;
    }
</style>
