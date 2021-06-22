<template>
<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Update Products</h4>

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
                    <form class="needs-validation" @submit.prevent="updateProduct" enctype="multipart/form-data">
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
                                    <br>
                                    <img :src="this.form.main_image" style="height: 100px;width: 100px;">
                                    <input type="file" class="form-control" name="main_image" @change="mainImage">
                                    <div style="color: red" v-if="form.errors.has('main_image')" v-html="form.errors.get('main_image')" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Product Image(Optional)</label>
                                    <br>
                                    <img :src="this.form.image_one" style="height: 100px;width: 100px;">
                                    <input type="file" class="form-control" name="image_one" @change="imageOne">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Product Image(Optional)</label>
                                    <br>
                                    <img v-if="this.form.image_two" :src="this.form.image_two" style="height: 100px;width: 100px;">
                                    <img v-else="!this.form.image_two" src="https://www.leonardusa.com/assets/corals/images/default_product_image.png" style="height: 100px;width: 100px;">
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
    name: "productEdit",
    data(){
        return{
            form: new Form({
                'id':'',
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



        updateProduct(){
            let proId = this.form.id;
            this.form.post(`/admin/update/product/${proId}`).then(res =>{
                this.getProductDetails();
                console.log('paisi')
            })
        },


        async getProductDetails(){
          let productid = this.$route.params.id;

          await axios.get(`/admin/product/details/${productid}`).then(res =>{
              this.form.id = res.data.id;
              this.form.product_name = res.data.product_name;
              this.form.old_price = res.data.old_price;
              this.form.new_price = res.data.new_price;
              this.form.main_cat_id = res.data.main_cat_id;
              this.form.sub_cat_id = res.data.sub_cat_id;
              this.form.main_image = res.data.main_image;
              this.form.image_one = res.data.image_one;
              this.form.image_two = res.data.image_two;
              this.form.sort_description = res.data.sort_description;
              this.form.long_description = res.data.long_description;
          })

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
        this.getProductDetails();

    }
}
</script>

<style scoped>

</style>
