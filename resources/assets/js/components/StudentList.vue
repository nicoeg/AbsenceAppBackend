<template>
    <v-container fluid="fluid" class="text-xs-center">
        <v-layout row wrap>
            <v-flex xs12 sm8>
                <h2 style="text-align: left;margin: 10px 0;">Klasser</h2>
                <v-list>
                    <v-list-tile
                        ripple
                        @click="classClicked"
                    >
                        <v-list-tile-content>
                            <v-list-tile-title>Klasse navn</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-divider></v-divider>
                </v-list>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        props: ['user'],

        methods: {
            classClicked() {
                this.$router.push('/')
            }
        },
    }
</script>
