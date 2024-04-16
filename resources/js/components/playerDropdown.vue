<template>
    <div class="autocomplete">
        <span>Player who scored the goal:</span>
        <input type="text" class="search" v-model="search" @input="handleInput" placeholder="Search player..."/>
        <div v-if="isOpen && filteredOptions.length > 0">
            <ul class="autocomplete-results">
                <li v-for="(option, index) in filteredOptions" :key="index">
                    {{ option.label }}
                    <ul v-if="option.subgroups">
                        <li v-for="(subgroup, subIndex) in option.subgroups" :key="subIndex" class="autocomplete-result">
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
            }
        },

        data() {
            return {
                search: '',
                results: [],
                isOpen: false,
                playersByCountryArray: [],
                options: [
                    {
                        label: 'Fruits',
                        subgroups: [
                            { name: 'Apple' },
                            { name: 'Banana' },
                            { name: 'Orange' }
                        ]
                    },
                    ]
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
            filterResults() {
                this.results = this.items.filter(item => item.toLowerCase().indexOf(this.search.toLowerCase()) > -1);
            },

            onChange() {
                this.$emit('input', this.search);

                if(this.isAsync) {
                    this.isLoading = true;
                }   else {
                    this.filterResults();
                    this.isOpen = true;
                }
            },

            handleInput() {
                this.isOpen = true;
            },

            setResult(result) {
                this.search = result;
                this.isOpen = false;
            },

            handleClickOutside(event) {
                if (!this.$el.contains(event.target)) {
                    this.isOpen = false;
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
                            flagUrl: option.flag_url,
                            subgroups: matchingSubgroups
                        });
                    }
                });
                return filtered;
            },
        },

        mounted() {
            //this.playersByCountryArray = JSON.parse(this.items);
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
        font-family: "Roboto", sans-serif;
        font-size: 14px;
        color: slategray;
    }

    .autocomplete {
        position: relative;
        transition: all 0.3s ease-out;
    }

    .autocomplete-results {
        margin: 3px;
        border: 1px solid #eee;
        height: 300px;
        min-height: 1em;
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

    .autocomplete-result {
        list-style: none;
        text-align: left;
        padding: 5px 2px 5px 7px;
        margin: 2px;
        cursor: pointer;
        transition: all 0.3s ease-out;
        border-radius: 5px;
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
