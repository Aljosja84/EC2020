<template>
    <div class="autocomplete">
        <span>Player who scored the goal:</span>
            <input type="text" class="search" v-model="search" @input="handleInput" placeholder="Search player..."/>
        <div class="resultsWin" :style="resultStyle">
            <ul class="autocomplete-results">
                <li v-for="(option, index) in filteredOptions" :key="index">
                    <div class="countryGroup">
                        <img :src="option.flagUrl"/>
                        <div>{{ option.label }}</div>
                    </div>
                    <ul v-if="option.subgroups">
                        <li v-for="(subgroup, subIndex) in option.subgroups" :key="subIndex" :id="subgroup.player_id" class="autocomplete-result" @click="setResult(subgroup.name)" @mouseenter="onOptionMouseMove($event, subgroup.player_id)">
                            {{ subgroup.name }}
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {

        name: "playerDropdown",

        props: {
            isAsync: {
                type: Boolean,
                required: false,
                default: false,
            },
            items: {
                type: Array,
                required: false,
                default: () => []
            },
            focusOnHover: {
                type: Boolean,
                default: true
            },
        },

        data() {
            return {
                search: '',
                results: [],
                isOpen: false,
                searching: false,
                resultsWin: false,
                playersByCountryArray: [],
                resultStyle: "opacity: 0%; visibility: hidden",
            }
        },

        watch: {
            items: function(value, oldValue) {
                if(this.isAsync) {
                    this.results = value;
                    this.isOpen = true;
                    this.isLoading = false;
                }
            }
        },

        methods: {
            handleInput() {
                this.search.length > 0 ? this.resultStyle = "opacity: 100%; visibility: visible" : this.resultStyle = "opacity: 0%; visibility: hidden";
            },

            handleClickOutside(event) {
                if (!this.$el.contains(event.target)) {
                    this.resultStyle = "opacity: 0%; visibility: hidden";
                }
            },

            setResult(result) {
                this.resultStyle = "opacity: 0%; visibility: hidden";
                setTimeout(() => {
                    this.search = result;
                }, 200);
            },

            onOptionMouseMove(event, index) {
                const element = document.getElementById(index);
                if(element) {
                    element.scrollIntoView && element.scrollIntoView({ block: 'nearest', behavior: 'smooth'});
                }
            }
        },

        computed: {
            filteredOptions() {
                const filtered = [];
                this.items.forEach(option => {
                    const matchingSubgroups = option.players.filter(subgroup =>
                        subgroup.name.toLowerCase().includes(this.search.toLowerCase())
                    );
                    if (matchingSubgroups.length > 0) {
                        filtered.push({
                            label: option.name,
                            flagUrl: "/images/" + option.flag_url,
                            subgroups: matchingSubgroups
                        });
                    }
                });
                return filtered;
            },

            resultStyleCom() {
                return this.resultsWin === true ? 'opacity: 100%; visibility: visible' : 'opacity: 0%; visibility: hidden';
            }
        },

        mounted() {
            //this.playersByCountryArray = JSON.parse(this.items);
            console.log(this.items);
            document.addEventListener('click', this.handleClickOutside);
        },

        destroyed() {
            document.removeEventListener('click', this.handleClickOutside);;
        }
    }
</script>

<style scoped>
    .search {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid lightslategray;
        border-radius: 5px;
        background-color: white;
        background-image: url('/images/icons8-search-24.png');
        background-position: 7px 7px;
        background-repeat: no-repeat;
        background-size: 20px 20px;
        padding: 9px 20px 9px 30px;
        font-family: "Terminal Dosis", sans-serif;
        font-size: 15px;
        color: slategray;
    }

    .resultsWin {
        position: absolute;
        z-index: 999;
        background-color: white;
        width: 100%;
        transition: all 0.2s ease-out;
    }

    .countryGroup {
        font-family: 'Terminal Dosis', sans-serif;
        font-weight: bold;
        font-size: 17px;
        color: #9badbf;
        padding: 2px 2px 2px 10px;
        display: flex;
        align-items: center;
    }

    .countryGroup img {
        width: 18px;
        height: 18px;
        margin-right: 5px;
    }

    .autocomplete {
        transition: all 0.3s ease-out;
    }

    .autocomplete-results {
        font-family: "Terminal Dosis", sans-serif;
        font-size: 14px;
        margin: 3px;
        border: 1px solid #eee;
        height: fit-content;
        max-height: 300px;
        overflow: auto;
        transition: all 0.3s ease-out;
        /* scrollbar vars */
        --scrollbarBG: #90A4AE;
        --thumbBG: #90A4AE;
        scroll-behavior: smooth;
        border-radius: 5px;
        /* shadow */
        box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
    }

    .autocomplete-results li:last-child {
        margin-bottom: 2px;
    }

    .autocomplete-result {
        list-style: none;
        text-align: left;
        padding: 5px 2px 5px 7px;
        margin: 0 2px 0 2px;
        cursor: pointer;
        transition: all 0.3s ease-out;
        border-radius: 5px;
        -webkit-user-select: none; /* Chrome, Safari, Opera */
        -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
        user-select: none; /* Non-prefixed version */
    }

    .autocomplete-result.is-active,
    .autocomplete-result:hover {
        background-color: #e6f3ff;
        color: slategray;
        padding-left: 10px;
    }

    .autocomplete-results::-webkit-scrollbar {
        width: 7px;
    }

    .autocomplete-results::-webkit-scrollbar-track {
        background: var(--scrollbarBG);
        display: none;
        -webkit-box-shadow: none;
    }
    .autocomplete-results::-webkit-scrollbar-thumb {
        background-color: var(--thumbBG) ;
        border-radius: 6px;
        border: 3px solid var(--scrollbarBG);
    }
</style>
