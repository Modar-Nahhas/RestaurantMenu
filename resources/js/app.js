import {createApp} from 'vue'
import App from "@/Pages/App.vue";
import Vuetify from "@/Plugins/Vuetify.js";
import Router from "@/Plugins/Router.js";
import Store from "@/Plugins/Store.js";

const app = createApp(App)

app.use(Store)
    .use(Router)
    .use(Vuetify)
    .mount('#app')
