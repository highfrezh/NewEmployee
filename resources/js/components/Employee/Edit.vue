<template>
<div>
  <v-card class="m-auto" tile max-width="95%">
   <v-card-title class="py-2 bg-dark">
   <h6 class="mr-5"><span><v-icon dense left class="text-white">fas fa-user</v-icon></span>MODIFY EMPLOYEE</h6>
   <v-spacer></v-spacer>
   <v-btn class="bg-success" small><router-link to="/home">BACK  <span><v-icon small dense right> fas fa-angle-left</v-icon>
   <v-icon small dense>fas fa-angle-left</v-icon></span></router-link></v-btn>
   </v-card-title>
   <hr>
  <form @submit.prevent="updateEmployee">
   <v-card-text>
       <v-container>
         <v-row>
           <v-col cols="12" sm="6" md="4">
             <v-text-field
                  label="Last Name"
                  required
                   hint="your last name require"
                  v-model="form.last_name"
                >
             </v-text-field>
           </v-col>
           <v-col cols="12" sm="6" md="4">
             <v-text-field
                  label="First Name"
                  required
                   hint="your first name require"
                  v-model="form.first_name"
                >
             </v-text-field>
           </v-col>
           <v-col cols="12" sm="6" md="4">
             <v-text-field
                  label="Middle Name"
                  required
                   hint="your middle name is optional"
                  v-model="form.middle_name"
                >
             </v-text-field>
           </v-col>
           <v-col cols="12" sm="12" md="12">
             <v-text-field
                  label="Address"
                  required
                   hint="address is required"
                  v-model="form.address"
                >
             </v-text-field>
           </v-col>
           <v-col cols="12" sm="6" md="4">
             <label for="department">Department</label>
                 <select class="custom-select custom-select-sm"
                 v-model="form.department_id"
                 required
                 >
                   <option selected 
                   v-for="department in departments" :key="department.id" 
                   :value="department.id" 
                   >{{department.name}}</option>
                 </select>
           </v-col>
           <v-col cols="12" sm="6" md="4">
             <label for="country">Country</label>
                 <select class="custom-select custom-select-sm"
                 v-model="form.country_id"
                 required
                 @change="getStates()"
                 >
                   <option selected 
                   v-for="country in countries" :key="country.id" 
                   :value="country.id" 
                   >{{country.name}}</option>
                 </select>
           </v-col>
           <v-col cols="12" sm="6" md="4">
             <label for="state">State</label>
                 <select class="custom-select custom-select-sm"
                 v-model="form.state_id"
                 required
                 @change="getCities()"
                 >
                   <option selected 
                   v-for="state in states" :key="state.id" 
                   :value="state.id" 
                   >{{state.name}}</option>
                 </select>
           </v-col>
           <v-col cols="12" sm="6" md="3">
             <label for="city">City</label>
                 <select class="custom-select custom-select-sm"
                 v-model="form.city_id"
                 required
                 >
                   <option selected 
                   v-for="city in cities" :key="city.id" 
                   :value="city.id" 
                   >{{city.name}}</option>
                 </select>
           </v-col>
           <v-col cols="12" sm="6" md="3">
             <label for="zip code">Zip Code</label>
                   <input 
                   type="number"
                   required
                   class="form-control custom-select-sm" 
                   placeholder="zip code"
                   v-model="form.zip_code"
                   >
           </v-col>
           <v-col cols="12" sm="6" md="3">
             <label for="birthday">Birthday</label>
             <!-- <vuejs-datepicker :value="myDate" placeholder="None" format="yyyy-MM-dd" @input="myDate = fixDate($event)"></vuejs-datepicker> -->
                   <datepicker input-class="form-control custom-select-sm"
                  type="text" 
                   required
                   placeholder="birthday"
                   :value="form.birthday"
                   @input="form.birthday = fixDate($event)"
                  ></datepicker>
           </v-col>
           <v-col cols="12" sm="6" md="3">
             <label for="date hired">Date hired</label>
                  <datepicker input-class="form-control custom-select-sm"
                  type="text" 
                  required
                   placeholder="date hired"
                   :value="this.form.date_hired"
                   @input="form.date_hired = fixDate($event)"
                  ></datepicker>
           </v-col>
         </v-row>
       </v-container>
   </v-card-text>
   <v-card-actions>
       <v-spacer></v-spacer>
       <v-btn type="submit" class="btn bg-primary">Update</v-btn>
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
    
    getEmployees(){
      axios.get('/api/employee/'+ this.$route.params.id)
      .then(({data}) => {
        this.form = data.data;
        this.getStates();
        this.getCities();
        })
      .catch(error => {console.log(error)
      })
    },

    getCountries(){
      // axios.get("/api/user").then(({ data }) => (this.users = data))
      axios.get('/api/employees/countries')
      .then(({data}) => {this.countries = data})
      .catch(error => {console.log(error)
      })
    },

    getDepartments(){
      axios.get('/api/employees/departments')
      .then(({data}) => {this.departments = data})
      .catch(error => {console.log(error)
      })
    },

    getStates(){
      axios.get('/api/employees/'+ this.form.country_id+'/states')
      .then(({data}) => {this.states = data})
      .catch(error => {console.log(error)
      })
    },

    getCities(){
      axios.get('/api/employees/'+ this.form.state_id + '/cities')
      .then(({data}) => {this.cities = data})
      .catch(error => {console.log(error)
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

          // Method for Updating Employee to database after Edited from Edit Model
    updateEmployee(){
      this.$Progress.start()
      axios.put('/api/employee/'+this.$route.params.id,
       {
            last_name:  this.form.last_name,
            first_name: this.form.first_name,
            middle_name: this.form.middle_name,
            address:    this.form.address,
            department_id: this.form.department_id,
            country_id: this.form.country_id,
            state_id: this.form.state_id,
            city_id: this.form.city_id,
            zip_code: this.form.zip_code,
            birthday:  this.fixDate(this.form.birthday),
            date_hired: this.fixDate(this.form. date_hired)
      })
      
      .then(() => {
        swal.fire(
                    'Updated!',
                    'Your file has been updated.',
                    'success'
                  )
                  this.$router.push({name: 'EmployeesIndex'});
                  
                  this.$Progress.finish();
      })
      .catch(() => {
        this.$Progress.fail()
      });
    },

    format_date(value){
      if (value) {
        return moment(String(value)).format(YYYY-MM-DD)
      }
    }
    
    
    },
   created(){
     this.getCountries();
     this.getDepartments();
     this.getEmployees();
   }
}
</script>

<style>
</style>