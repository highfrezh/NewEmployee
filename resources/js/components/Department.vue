<template>
<div>
  <v-card class="m-auto" tile max-width="60%">
   <v-card-title class="py-0 mb-2">
   <h6 class="mr-5"><span><v-icon dense>fas fa-directions</v-icon></span> DEPARTMENT TABLE</h6>
         <v-text-field
            label="Search"
            placeholder="text"
            class="ml-5"
          ></v-text-field>
   <v-spacer></v-spacer>
   <v-btn class="bg-success" small  @click="newModal"> Add New <span> <v-icon small dense>fas fa-user-plus</v-icon></span></v-btn>
   </v-card-title>
 <v-simple-table dark dense>
    <!-- <template v-slot:default> -->
      <thead>
        <tr>
          <th class="text-left">
            S/N
          </th>
          <th class="text-left">
           DEPARTMENT NAME
          </th>
          <th class="text-center" colspan="2">
           MODIFY
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="department in departments.data" :key="department.id">
          <td class="text-left" >{{department.id}}</td>
          <td class="text-left" >{{department.name}}</td>
          <td><a href="#" @click="editModal(department)"><v-icon x-small class="ml-4 text-primary">fas fa-pen</v-icon></a></td>
          <td><a href="#" @click="deleteUser(department.id)"><v-icon x-small class="text-danger">fas fa-trash</v-icon></a></td>
        </tr>
       
      </tbody>
    <!-- </template> -->
  </v-simple-table>
  </v-card>
                        <!-- Modal -->
           <div class="modal fade" id="addNew" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
             <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                <form @submit.prevent="editMode ? updateUser() : createUser()">
              <v-card>
               <v-card-title>
                  <h5 v-show="editMode" class="modal-title" id="addNewModalLabel">Update Department</h5>
                  <h5 v-show="!editMode" class="modal-title" id="addNewModalLabel">Add New</h5>
                  <v-spacer></v-spacer>
                  <button type="button" class="btn-close red" data-dismiss="modal" aria-label="Close">&times;</button>
               </v-card-title>
               <v-card-text>
                <v-container>
                   <v-row>
                 <v-col
                  cols="12"
                  sm="12"
                   md="14"
                 >
                <v-text-field
                  label="Department name"
                  required
                   hint="field require"
                  v-model="form.name"
                  :class="{ 'is-invalid': form.errors.has('name')}"
                > </v-text-field>
                  <HasError :form="form" field="name" />
              </v-col>
            </v-row>
                </v-container>
               </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn type="button" class="btn bg-danger" data-dismiss="modal">Close</v-btn>
                    <v-btn v-show="editMode" type="submit" class="btn bg-success">Update</v-btn>
                    <v-btn v-show="!editMode" type="submit" class="btn bg-primary">Create</v-btn>
                </v-card-actions>
              </v-card>
              </form>
            </div>
          </div>
        </div>
  
</div>
</template>

<script>
// import Form from 'vform'
import {  HasError, AlertError } from 'vform/src/components/tailwind'
export default {
 data: () => ({
      editMode: false,
      departments : {},
      form: new Form({
            id:       '',
            name: ''
    })
    }),
 
    //vform component error message here and component registration
  components: {
    HasError,
    AlertError,
  },
    methods: {
      
    createUser () {
      this.$Progress.start() //progress bar start here
      this.form.post('/api/department')
      /*
        .THEN()
        .CATCH() 
        Are ES6 promise that IF the condition is true the statement from the .THEN() with call back function will executed
        ELSE .CATCH() with call back function will executed.
      */
      .then(()=>{
        Fire.$emit('ReloadUserData'); // Event listener for  sending HTTP Request to the serve
        $('#addNew').modal('hide') // hiding Modal after User Created
        // taost sweetalert2 begin here
        toast.fire({
          icon: 'success',
            title: 'Country created successfully'
          })
          // taost sweetalert2 finish here
       this.$Progress.finish();  //progress bar finish here
      })
      
      .catch(()=>{
      })
    },
    deleteUser(id){
      swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {

            // sending Request to the server
            if (result.isConfirmed) {
              this.form.delete('api/department/'+id).then(() => {
                  swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )
              Fire.$emit('ReloadUserData');
                  }).catch(() => {
                    swal.fire("Failed", "There is something went wrong!.", "warning");
              });

            }

          })
    },
    loadUsers(){
      // Checking if the User is authorized before sendin HTTP Request
      // if (this.$gate.isAdminOrAuthor()) {
        // getting the data  from the controller using the route name (/api/user) then fetch the data to the user (this.users) object 
        axios.get("/api/department").then(({ data }) => (this.departments = data)) 
      // }
    },
     //Showing Editing User Modal Method
    editModal(country){
      this.editMode = true;
      this.form.reset();
      $('#addNew').modal('show') // Showing Modal
      this.form.fill(country); //filling the user to the Modal
    },
      // Method for Updating user to database after Edited from Edit Model
    updateUser(){
     this.$Progress.start()
      this.form.put('api/department/'+this.form.id)
      .then(() => {
        //success
        $('#addNew').modal('hide');
        swal.fire(
                    'Updated!',
                    'Your file has been updated.',
                    'success'
                  )
                  this.$Progress.finish();
                  Fire.$emit('ReloadUserData');

      })
      .catch(() => {
        this.$Progress.fail()
      });
    },
     // opening Modal for new  user
    newModal(){
      this.editMode = false;
      this.form.reset();
      $('#addNew').modal('show') // Showing Modal
      }
    },
   created(){
     this.loadUsers();
     // Fire.$on send another Http request to reload the user if another user is created
        Fire.$on('ReloadUserData',() => {
          this.loadUsers();
        })
   }
}
</script>

<style>
</style>
© 2021 GitHub, Inc.