<script>
    export default {
        props: ['resourceName', 'userId'],

        data(){
            return {
                loading: true,
                notes: [],
            }
        },
        computed: {
            basePath() {
                return Nova.config.base
            },
        },
        mounted() {
            this.loadUserNotes()
        },
        methods: {
            loadUserNotes(){
                Nova.request()
                    .get(`/nova-vendor/intercom-viewer/user/${this.userId}/notes`)
                    .then(response => {
                        this.notes = response.data
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
            <heading class="mb-6">User Notes</heading>
            <nav-menu :resourcename="resourceName" :resourceid="userId" current="notes"></nav-menu>
        </div>

        <loading-view :loading="loading">
            <div class="card mb-6 relative" v-if="!loading && notes && notes.length">
                <div class="overflow-hidden overflow-x-auto relative">
                    <table cellpadding="0" cellspacing="0" data-testid="resource-table" class="table w-full">
                        <thead>
                        <tr>
                            <th class="text-left"><span class="cursor-pointer inline-flex items-center">Created</span></th>
                            <th class="text-left"><span class="cursor-pointer inline-flex items-center">Author</span></th>
                            <th class="text-left"><span class="cursor-pointer inline-flex items-center">Body</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="note in notes">
                            <td><span class="whitespace-no-wrap text-left">{{created(note.created_at)}}</span></td>
                            <td>
                                <span class="whitespace-no-wrap text-left flex items-center">
                                    <img class="w-8 h-8 rounded-full mr-4" :src="note.author.avatar.image_url" alt="`Avatar of ${note.author.name}`">
                                    <div class="text-sm">
                                        <p class="text-black leading-none">{{note.author.name}}</p>
                                        <p class="text-grey-dark">{{note.author.type}}</p>
                                    </div>
                                </span>
                            </td>
                            <td><span class="whitespace-no-wrap text-left">{{note.body.replace(/<[^>]*>/g, '')}}</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <card class="h-auto p-4 mb-4" v-if="notes.length">
                <p>
                    <strong>Created</strong>: The time the note was created as a UTC Unix timestamp.
                    <hr>
                    <strong>Author</strong>: Optional. Represents the Admin that created the note.
                    <hr>
                    <strong>Body</strong>: The body text of the note.
                </p>
            </card>
        </loading-view>
        <div class="card mb-6 py-3 px-6" v-if="!loading && !notes.length">
            <p class="text-90">User has no notes.</p>
        </div>
    </div>
</template>
