<template>
<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Create Products</h4>

                <div class="page-title-right">
                    <router-link :to="{name:'adminproducts'}">
                        <button class="btn btn-success btn-sm">Go Back</button>
                    </router-link>
                </div>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" @submit.prevent="createProduct" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" name="product_name" v-model="form.product_name" :class="{ 'is-invalid': form.errors.has('product_name') }">
                                    <div style="color: red" v-if="form.errors.has('product_name')" v-html="form.errors.get('product_name')" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Product Old Price</label>
                                    <input type="text" class="form-control" name="old_price" v-model="form.old_price" :class="{ 'is-invalid': form.errors.has('old_price') }">
                                    <div style="color: red" v-if="form.errors.has('old_price')" v-html="form.errors.get('old_price')" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Product New Price</label>
                                    <input type="text" class="form-control" name="new_price" v-model="form.new_price" :class="{ 'is-invalid': form.errors.has('new_price') }">
                                    <div style="color: red" v-if="form.errors.has('new_price')" v-html="form.errors.get('new_price')" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Product Main Category</label>
                                    <select class="form-control" name="main_cat_id" v-model="form.main_cat_id " :class="{ 'is-invalid': form.errors.has('main_cat_id') }">
                                        <option value="" selected >select any</option>
                                        <option :value="mcat.id" v-for="mcat in productCats" :key="mcat.id">{{mcat.category_name}}</option>
                                    </select>
                                    <div style="color: red" v-if="form.errors.has('main_cat_id')" v-html="form.errors.get('main_cat_id')" />

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Product Sub-Category</label>
                                    <select class="form-control" name="sub_cat_id" v-model="form.sub_cat_id " :class="{ 'is-invalid': form.errors.has('sub_cat_id') }">
                                        <option value="" selected >select any</option>
                                        <option :value="scat.id" v-for="scat in productsSubCats" :key="scat.id">{{scat.category_name}}</option>
                                    </select>
                                    <div style="color: red" v-if="form.errors.has('sub_cat_id')" v-html="form.errors.get('sub_cat_id')" />

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Product Main Image</label>
                                    <input type="file" class="form-control" name="main_image" @change="mainImage">
                                    <div style="color: red" v-if="form.errors.has('main_image')" v-html="form.errors.get('main_image')" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Product Image(Optional)</label>
                                    <input type="file" class="form-control" name="image_one" @change="imageOne">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Product Image(Optional)</label>
                                    <input type="file" class="form-control" name="image_two" @change="imageTwo">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Product Sort Description</label>
                                    <textarea type="text" class="form-control" name="sort_description" v-model="form.sort_description" :class="{ 'is-invalid': form.errors.has('sort_description') }"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Product Long Description</label>
                                    <textarea type="text" class="form-control" name="long_description" v-model="form.long_description" :class="{ 'is-invalid': form.errors.has('long_description') }"></textarea>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->

    </div>



</div>
</template>

<script>
import { Form } from 'vform'
export default {
    name: "productCreate",
    data(){
        return{
            form: new Form({
                product_name: '',
                old_price: '',
                new_price: '',
                main_cat_id: '',
                sub_cat_id: '',
                main_image: '',
                image_one: '',
                image_two: '',
                sort_description: '',
                long_description: '',
            }),
            productCats:[],
            productsSubCats:[],
        }
    },
    methods:{
       createProduct(){
            this.form.post('/admin/save/product').then(()=>{

            });
        },

        mainImage(e){
           let file = e.target.files[0];
           let reader = new FileReader();
           reader.onloadend = (file) => {
               this.form.main_image = reader.result;
           };
           reader.readAsDataURL(file)

        },

        imageOne(e){
            let file = e.target.files[0];
            let reader = new FileReader();
            reader.onloadend = (file) => {
                this.form.image_one = reader.result;
                console.log(this.form.image_one)
            };
            reader.readAsDataURL(file)
        },
        imageTwo(e){
            let file = e.target.files[0];
            let reader = new FileReader();
            reader.onloadend = (file) => {
                this.form.image_two = reader.result;
            };
            reader.readAsDataURL(file)
        },


        async getAllCats(){
            const res = await this.callApi('get','/admin/product/all/category')
            if (res.status == 200){
                this.productCats = res.data;
            }else {
                this.e()
            }
        },

        async getAllSubCats(){
            const res = await this.callApi('get','/admin/product/all/subcategory')
            if (res.status == 200){
                this.productsSubCats = res.data;
            }else {
                this.e()
            }
        }




    },

    created() {
        this.getAllCats();
        this.getAllSubCats();

    }

}
</script>

<style scoped>

</style>
