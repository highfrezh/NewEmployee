<template>
<div>
  <v-card class="m-auto" tile max-width="95%">
   <v-card-title class="py-0 mb-2">
   <h6 class="mr-5"><span><v-icon dense>fas fa-user</v-icon></span> EMPLOYEE TABLE</h6>
         <v-text-field
            label="Search"
            placeholder="text"
            class="ml-5"
          ></v-text-field>
   <v-spacer></v-spacer>
   <v-btn class="bg-success" small><router-link to="/employee_create">Add New <span> <v-icon small dense>fas fa-user-plus</v-icon></span></router-link></v-btn>
   </v-card-title>
 <v-simple-table dark dense>
    <!-- <template v-slot:default> -->
      <thead>
        <tr>
          <th class="text-left">
            S/N
          </th>
          <th class="text-left">
            USERNAME
          </th>
          <th class="text-left">
           FIRST NAME
          </th>
          <th class="text-left">
           LAST NAME
          </th>
          <th class="text-center">
           EMAIL
          </th>
          <th class="text-center" colspan="2">
           MODIFY
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users.data" :key="user.id">
          <td>{{user.id}}</td>
          <td>{{user.username}}</td>
          <td>{{user.first_name}}</td>
          <td>{{user.last_name}}</td>
          <td class="text-center">{{user.email}}</td>
          <td><a href="#" @click="editModal(user)"><v-icon x-small class="ml-4 text-primary">fas fa-pen</v-icon></a></td>
          <td><a href="#" @click="deleteUser(user.id)"><v-icon x-small class="text-danger">fas fa-trash</v-icon></a></td>
        </tr>
       
      </tbody>
    <!-- </template> -->
  </v-simple-table>
  </v-card>
                        <!-- Modal -->
           <div class="modal fade" id="addNew" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
             <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                <!-- <div class="modal-header">
                  <h5 v-show="editMode" class="modal-title" id="addNewModalLabel">Update User's Info</h5>
                  <h5 v-show="!editMode" class="modal-title" id="addNewModalLabel">Add New</h5>
                  <button type="button" class="btn-close red" data-dismiss="modal" aria-label="Close">&times;</button>
                </div> -->
                <form @submit.prevent="editMode ? updateUser() : createUser()">
               <!-- <div class="modal-body">
                 <div class="form-group">
                   <input v-model="form.name" type="text" name="name" placeholder="Name"
                     class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                   <HasError :form="form" field="name" />
                 </div>
                 <div class="form-group">
                   <input v-model="form.email" type="email" name="email" placeholder="Email"
                     class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                   <HasError :form="form" field="email" />
                 </div>
                 <div class="form-group">
                   <textarea v-model="form.bio" id="bio" name="bio" placeholder="Short bio for user (Optional)"
                     class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }">
                   </textarea>
                   <HasError :form="form" field="bio" />
                 </div>
                 <div class="form-group">
                   <select name="type" v-model="form.type" id="type" 
                     class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                     <option disabled value="">Select User Role</option>
                     <option value="admin">Admin</option>
                     <option value="user">Standard User</option>
                     <option value="author">Author</option>
                   </select >
                     <HasError :form="form" field="type" />
                 </div>
                 <div class="form-group" v-show="!editMode">
                   <input v-model="form.password" type="password" name="password" placeholder="Password"
                     class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                   <HasError :form="form" field="password" />
                 </div>
                 
                </div>
              <div class="modal-footer">
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                 <button v-show="editMode" type="submit" class="btn btn-success">Update</button>
                 <button v-show="!editMode" type="submit" class="btn btn-primary">Create</button>
              </div> -->
              <v-card>
               <v-card-title>
                  <h5 v-show="editMode" class="modal-title" id="addNewModalLabel">Update User's Info</h5>
                  <h5 v-show="!editMode" class="modal-title" id="addNewModalLabel">Add New</h5>
                  <v-spacer></v-spacer>
                  <button type="button" class="btn-close red" data-dismiss="modal" aria-label="Close">&times;</button>
               </v-card-title>
               <v-card-text>
                <v-container>
                   <v-row>
                 <v-col
                  cols="12"
                  sm="6"
                   md="4"
                 >
                <v-text-field
                  label="username"
                  required
                   hint="your username require"
                  v-model="form.username"
                  :class="{ 'is-invalid': form.errors.has('username')}"
                > </v-text-field>
                  <HasError :form="form" field="username" />
                
              </v-col>
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                  label="first name"
                  hint="your surname require"
                   required
                   v-model="form.first_name"
                  :class="{ 'is-invalid': form.errors.has('first_name')}"
                ></v-text-field>
                  <HasError :form="form" field="first_name" />
              </v-col>
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                  label="last name"
                  hint="Or your middle name"
                  persistent-hint
                  required
                  v-model="form.last_name"
                  :class="{ 'is-invalid': form.errors.has('last_name')}"
                ></v-text-field>
                  <HasError :form="form" field="last_name" />
              </v-col>
              <v-col cols="12">
                <v-text-field
                  label="Email"
                  required
                   hint="your email require"
                  v-model="form.email"
                  type="email"
                  :class="{ 'is-invalid': form.errors.has('email')}"
                ></v-text-field>
                  <HasError :form="form" field="email" />
              </v-col>
              <v-col cols="12">
                <v-text-field
                  label="Password"
                  type="password"
                  persistent-hint
                   hint="password minimum is 6 character"
                  v-model="form.password"
                  v-show="!editMode"
                  :class="{ 'is-invalid': form.errors.has('password')}"
                ></v-text-field>
                  <HasError :form="form" field="password" />
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
      users : {},
      form: new Form({
            id:       '',
            username: '',
            first_name: '',
            last_name: '',
            email:    '',
            password: ''
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

      this.form.post('/api/user')
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
            title: 'User created successfully'
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
              this.form.delete('api/users/'+id).then(() => {
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
        axios.get("/api/user").then(({ data }) => (this.users = data)) 
      // }
    },
     //Showing Editing User Modal Method
    editModal(user){
      this.editMode = true;
      this.form.reset();
      $('#addNew').modal('show') // Showing Modal
      this.form.fill(user); //filling the user to the Modal
    },
      // Method for Updating user to database after Edited from Edit Model
    updateUser(){
      this.$Progress.start()
      this.form.put('api/user/'+this.form.id)
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