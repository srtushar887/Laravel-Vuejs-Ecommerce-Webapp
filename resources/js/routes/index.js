import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);



import adminHome from "../components/admin/adminHome";
import mainCategory from "../components/admin/category/mainCategory";
import subCategory from "../components/admin/category/subCategory";
import product from "../components/admin/product/product";
import productCreate from "../components/admin/product/productCreate";

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
        {
            path:'/admin/sub-category',
            component:subCategory,
            name:'adminsubcategory'
        },
        {
            path:'/admin/products',
            component:product,
            name:'adminproducts'
        },
        {
            path:'/admin/product-create',
            component:productCreate,
            name:'adminproductcreate'
        },
    ]
});

export default routes;

