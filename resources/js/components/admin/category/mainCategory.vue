<template>
<div>


    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Main category</h4>

                <div class="page-title-right">
                    <button class="btn btn-success btn-sm" @click="createCategoryModal">Create New Category</button>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Category List</h4>

                    <div class="table-responsive">
                        <table class="table mb-0">

                            <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="cats in allCats.data" :key="cats.id">
                                <td>{{ cats.category_name }}</td>
                                <td>{{ cats.created_at }}</td>
                                <td>
                                    <button @click="editCategory(cats)" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button>
                                    <button @click="deleteCategoryModal(cats)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
            <pagination :data="allCats" @pagination-change-page="getResults"></pagination>

        </div>

    </div>




    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-show="!editMode" class="modal-title" id="staticBackdrop">Create Main Category</h5>
                    <h5 v-show="editMode" class="modal-title" id="staticBackdrop">Update Main Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form @submit.prevent="editMode ? updateCategory() : createCategory()">
                <div class="modal-body">
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



    <div class="modal fade" id="deletecats" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
    name: "mainCategory",
    data(){
        return{
            form: new Form({
                id:'',
                category_name: '',
            }),
            allCats:{},
            editMode:false,
            deleteid:""
        }
    },
    methods:{


        async getResults(page = 1) {
           await axios.get('/admin/get/category?page=' + page)
                .then(response => {
                    this.allCats = response.data;
                });
        },

        createCategoryModal(){
            this.editMode = false;
            this.form.reset();
            this.form.errors.clear();
            $('#staticBackdrop').modal('show');
        },

        createCategory(){
            console.log('paisi');
            this.editMode = false;
            this.form.post('/admin/save/category').then(() =>{
                this.getAllCats();
                this.form.category_name = '';
                $('#staticBackdrop').modal('hide');
            });

        },


        editCategory(cats){
            this.editMode = true;
            this.form.reset();
            this.form.errors.clear();
            $('#staticBackdrop').modal('show');
            this.form.fill(cats);

        },


        updateCategory(){
            this.form.post('/admin/update/category/'+this.form.id).then(() =>{
                this.getAllCats();
                this.form.category_name = '';
                $('#staticBackdrop').modal('hide');
            });
        },


        deleteCategoryModal(cats){
            this.deleteid = "";
            this.deleteid = cats.id;
            $('#deletecats').modal('show');
        },

        deleteCategory(){
            axios.get('/admin/delete/category/'+this.deleteid).then(()=>{
                this.getAllCats();
                $('#deletecats').modal('hide');
            });
        },


        async getAllCats(){
            const res = await this.callApi('get','/admin/get/category')
            if (res.status == 200){
                this.allCats = res.data;
            }else {
                this.e()
            }

        }


    },
    async created(){
       this.getAllCats();
    }
}
</script>

<style scoped>

</style>
