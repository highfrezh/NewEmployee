<template>
<div>
  <v-card class="m-auto" tile max-width="95%">
   <v-card-title class="py-2 bg-dark">
   <h6 class="mr-5"><span><v-icon dense left class="text-white">fas fa-user</v-icon></span>CREATE EMPLOYEE</h6>
   <v-spacer></v-spacer>
   <v-btn class="bg-success" small><router-link to="/home">BACK  <span><v-icon small dense right> fas fa-angle-left</v-icon><v-icon small dense>fas fa-angle-left</v-icon></span></router-link></v-btn>
   </v-card-title>
   <hr>
  <form @submit.prevent="storeEmployee">
   <v-card-text>
       <v-container>
         <v-row>
           <v-col cols="12" sm="6" md="4">
             <v-text-field
                  label="Last Name"
                  required
                   hint="your last name require"
                  v-model="form.last_name"
                  :class="{ 'is-invalid': form.errors.has('last_name')}"
                >
             </v-text-field>
             <HasError :form="form" field="last_name" />
           </v-col>
           <v-col cols="12" sm="6" md="4">
             <v-text-field
                  label="First Name"
                  required
                   hint="your first name require"
                  v-model="form.first_name"
                  :class="{ 'is-invalid': form.errors.has('first_name')}"
                >
             </v-text-field>
             <HasError :form="form" field="first_name" />
           </v-col>
           <v-col cols="12" sm="6" md="4">
             <v-text-field
                  label="Middle Name"
                  required
                   hint="your middle name is optional"
                  v-model="form.middle_name"
                  :class="{ 'is-invalid': form.errors.has('middle_name')}"
                >
             </v-text-field>
             <HasError :form="form" field="middle_name" />
           </v-col>
           <v-col cols="12" sm="12" md="12">
             <v-text-field
                  label="Address"
                  required
                   hint="address is required"
                  v-model="form.address"
                  :class="{ 'is-invalid': form.errors.has('address')}"
                >
             </v-text-field>
             <HasError :form="form" field="address" />
           </v-col>
           <v-col cols="12" sm="6" md="4">
             <label for="department">Department</label>
                 <select class="custom-select custom-select-sm"
                 v-model="form.department_id"
                 :class="{ 'is-invalid': form.errors.has('department_id')}"
                 >
                   <option selected 
                   v-for="department in departments" :key="department.id" 
                   :value="department.id" 
                   >{{department.name}}</option>
                 </select>
                  <HasError :form="form" field="department_id" />
           </v-col>
           <v-col cols="12" sm="6" md="4">
             <label for="country">Country</label>
                 <select class="custom-select custom-select-sm"
                 v-model="form.country_id"
                 @change="getStates()"
                 :class="{ 'is-invalid': form.errors.has('country_id')}"
                 >
                   <option selected 
                   v-for="country in countries" :key="country.id" 
                   :value="country.id" 
                   >{{country.name}}</option>
                 </select>
                  <HasError :form="form" field="country_id" />
           </v-col>
           <v-col cols="12" sm="6" md="4">
             <label for="state">State</label>
                 <select class="custom-select custom-select-sm"
                 v-model="form.state_id"
                 @change="getCities()"
                 :class="{ 'is-invalid': form.errors.has('state_id')}"
                 >
                   <option selected 
                   v-for="state in states" :key="state.id" 
                   :value="state.id" 
                   >{{state.name}}</option>
                 </select>
                  <HasError :form="form" field="state_id" />
           </v-col>
           <v-col cols="12" sm="6" md="3">
             <label for="city">City</label>
                 <select class="custom-select custom-select-sm"
                 v-model="form.city_id"
                 :class="{ 'is-invalid': form.errors.has('city_id')}"
                 >
                   <option selected 
                   v-for="city in cities" :key="city.id" 
                   :value="city.id" 
                   >{{city.name}}</option>
                 </select>
                  <HasError :form="form" field="city_id" />
           </v-col>
           <v-col cols="12" sm="6" md="3">
             <label for="zip code">Zip Code</label>
                   <input 
                   type="number"
                   class="form-control custom-select-sm" 
                   :class="{ 'is-invalid': form.errors.has('zip_code')}" 
                   placeholder="zip code"
                   v-model="form.zip_code"
                   >
                    <HasError :form="form" field="zip_code" />
           </v-col>
           <v-col cols="12" sm="6" md="3">
             <label for="birthday">Birthday</label>
             <!-- <vuejs-datepicker :value="myDate" placeholder="None" format="yyyy-MM-dd" @input="myDate = fixDate($event)"></vuejs-datepicker> -->
                   <datepicker input-class="form-control custom-select-sm"
                  type="text"
                   :class="{ 'is-invalid': form.errors.has('birthday')}" 
                   placeholder="birthday"
                   :value="form.birthday"
                   @input="form.birthday = fixDate($event)"
                  ></datepicker>
                    <HasError :form="form" field="birthday" />
           </v-col>
           <v-col cols="12" sm="6" md="3">
             <label for="date hired">Date hired</label>
                  <datepicker input-class="form-control custom-select-sm"
                  type="text"
                   :class="{ 'is-invalid': form.errors.has('date_hired')}" 
                   placeholder="date hired"
                   :value="form.date_hired"
                   @input="form.date_hired = fixDate($event)"
                  ></datepicker>
                    <HasError :form="form" field="date_hired" />
           </v-col>
         </v-row>
       </v-container>
   </v-card-text>
   <v-card-actions>
       <v-spacer></v-spacer>
       <v-btn type="submit" class="btn bg-primary">Create</v-btn>
   </v-card-actions>
   </form>
  </v-card>
