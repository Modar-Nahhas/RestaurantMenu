import {createApp} from 'vue'
import App from "@/Pages/App.vue";
import Vuetify from "@/Plugins/Vuetify.js";
import Router from "@/Plugins/Router.js";
import Store from "@/Plugins/Store.js";
import Notifications from "@kyvg/vue3-notification";

const app = createApp(App)
app.config.devtools = true
app.use(Store)
    .use(Router)
    .use(Vuetify)
    .use(Notifications)
    .mount('#app')
