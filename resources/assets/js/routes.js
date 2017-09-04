import VueRouter from 'vue-router';

import Example from './components/Example.vue';

let routes = [
    {
        'path' : '/test',
        'component' : Example
    },
];

export default new VueRouter({
    routes
});
