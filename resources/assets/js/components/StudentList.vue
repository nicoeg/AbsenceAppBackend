<template>
    <v-container fluid="fluid" class="text-xs-center">
        <v-layout row wrap>
            <v-flex xs12 :sm8="selectedAttendance !== null">
                <div class="navigation">
                    <div class="date">
                        <v-btn color="primary" icon @click="jumpDays(-1)">
                            <v-icon>arrow_back</v-icon>
                        </v-btn>
                        <h3 v-text="date"></h3>
                        <v-btn color="primary" icon @click="jumpDays(1)">
                            <v-icon>arrow_forward</v-icon>
                        </v-btn>
                    </div>

                    <v-btn color="primary" @click="saveAttendanceRegistration">
                        Registrer
                    </v-btn>
                </div>

                <v-progress-circular v-if="attendances === null" indeterminate color="primary"></v-progress-circular>

                <h2 v-if="attendances && attendances.length === 0" style="text-align: left;margin: 10px 0;">Ingen indtjekninger</h2>

                <div v-if="manualAttendances && manualAttendances.length > 0" class="list-header">
                    <h2 style="text-align: left;margin: 10px 0;">Manuelle indtjekninger</h2>

                    <div style="height: 30px; padding-right: 16px;">
                        <v-checkbox v-model="manualCheck" @change="manualCheckChanged"></v-checkbox>
                    </div>
                </div>

                <template v-if="manualAttendances && manualAttendances.length > 0" v-for="attendance in manualAttendances">
                    <v-list>
                        <v-list-tile ripple>
                            <v-list-tile-content>
                                <v-list-tile-title v-text="attendance.user.name"></v-list-tile-title>
                            </v-list-tile-content>

                            <v-list-tile-action>
                                <div class="list-action">
                                    <a @click="selectAttendance(attendance)">Se position</a>

                                    <div style="width:24px">
                                        <v-checkbox v-model="attendance.accepted"></v-checkbox>
                                    </div>
                                </div>
                            </v-list-tile-action>
                        </v-list-tile>
                        <v-divider></v-divider>
                    </v-list>
                </template>

                <div v-if="autoAttendances && autoAttendances.length > 0" class="list-header">
                    <h2 style="text-align: left;margin: 10px 0;">Automatiske indtjekninger</h2>

                    <div style="height: 30px; padding-right: 16px;">
                        <v-checkbox v-model="autoCheck" @change="autoCheckChanged"></v-checkbox>
                    </div>
                </div>

                <template v-if="autoAttendances && autoAttendances.length > 0" v-for="attendance in autoAttendances">
                    <v-list>
                        <v-list-tile ripple>
                            <v-list-tile-content>
                                <v-list-tile-title v-text="attendance.user.name"></v-list-tile-title>
                            </v-list-tile-content>

                            <v-list-tile-action>
                                <div style="width:24px">
                                    <v-checkbox v-model="attendance.accepted"></v-checkbox>
                                </div>
                            </v-list-tile-action>
                        </v-list-tile>
                        <v-divider></v-divider>
                    </v-list>
                </template>
            </v-flex>
            <v-flex v-if="selectedAttendance" xs12 sm4 style="padding-left: 30px;">
                <v-btn color="primary" @click="selectedAttendance = null">Luk</v-btn>
                <gmap-map
                    style="height: 300px"
                    :center="selectedAttendance"
                    :zoom="12"
                >
                    <gmap-marker
                        :position="selectedAttendance"
                        :clickable="true"
                    ></gmap-marker>
                </gmap-map>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import moment from 'moment'

    export default {
        props: ['user'],

        data() {
            return {
                attendances: null,
                manualCheck: false,
                autoCheck: false,
                date: null,
                selectedAttendance: null
            }
        },

        computed: {
            manualAttendances() {
                return this.attendances ? this.attendances.filter(attendance => {
                    return attendance.latitude !== null
                }) : []
            },
            autoAttendances() {
                return this.attendances ? this.attendances.filter(attendance => {
                    return attendance.latitude === null
                }) : []
            }
        },

        methods: {
            classClicked() {
                this.$router.push('/')
            },
            autoCheckChanged(value) {
                this.autoAttendances.forEach((attendance) => {
                    attendance.accepted = value
                })
            },
            manualCheckChanged(value) {
                this.manualAttendances.forEach((attendance) => {
                    attendance.accepted = value
                })
            },
            jumpDays(days) {
                this.date = moment(this.date).add(days, 'days').format('Y-MM-DD')

                this.fetchAttendances()
            },
            fetchAttendances() {
                this.attendances = null
                axios.get('api/group/' + this.$route.params.id + '/attendance?date=' + this.date)
                    .then(response => {
                        this.attendances = response.data
                    })
            },
            saveAttendanceRegistration() {
                const attendances = this.attendances.map(attendance => {
                    return { id: attendance.id, accepted: attendance.accepted }
                })

                axios.put('api/attendance/bulk', { attendances })
            },
            selectAttendance(attendance) {
                this.selectedAttendance = { lat: attendance.latitude, lng: attendance.longitude }
            }
        },

        created() {
            this.date = moment().format('Y-MM-DD')
        },

        mounted() {
            this.fetchAttendances()
        }
    }
</script>

<style>
    .list-header {
        display: flex;
        justify-content: space-between;
        width: 100%;
        align-items: center;
    }

    .navigation, .navigation .date {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .navigation .date {
        max-width: 300px;
    }

    .list-action {
        display: flex;
        align-items: center;
    }

    .list-action a {
        margin-right: 10px;
    }
</style>