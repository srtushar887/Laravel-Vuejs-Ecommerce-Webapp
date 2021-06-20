<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Sub category</h4>

                    <div class="page-title-right">
                        <button class="btn btn-success btn-sm" @click="createSubCategoryModal">Create New Sub-Category</button>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Sub-Category List</h4>

                        <div class="table-responsive">
                            <table class="table mb-0">

                                <thead>
                                <tr>
                                    <th>Main Category Name</th>
                                    <th>Sub-Category Name</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="subcats in allSubCats.data" :key="subcats.id">
                                    <td>{{ subcats.main_cat.category_name }}</td>
                                    <td>{{ subcats.category_name }}</td>
                                    <td>{{ subcats.created_at }}</td>
                                    <td>
                                        <button @click="editSubCategory(subcats)" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button>
                                        <button @click="deleteSubCategoryModal(subcats)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>

                    </div>

                </div>
                <pagination :limit=5 :data="allSubCats" @pagination-change-page="getResults"></pagination>


            </div>

        </div>




        <div class="modal fade" id="createSubCatModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-show="!editMode" class="modal-title" id="staticBackdrop">Create Sub-Category</h5>
                        <h5 v-show="editMode" class="modal-title" id="staticBackdrop">Update Sub-Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent="editMode ? updateSubCategory() : createSubCategory()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Main Category</label>
                                <select class="form-control" name="main_category_id" v-model="form.main_category_id " :class="{ 'is-invalid': form.errors.has('main_category_id') }">
                                    <option value="" selected >select any</option>
                                    <option :value="allcat.id" v-for="allcat in allCats" :key="allcat.id">{{allcat.category_name}}</option>
                                </select>
                                <div style="color: red" v-if="form.errors.has('main_category_id')" v-html="form.errors.get('main_category_id')" />
                            </div>
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" class="form-control" name="category_name" v-model="form.category_name" :class="{ 'is-invalid': form.errors.has('category_name') }">
                                <div style="color: red" v-if="form.errors.has('category_name')" v-html="form.errors.get('category_name')" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="modal fade" id="deletesubcats" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletecats">Delete Main Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent="deleteCategory">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>are you sure to delete this category?</label>
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
import { Form } from 'vform'
export default {
    name: "subCategory",
    data(){
        return{
            form: new Form({
                id:'',
                main_category_id: '',
                category_name: '',
            }),
            allCats:[],
            allSubCats:{},
            editMode:false,
            deleteid:""
        }
    },
    methods:{


        async getResults(page = 1) {
            await axios.get('/admin/get/all/subcategory?page=' + page)
                .then(response => {
                    this.allSubCats = response.data;
                });
        },

        createSubCategoryModal(){
            this.editMode = false;
            this.form.reset();
            this.form.errors.clear();
            $('#createSubCatModal').modal('show');
        },

        createSubCategory(){
            this.editMode = false;
            this.form.post('/admin/save/subcategory').then(() =>{
                this.getAllSubCats();
                this.form.category_name = '';
                this.form.main_category_id = '';
                $('#createSubCatModal').modal('hide');
            });

        },


        editSubCategory(subcats){
            this.editMode = true;
            this.form.reset();
            this.form.errors.clear();
            $('#createSubCatModal').modal('show');
            this.form.fill(subcats);

        },


        updateSubCategory(){
            this.form.post('/admin/update/subcategory/'+this.form.id).then(() =>{
                this.getAllSubCats();
                this.form.main_category_id = '';
                this.form.category_name = '';
                $('#createSubCatModal').modal('hide');
            });
        },


        deleteSubCategoryModal(subcats){
            this.deleteid = "";
            this.deleteid = subcats.id;
            $('#deletesubcats').modal('show');
        },

        deleteCategory(){
            axios.get('/admin/delete/subcategory/'+this.deleteid).then(()=>{
                this.getAllSubCats();
                $('#deletesubcats').modal('hide');
            });
        },


        async getAllCats(){
            const res = await this.callApi('get','/admin/get/all/category')
            if (res.status == 200){
                this.allCats = res.data;
            }else {
                this.e()
            }
        },


        async getAllSubCats(){
            const res = await this.callApi('get','/admin/get/all/subcategory')
            if (res.status == 200){
                this.allSubCats = res.data;
            }else {
                this.e()
            }
        }



    },
    async created(){
        this.getAllCats();
        this.getAllSubCats();
    }
}
</script>

<style scoped>

</style>
