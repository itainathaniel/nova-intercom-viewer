<script>
    export default {
        props: ['resourceName', 'userId'],

        data(){
            return {
                loading: true,
                events: [],
            }
        },
        computed: {
            basePath() {
                return Nova.config.base
            },
        },
        mounted() {
            this.loadUserEvents()
        },
        methods: {
            loadUserEvents(){
                Nova.request()
                    .get(`/nova-vendor/intercom-viewer/user/${this.userId}/events`)
                    .then(response => {
                        this.events = response.data
                        this.loading = false
                    })
            },
            created(created_at) {
                let created = new Date(created_at * 1000)
                return `${created.toDateString()} ${created.toLocaleTimeString()}`
            }
        }
    }
</script>

<template>
    <div>
        <div class="flex items-center mb-3">
            <heading class="mb-6">User Events</heading>
            <nav-menu :resourcename="resourceName" :resourceid="userId" current="events"></nav-menu>
        </div>

        <loading-view :loading="loading">
            <div class="card mb-6 relative" v-if="!loading && events && events.length">
                <div class="overflow-hidden overflow-x-auto relative">
                    <table cellpadding="0" cellspacing="0" data-testid="resource-table" class="table w-full">
                        <thead>
                        <tr>
                            <th class="text-left"><span class="cursor-pointer inline-flex items-center">Created</span></th>
                            <th class="text-left"><span class="cursor-pointer inline-flex items-center">Name</span></th>
                            <th class="text-left"><span class="cursor-pointer inline-flex items-center">metadata</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="event in events">
                            <td><span class="whitespace-no-wrap text-left">{{created(event.created_at)}}</span></td>
                            <td><span class="whitespace-no-wrap text-left">{{event.event_name}}</span></td>
                            <td>
                                <span class="whitespace-no-wrap text-left" v-if="Object.getOwnPropertyNames(event.metadata).length > 1">{{event.metadata}}</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <card class="h-auto p-4 mb-4" v-if="events.length">
                <p>
                    <strong>Created</strong>: The time the event occurred as a UTC Unix timestamp.
                    <hr>
                    <strong>Name</strong>: The name of the event that occurred. This is presented to your App's admins when filtering and creating segments - a good event name is typically a past tense 'verb-noun' combination, to improve readability, for example updated-plan.
                    <hr>
                    <strong>Metadata</strong>: optional metadata about the event.
                </p>
            </card>
        </loading-view>
        <div class="card mb-6 py-3 px-6" v-if="!loading && !events.length">
            <p class="text-90">User has no events.</p>
        </div>
    </div>
</template>
