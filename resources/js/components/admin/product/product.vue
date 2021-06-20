<template>
<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">All Products</h4>

                <div class="page-title-right">
                    <router-link :to="{name:'adminproductcreate'}">
                        <button class="btn btn-success btn-sm">Create Product</button>
                    </router-link>
                </div>

            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "product"
}
</script>

<style scoped>

</style>
