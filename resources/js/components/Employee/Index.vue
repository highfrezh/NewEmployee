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
           FIRST NAME
          </th>
          <th class="text-left">
           LAST NAME
          </th>
          <th class="">
           ADDRESS
          </th>
          <th class="text-left">
            DEPARTMENT
          </th>
          <th class="text-center" colspan="2">
           MODIFY
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="employee in employees.data" :key="employee.id">
          <td>{{employee.id}}</td>
          <td>{{employee.first_name}}</td>
          <td>{{employee.last_name}}</td>
          <td>{{employee.address}}</td>
          <td class="">{{employee.department.name}}</td>
          <td><router-link 
          :to="{
            name: 'EmployeesEdit',
            params: {id: employee.id}
            }"
            >
            <v-icon x-small class="ml-4 text-primary">fas fa-pen</v-icon>
            </router-link></td>
          <td><a href="#" @click="deleteEmployee(employee.id)"><v-icon x-small class="text-danger">fas fa-trash</v-icon></a></td>
        </tr>
       
      </tbody>
    <!-- </template> -->
  </v-simple-table>
  </v-card>
</div>
</template>

<script>
// import Form from 'vform'
import {  HasError, AlertError } from 'vform/src/components/tailwind'
// import EmployeesEdit from '../Employee/Edit'
export default {
 data: () => ({
      editMode: false,
      employees : {},
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
    // EmployeesEdit,
  },
    methods: {

      getEmployees(){
        axios.get('/api/employee')
        .then(({ data }) => (this.employees = data)) 
        .catch(error => {

          console.log(error);
        })
      },
      
    deleteEmployee(id){
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
              axios.delete('api/employee/'+id).then(() => {
                  swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )
                    this.getEmployees();
                  }).catch(() => {
                    swal.fire("Failed", "There is something went wrong!.", "warning");
              });

            }

          })
    }

    },

   created(){
     
     this.getEmployees();
   }
}
</script>

<style>
</style>