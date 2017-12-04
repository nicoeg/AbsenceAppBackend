<template>
    <v-container fluid="fluid" class="text-xs-center">
        <v-layout row wrap center style="justify-content: center">
            <v-flex xs12 sm4 center>
                <h1>Login</h1>
                <v-card >
                    <v-card-text>
                        <form action="/login" method="POST">
                            <input type="hidden" name="_token" :value="csrf">

                            <div v-if="error" class="error--text" v-text="error"></div>

                            <v-text-field
                                name="username"
                                label="Brugernavn"
                                required
                                autofocus
                            ></v-text-field>
                            <v-text-field
                                type="password"
                                name="password"
                                label="Adgangskode"
                                required
                            ></v-text-field>

                            <v-checkbox
                                name="remember"
                                label="Husk"
                                required
                                v-model="remember"
                            ></v-checkbox>

                            <v-btn type="submit">
                                Login
                            </v-btn>
                        </form>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        props: ['error'],

        data() {
            return {
                csrf: '',
                remember: true
            }
        },

        mounted() {
            this.csrf = document.head.querySelector('meta[name="csrf-token"]').content
        }
    }
</script>