</div>
</template>

<script>
// import Form from 'vform'
import {  HasError, AlertError } from 'vform/src/components/tailwind';
import Datepicker from 'vuejs-datepicker';
import moment from 'moment';
export default {
 data: () => ({
      departments : {},
      countries : {},
      states : {},
      cities : {},
      form: new Form({
            id:       '',
            last_name: '',
            first_name: '',
            middle_name: '',
            address:    '',
            department_id: '',
            country_id: '',
            state_id: '',
            city_id: '',
            zip_code: '',
            birthday: null,
            date_hired: null
    })
    }),
 
    //vform component error message here and component registration
  components: {
    HasError,
    AlertError,
    Datepicker

  },
    methods: {

    getCountries(){
      // axios.get("/api/user").then(({ data }) => (this.users = data))
      axios.get('/api/employees/countries')
      .then(({data}) => {this.countries = data})
      .catch(error => {console.log(console.error)
      })
    },
    getDepartments(){
      axios.get('/api/employees/departments')
      .then(({data}) => {this.departments = data})
      .catch(error => {console.log(console.error)
      })
    },
    getStates(){
      axios.get('/api/employees/'+ this.form.country_id+'/states')
      .then(({data}) => {this.states = data})
      .catch(error => {console.log(console.error)
      })
    },
    getCities(){
      axios.get('/api/employees/'+ this.form.state_id + '/cities')
      .then(({data}) => {this.cities = data})
      .catch(error => {console.log(console.error)
      })
    },
    storeEmployee(){
        this.$Progress.start() //progress bar start here

      this.form.post('api/employee')
      /*
        .THEN()
        .CATCH() 
        Are ES6 promise that IF the condition is true the statement from the .THEN() with call back function will executed
        ELSE .CATCH() with call back function will executed.
      */
      .then(()=>{
        
        Fire.$emit('ReloadUserData'); // Event listener for  sending HTTP Request to the serve
        this.form.reset();
        toast.fire({
          icon: 'success',
            title: 'User created successfully'
          })

          window.location.href = '/home';
          // taost sweetalert2 finish here
        this.$Progress.finish();  //progress bar finish here

      })
      
      .catch(()=>{

      })
    },
    
    //Date format @input
    fixDate(event){
      return moment(event).format('YYYY-MM-DD');
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
    
    
    },
   created(){
     this.loadUsers();
     this.getCountries();
     this.getDepartments()
     // Fire.$on send another Http request to reload the user if another user is created
        Fire.$on('ReloadUserData',() => {
          this.loadUsers();
        })
   }
}
</script>

<style>
</style>