import { mount } from 'vue-test-utils';
import Links from '../assets/js/components/Links.vue';
import expect from 'expect';

describe ('Links', () => {
    it ('it displays to-read links', () => {
        let wrapper = mount(Links);
        console.log(wrapper.vm.url);
    });
});
