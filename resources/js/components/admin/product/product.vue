<template>
<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">All Products</h4>

                <div class="page-title-right">
                    <router-link :to="{name:'adminproductcreate'}">
                        <button class="btn btn-success btn-sm">Create New Product</button>
                    </router-link>
                </div>

            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product List</h4>

                    <div class="table-responsive">
                        <table class="table mb-0">

                            <thead>
                            <tr>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="pro in allProducts.data" :key="pro.id">
                                <th scope="row">
                                    <img :src="pro.main_image" style="height: 100px;width: 100px;">
                                </th>
                                <td>{{ pro.product_name }}</td>
                                <td>{{pro.new_price}}</td>
                                <td>{{pro.created_at}}</td>
                                <td>
                                    <router-link :to="{name : 'adminproductupdate', params:{id : pro.id}}">
                                        <button class="btn btn-success btn-sm"><i class="fas fa-edit"></i> </button>
                                    </router-link>
                                    <button @click="productDeleteModal(pro.id)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <pagination :limit=5 :data="allProducts" @pagination-change-page="getResults"></pagination>
        </div>

    </div>


    <div class="modal fade" id="deleteProductMd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletecats">Delete Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form @submit.prevent="deleteProduct">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>are you sure to delete this product?</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
</template>

<script>
export default {
    name: "product",
    data(){
        return{
            allProducts:{},
            deleteproid:''
        }
    },

    methods:{

        async getResults(page = 1) {
            await axios.get('/admin/get/all/products?page=' + page)
                .then(response => {
                    this.allProducts = response.data;
                });
        },


       async getAllProdicts(){
            const res = await this.callApi('get','/admin/get/all/products')
            if (res.status == 200){
                this.allProducts = res.data;
            }else {
                this.e()
            }
        },


        productDeleteModal(id){
            this.deleteproid = null;
            this.deleteproid = id;
            $('#deleteProductMd').modal('show');
        },


        async deleteProduct(){
            let delId = this.deleteproid;
            await axios.get(`/admin/product/delete/${delId}`).then(()=>{
                this.getAllProdicts();
                $('#deleteProductMd').modal('hide');
            })
        }


    },
    created(){
        this.getAllProdicts();
    }


}
</script>

<style scoped>

</style>
