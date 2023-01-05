<template>
  <div class="card">
    <div class="card-header">
      <h2>Students List</h2>
      <router-link class="btn btn-primary btn-sm" to="/student/create">New Student</router-link>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Nro.</th>
              <th scope="col">Identification Number</th>
              <th scope="col">Name</th>
              <th scope="col">Lastname</th>
              <th scope="col">Phone</th>
              <th scope="col">Email</th>
              <th scope="col">Address</th>
              <th scope="col">City</th>
              <th scope="col">Semester</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="student in results">
              <td align="center">{{ student.id }}</td>
              <td align="center">{{ student.std_dni }}</td>
              <td>{{ student.std_name }}</td>
              <td>{{ student.std_lastname }}</td>
              <td align="center">{{ student.std_phone }}</td>
              <td>{{ student.std_email }}</td>
              <td>{{ student.std_address }}</td>
              <td align="center">{{ student.std_city }}</td>
              <td align="center">{{ student.std_semester }}</td>
              <td align="center">
                <div class="btn-group btn-group-sm" role="group">
                  <router-link type="button" class="btn btn-warning" :to="{path:`/student/edit/${student.id}`, params:{student: student}}">Editar</router-link>
                  <router-link type="button" class="btn btn-danger" to="/student/create">Eliminar</router-link>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  name: 'StudentsView',
  data() {
    return {
      results: {

      }
    }
  },
  created() {
    this.StudentsList();
  },
  methods: {
    StudentsList() {
      var url = 'http://localhost:8000/api/students';
      axios.get(url).then(
        ({ data }) => {
          console.log(data);
          this.results = data;
        }
      )
    }
  }
  // props: {},
}
</script>

<style scoped>
.card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
thead {
  font-size: 10pt;
}
</style>
