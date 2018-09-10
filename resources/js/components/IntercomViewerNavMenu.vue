<template>
<div class="ml-auto flex">
    <a :class="classes(6)" :href="`${basePath}/resources/${resourcename}/${resourceid}`">Back</a>
    <a v-for="item in ['conversations', 'events', 'more', 'notes']"
    	v-if="current != item"
    	:class="classes(2)"
    	:href="path(item)"
    >{{item}}</a>
</div>
</template>

<script>
export default {
	props: ['resourcename', 'resourceid', 'current'],

	data() {
		return {
			basePath: Nova.config.base
		}
	},

	methods: {
        path(resource) {
            return `${this.basePath}/intercom-viewer/${this.resourcename}/${resource}/${this.resourceid}`
        },
		classes(margin) {
			return `btn btn-default btn-white hover:bg-80 hover:text-white text-80 mr-${margin}`
		}
	}
}
</script>
