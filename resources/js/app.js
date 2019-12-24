require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
import chat from './components/Chat/Index.vue';

const app = new Vue({
    el: '#app',
    components: {
        chat,
    }
});
