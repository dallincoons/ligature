import VueRouter from 'vue-router';

import Links from './components/Links.vue';

let routes = [
    {
        'path' : '/links',
        'component' : Links
    },
];

export default new VueRouter({
    routes
});
