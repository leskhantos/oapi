import Vue from "vue";
import SpotTemplate from "./components/spot-template";
import VueWait from 'vue-wait'
import Vuex from 'vuex';
import "bootstrap/dist/css/bootstrap.css";
Vue.use(VueWait)
Vue.use(Vuex);
const store = new Vuex.Store();

Vue.component("spot-template", SpotTemplate);

new Vue({
    el: "#spot-template",
    store,
    wait: new VueWait({
        useVuex: true
    })
});
