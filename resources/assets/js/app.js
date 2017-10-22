import App from './components/App.vue';
import Vue from 'vue';

export function createApp () {
    return new Vue({
        render: h => h(App)
    });
}
