<template>
    <v-container fluid="fluid" class="text-xs-center">
        <v-layout row wrap>
            <v-flex xs12 sm12>
                <v-progress-circular v-if="classes === null" indeterminate color="primary"></v-progress-circular>

                <v-list v-else>
                    <template v-for="item in classesFiltered">
                        <v-list-tile
                            :key="item.name"
                            ripple
                            @click="classClicked(item)"
                        >
                            <v-list-tile-content>
                                <v-list-tile-title v-text="item.name"></v-list-tile-title>
                            </v-list-tile-content>
                            <v-list-tile-action v-if="item.unaccepted > 0" style="color: red;" v-text="item.unaccepted"></v-list-tile-action>
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
                classes: null
            }
        },

        computed: {
            classesFiltered() {
                if (!this.classes) return []

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
            axios.get('api/user/' + this.user.id + '/groups?api_token=' + this.user.api_token)
                .then(response => {
                    this.classes = response.data
                })
        }
    }
</script>
