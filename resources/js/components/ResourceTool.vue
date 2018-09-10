<template>
    <div>
    	<loading-view :loading="loading">
            <p class="text-90" v-if="!intercomUser">
                User has no data on intercom
            </p>

            <div v-if="intercomUser">
                <div class="flex border-b border-40" v-if="!field.hide_field_avatar">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">avatar</h4></div>
                    <div class="w-3/4 py-4">
                        <span class="whitespace-no-wrap text-left flex items-center">
                            <img class="w-8 h-8 rounded-full mr-4" :src="user.avatar.image_url" alt="`Avatar of ${user.name}`">
                        </span>
                    </div>
                </div>

    			<div class="flex border-b border-40" v-if="!field.hide_field_id">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">intercom's id</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{user.id}}</p></div>
                </div>

    			<div class="flex border-b border-40" v-if="!field.hide_field_email">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">email</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{user.email}}</p></div>
                </div>

    			<div class="flex border-b border-40" v-if="!field.hide_field_phone">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">phone</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{user.phone}}</p></div>
                </div>

    			<div class="flex border-b border-40" v-if="!field.hide_field_name">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">name</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{user.name}}</p></div>
                </div>

                <div class="flex border-b border-40" v-if="!field.hide_field_anonymous">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">anonymous</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{user.anonymous}}</p></div>
                </div>

                <div class="flex border-b border-40" v-if="!field.hide_field_pseudonym">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">pseudonym</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{user.pseudonym}}</p></div>
                </div>

                <div class="flex border-b border-40" v-if="!field.hide_field_last_seen_ip">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">last_seen_ip</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{user.last_seen_ip}}</p></div>
                </div>

                <div class="flex border-b border-40" v-if="!field.hide_field_remote_created_at">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">remote_created_at</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{created(user.remote_created_at)}}</p></div>
                </div>

                <div class="flex border-b border-40" v-if="!field.hide_field_created_at">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">created_at</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{created(user.created_at)}}</p></div>
                </div>

                <div class="flex border-b border-40" v-if="!field.hide_field_updated_at">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">updated_at</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{created(user.updated_at)}}</p></div>
                </div>

                <div class="flex border-b border-40" v-if="!field.hide_field_signed_up_at">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">signed_up_at</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{created(user.signed_up_at)}}</p></div>
                </div>

                <div class="flex border-b border-40" v-if="!field.hide_field_last_request_at">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">last_request_at</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{created(user.last_request_at)}}</p></div>
                </div>

                <div class="flex border-b border-40" v-if="!field.hide_field_session_count">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">session_count</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{user.session_count}}</p></div>
                </div>

                <div class="flex border-b border-40" v-if="!field.hide_field_unsubscribed_from_emails">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">unsubscribed_from_emails</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{user.unsubscribed_from_emails}}</p></div>
                </div>

                <div class="flex border-b border-40" v-if="!field.hide_field_marked_email_as_spam">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">marked_email_as_spam</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{user.marked_email_as_spam}}</p></div>
                </div>

    			<div class="flex border-b border-40" v-if="!field.hide_field_has_hard_bounced">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">has_hard_bounced</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{user.has_hard_bounced}}</p></div>
                </div>

                <div class="flex border-b border-40" v-if="!field.hide_field_user_agent_data">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">user_agent_data</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{user.user_agent_data}}</p></div>
                </div>

    			<div class="flex border-b border-40" v-if="!field.hide_field_analytics">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">Analytics</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">
                        <strong>referrer</strong>: {{user.referrer}}
                        <strong>utm_campaign</strong>: {{user.utm_campaign}}
                        <strong>utm_content</strong>: {{user.utm_content}}
                        <strong>utm_medium</strong>: {{user.utm_medium}}
                        <strong>utm_source</strong>: {{user.utm_source}}
                        <strong>utm_term</strong>: {{user.utm_term}}
                        
                    </p></div>
                </div>

    			<div class="flex border-b border-40" v-if="intercomUser">
    				<div class="w-1/4 py-4"><h4 class="font-normal text-80 font-bold">More</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">
                        <a class="text-primary no-underline" :href="`https://app.intercom.io/a/apps/${this.app_id}/users/${this.user.id}`">
                            User @ Intercom
                        </a> / Panels:
                        <a class="text-primary no-underline" :href="morePath">
                            Social, Location & Custom Attributes
                        </a> / <a class="text-primary no-underline" :href="conversationsPath">
                            Conversations
                        </a> / <a class="text-primary no-underline" :href="eventsPath">
                            Events
                        </a> / <a class="text-primary no-underline" :href="notesPath">
                            Notes
                        </a>
                    </p></div>
                </div>
            </div>
        </loading-view>
    </div>
</template>

<script>
    export default {
        props: ['resourceName', 'resourceId', 'field'],

        data() {
            return {
                loading: true,
                user: null,
                intercomUser: false,
                app_id: Nova.config.app_id,
            }
        },

        computed: {
            basePath() {
                return Nova.config.base
            },
            morePath() {
                return `${this.basePath}/intercom-viewer/${this.resourceName}/more/${this.resourceId}`
            },
            conversationsPath() {
                return `${this.basePath}/intercom-viewer/${this.resourceName}/conversations/${this.resourceId}`
            },
            eventsPath() {
                return `${this.basePath}/intercom-viewer/${this.resourceName}/events/${this.resourceId}`
            },
            notesPath() {
                return `${this.basePath}/intercom-viewer/${this.resourceName}/notes/${this.resourceId}`
            },
        },

        mounted() {
            this.loadUserData()
        },

        methods: {
            loadUserData(){
	            Nova.request()
	                .get(`/nova-vendor/intercom-viewer/user/${this.resourceId}`)
                    .then(response => {
                        this.user = response.data
                        this.intercomUser = true
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
