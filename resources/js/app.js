
require('./bootstrap');

window.Vue = require('vue').default;
import routes from "./routes";
import common from "./common/common";
Vue.mixin(common)

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin-master', require('./components/layouts/adminMaster').default);

//vue pagination
Vue.component('pagination', require('laravel-vue-pagination'));


const app = new Vue({
    el: '#app',
    router:routes
});
