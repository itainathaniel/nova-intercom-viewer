<script>
    export default {
        props: ['resourceName', 'userId'],

        data(){
            return {
                loading: true,
                conversations: [],
                app_id: Nova.config.app_id
            }
        },
        computed: {
            basePath() {
                return Nova.config.base
            }
        },
        mounted() {
            this.loadUserConversations()
        },
        methods: {
            loadUserConversations(){
                Nova.request()
                    .get(`/nova-vendor/intercom-viewer/user/${this.userId}/conversations`)
                    .then(response => {
                        this.conversations = response.data
                        this.loading = false
                    })
            },
            created(created_at) {
                let created = new Date(created_at * 1000)
                return `${created.toDateString()} ${created.toLocaleTimeString()}`
            },
            conversationPath(conversation_id) {
                return `https://app.intercom.io/a/apps/${this.app_id}/inbox/inbox/all/conversations/${conversation_id}`
            }
        }
    }
</script>

<template>
    <div>
        <div class="flex items-center mb-3">
            <heading class="mb-6">User Conversations</heading>
            <nav-menu :resourcename="resourceName" :resourceid="userId" current="conversations"></nav-menu>
        </div>

        <loading-view :loading="loading">
            <div class="card mb-6 relative" v-if="!loading && conversations && conversations.length">
                <div class="overflow-hidden overflow-x-auto relative">
                    <table cellpadding="0" cellspacing="0" data-testid="resource-table" class="table w-full">
                        <thead>
                        <tr>
                            <th class="text-left"><span class="cursor-pointer inline-flex items-center">Time</span></th>
                            <th class="text-left"><span class="cursor-pointer inline-flex items-center">Message</span></th>
                            <th class="text-left"><span class="cursor-pointer inline-flex items-center">Read?</span></th>
                            <th class="text-left"><span class="cursor-pointer inline-flex items-center">State</span></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="conversation in conversations">
                            <td><span class="whitespace-no-wrap text-left">
                                Created: {{created(conversation.created_at)}}<hr>
                                Updated: {{created(conversation.updated_at)}}
                            </span></td>
                            <td><span class="whitespace-no-wrap text-left">
                                <span v-if="conversation.conversation_message.subject">Subject: {{conversation.conversation_message.subject}}<hr></span>
                                {{conversation.conversation_message.body.replace(/<[^>]*>/g, '')}}
                            </span></td>
                            <td><span class="whitespace-no-wrap text-left">{{conversation.state}}</span></td>
                            <td><span class="whitespace-no-wrap text-left">{{conversation.read ? 'read' : 'unread'}}</span></td>
                            <td class="text-right">
                                <a class="text-primary no-underline" :href="conversationPath(conversation.id)" :target="`conversation_${conversation.id}`">
                                    Conversation
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <card class="h-auto p-4 mb-4" v-if="conversations.length">
                <p>
                    <strong>Created</strong>: The time the conversation was created as a UTC Unix timestamp.
                    <hr>
                    <strong>Updated</strong>: The last time the conversation was updated as a UTC Unix timestamp.
                    <hr>
                    <strong>Message</strong>: The message that started the conversation rendered for presentation.
                    <hr>
                    <strong>State</strong>: Can be set to "open", "closed" or "snoozed".
                    <hr>
                    <strong>Read?</strong>: Indicates whether a conversation has been read.
                </p>
            </card>
        </loading-view>
        <div class="card mb-6 py-3 px-6" v-if="!loading && !conversations.length">
            <p class="text-90">User has no conversations.</p>
        </div>
    </div>
</template>
