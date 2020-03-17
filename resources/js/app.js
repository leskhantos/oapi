import Vue from "vue";
import SpotTemplate from "./components/spot-template";

import "bootstrap/dist/css/bootstrap.css";

Vue.component("spot-template", SpotTemplate);

new Vue({ el: "#spot-template" });
