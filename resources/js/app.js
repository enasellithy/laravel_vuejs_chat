require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
import chat from './components/Chat/Index.vue';
import map_tracker from './components/MapTracker.vue';

const app = new Vue({
    el: '#app',
    components: {
        chat,
        map_tracker,
    }
});
