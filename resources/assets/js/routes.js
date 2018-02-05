import VueRouter from 'vue-router';

import Links from './components/Links.vue';

let routes = [
    {
        'path' : '/',
        'component' : Links
    },
];

export default new VueRouter({
    routes
});
