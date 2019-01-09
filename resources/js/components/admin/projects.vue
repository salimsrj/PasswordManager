<template>
    <section class="">        
        <table class="table table-striped" style="max-width: 700px;">
        <thead style="background-color: #999999; color: #ffffff;">
            <tr><th>ID</th>
                <th>Professor Name</th>
                <th>University ID</th>
                <th style="width: 120px;"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(professor, index) in professors.data" :key="professor.id">
                <td>{{ professor.id }}</td>
                <td>{{ professor.first_name }} {{ professor.last_name }}</td>
                <td>{{ professor.name }} </td>
                <td>
                <div class="edbtn_group">
                <button class="edit_btn" @click="editProfessor(professor.id, index)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>&nbsp;
                <button class="delete_btn btn-primary" @click="deleteProfessor(professor.id, index)"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </div>
                </td>                            
            </tr>                    
            </tbody>
        </table>
        <pagination :data="professors" @pagination-change-page="getResults"></pagination> 

        <div v-if="editModal">
                        <transition name="modal">
                        <div class="modal-mask">
                            <div class="modal-wrapper">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Professor</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  @click="editModal=false">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>                                
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="university_name">Profile Pic:</label>
                                                <br>
                                                <div style="width:fit-content; height:150px; border:1px solid #e7e7e7; padding: 5px; overflow:hidden;">
                                                <img width="150" :src="'images/profile/' +editProfessor_data.image"> 
                                                </div><br>
                                                <a href="#" style="width:210px;" class="btn btn-secondary" @click="uploadModal=true">Change Profile Picture</a>

                                            </div>
                                            <div class="form-group">
                                                <label for="university_name">First Name</label>
                                                <input name="university_name" id="university_name" type="text" class="form-control" v-model="editProfessor_data.first_name">
                                            </div>
                                            <div class="form-group">
                                                <label for="university_name">FLast name</label>
                                                <input name="university_name" id="university_name" type="text" class="form-control" v-model="editProfessor_data.last_name">
                                            </div>
                                            <div class="form-group">
                                                <label for="location">Univeristy Name</label>
                                                 <input name="location" id="location" type="text" class="form-control"  v-model="editProfessor_data.university_id">
                                            </div>                                            
                                            <button type="submit" class="btn btn-primary" @click.prevent="updateProfessor(editProfessor_data.id, editProfessor_data.first_name, editProfessor_data.last_name, editProfessor_data.university_id, editProfessor_data.image)">Update</button>
                                            </form>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </transition>
                    </div>
                    <div v-if="loding">
                    <loding></loding>
                    </div>



            <div v-if="uploadModal">
                <transition name="modal">
                <div class="modal-mask">
                    <div class="modal-wrapper">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Change Profile Picture</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"  @click="uploadModal=false">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>                                
                            <div class="modal-body">
                                <profile-pic-change></profile-pic-change>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                </transition>
            </div>


    </section>

</template>
<script>

  export default {

    data(){
        return{
        professors : {},
        del_id : '',
        porfessor_id : '',
        editModal: false,
        loding: false,
        edit_index: '',
        editProfessor_data: {},
        post_status: false,
        uploadModal: false,
        
        }
    },
    mounted(){     
      axios.get('/projects').then( response => this.projects = response.data);
    },
 methods: {
        deleteProfessor(id, index) {
                //alert(id);
                this.porfessor_id = id;
                this.$dialog.confirm("Do you want to delete this professor.", {
                loader: true
            })
                .then((dialog) => {                  
                    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    axios.post('/delete-professor', { id: id} ).then( response => this.del_id = response.data);
                    this.professors.data.splice(index,1);
                    dialog.close();                   
                    setTimeout(() => {
                        console.log('Delete action completed ');
                        dialog.close();
                    }, 2500);

                })
                .catch(() => {
                    // Triggered when cancel button is clicked
                    console.log('Delete aborted');
                });
        },

        editProfessor(euid, index){
            this.editModal = true;            
            axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            axios.post('/edit-professor', { id: euid} ).then( response => this.editProfessor_data = response.data[0]);
            this.edit_index = index;
        },

        updateProfessor(id, firstName, lastName, universityID, image){           
             this.editModal= false;
            // this.loding= true;
             axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
             axios.post('/update-professor', { id: id, first_name: firstName, last_name: lastName, university_id: universityID, image: image})
             .then( response => {
                 this.professors.data[this.edit_index].first_name = firstName;
                 this.professors.data[this.edit_index].last_name = lastName;
                 //this.loding = false;
                Vue.prototype.$toast.success({
                title:'Success',
                message:'University information updated',                
                });
             });
             
            
            

        },

        getResults(page = 1) {            
			axios.get('/professor-all?page=' + page)
				.then(response => {
					this.professors = response.data;
				});
		}
    }
    
  }
</script>
