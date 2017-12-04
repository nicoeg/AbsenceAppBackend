<template>
    <v-container fluid="fluid" class="text-xs-center">
        <v-layout row wrap>
            <v-flex xs12 sm12>
                <v-list>
                    <template v-for="item in classesFiltered">
                        <v-list-tile
                            :key="item.name"
                            ripple
                            @click="classClicked(item)"
                        >
                            <v-list-tile-content>
                                <v-list-tile-title v-text="item.name"></v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>

                        <v-divider :key="item.name"></v-divider>
                    </template>
                </v-list>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        props: ['user', 'search'],

        data() {
            return {
                classes: [
                    { id: 1, name: 'First' },
                    { id: 2, name: 'Second' },
                    { id: 3, name: 'Third' },
                    { id: 4, name: 'Fourth' }
                ]
            }
        },

        computed: {
            classesFiltered() {
                const search = this.search.toLowerCase()

                return this.classes.filter(item => {
                    return item.name.toLowerCase().includes(search)
                })
            }
        },

        methods: {
            classClicked(item) {
                this.$router.push('/students/' + item.id)
            }
        },

        mounted() {

        }
    }
</script>
