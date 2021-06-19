import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);



import adminHome from "../components/admin/adminHome";
import mainCategory from "../components/admin/category/mainCategory";

const routes = new VueRouter({
    mode:'history',
    linkExactActiveClass:'active',
    routes:[
        {
            path:'/admin',
            component:adminHome,
            name:'admindashboard'
        },
        {
            path:'/admin/main-category',
            component:mainCategory,
            name:'adminmaincategory'
        },
    ]
});

export default routes;

