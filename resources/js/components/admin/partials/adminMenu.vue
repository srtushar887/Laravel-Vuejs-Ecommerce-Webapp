<template>
<div>
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" key="t-menu">Menu</li>
        <li>
            <router-link :to="{name:'admindashboard'}" class="waves-effect">
                <i class="bx bx-calendar"></i>
                <span key="t-calendar">Dashboard</span>
            </router-link>
        </li>


        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-store"></i>
                <span key="t-ecommerce">Category Management</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><router-link :to="{name : 'adminmaincategory'}" key="t-products">Main category</router-link></li>
                <li><router-link :to="{name : 'adminsubcategory'}" key="t-products">Sub category</router-link></li>
            </ul>
        </li>


        <li>
            <router-link :to="{name:'adminproducts'}" class="waves-effect">
                <i class="bx bx-chat"></i>
                <span key="t-chat">Products</span>
            </router-link>
        </li>





    </ul>
</div>
</template>

<script>
export default {
    name: "adminMenu"
}
</script>

<style scoped>

</style>
