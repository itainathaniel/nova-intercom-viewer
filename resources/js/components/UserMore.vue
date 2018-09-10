<script>
export default {
    props: ['resourceName', 'userId'],

    data(){
        return {
            loading: true,
            user: [],
            social_profiles: [],
            location_data: [],
            custom_attributes: [],
        }
    },
    mounted() {
        this.loadUserData()
    },
    methods: {
        loadUserData(){
            Nova.request()
                .get(`/nova-vendor/intercom-viewer/user/${this.userId}`)
                .then(response => {
                    this.user = response.data
                    this.social_profiles = this.user.social_profiles.social_profiles
                    this.location_data = this.user.location_data
                    this.custom_attributes = this.user.custom_attributes
                    this.loading = false
                })
        }
    }
}
</script>

<template>
    <div>
        <div class="flex items-center mb-3">
            <heading class="mb-6">More User Info</heading>
            <nav-menu :resourcename="resourceName" :resourceid="userId" current="more"></nav-menu>
        </div>

        <loading-view :loading="loading">
            <card class="mb-6 relative">
                <div class="overflow-hidden overflow-x-auto relative">
                    <table cellpadding="0" cellspacing="0" data-testid="resource-table" class="table w-full">
                        <thead>
                        <tr>
                            <th class="text-left"><span class="cursor-pointer inline-flex items-center">Social Network</span></th>
                            <th class="text-left"><span class="cursor-pointer inline-flex items-center">ID</span></th>
                            <th class="text-left"><span class="cursor-pointer inline-flex items-center">Username</span></th>
                            <th class="text-left"><span class="cursor-pointer inline-flex items-center">URL</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="profile in social_profiles">
                            <td><span class="whitespace-no-wrap text-left">{{profile.name}}</span></td>
                            <td><span class="whitespace-no-wrap text-left">{{profile.id}}</span></td>
                            <td><span class="whitespace-no-wrap text-left">{{profile.username}}</span></td>
                            <td><span class="whitespace-no-wrap text-left">
                                <a class="text-primary no-underline" :href="profile.url" target="_social">{{profile.url}}</a>
                            </span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </card>

            <heading class="mb-6">Location Data</heading>
            <card class="h-auto p-4 mb-4">
                <div class="flex border-b border-40">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">city_name</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{location_data.city_name}}</p></div>
                </div>
                <div class="flex border-b border-40">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">continent_code</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{location_data.continent_code}}</p></div>
                </div>
                <div class="flex border-b border-40">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">country_code</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{location_data.country_code}}</p></div>
                </div>
                <div class="flex border-b border-40">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">country_name</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{location_data.country_name}}</p></div>
                </div>
                <div class="flex border-b border-40">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">latitude, longitude</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">
                        <a class="text-primary no-underline" :href="`https://www.google.com/maps/search/${location_data.latitude},${location_data.longitude}`" target="_maps">{{location_data.latitude}}, {{location_data.longitude}}</a>
                    </p></div>
                </div>
                <div class="flex border-b border-40">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">postal_code</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{location_data.postal_code}}</p></div>
                </div>
                <div class="flex border-b border-40">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">region_name</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{location_data.region_name}}</p></div>
                </div>
                <div class="flex border-b border-40">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">timezone</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{location_data.timezone}}</p></div>
                </div>
                <div class="flex border-b border-40">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">city_name</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{location_data.city_name}}</p></div>
                </div>
            </card>

            <heading class="mb-6">Custom Attributes</heading>
            <card class="h-auto p-4 mb-4">
                <div class="flex border-b border-40" v-for="attribute, title in custom_attributes">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">{{title}}</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">{{attribute}}</p></div>
                </div>
            </card>
        </loading-view>
    </div>
</template>
