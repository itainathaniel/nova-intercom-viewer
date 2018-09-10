Nova.booting((Vue, router) => {
    Vue.component('intercom-viewer', require('./components/ResourceTool'));
    Vue.component('nav-menu', require('./components/IntercomViewerNavMenu'));

    router.addRoutes([
        {
            name: 'intercom-viewer-more',
            path: '/intercom-viewer/:resourceName/more/:userId',
            component: require('./components/UserMore'),
            props: true
        },
        {
            name: 'intercom-viewer-events',
            path: '/intercom-viewer/:resourceName/events/:userId',
            component: require('./components/UserEvents'),
            props: true
        },
        {
            name: 'intercom-viewer-notes',
            path: '/intercom-viewer/:resourceName/notes/:userId',
            component: require('./components/UserNotes'),
            props: true
        },
        {
            name: 'intercom-viewer-conversations',
            path: '/intercom-viewer/:resourceName/conversations/:userId',
            component: require('./components/UserConversations'),
            props: true
        },
    ])
})
