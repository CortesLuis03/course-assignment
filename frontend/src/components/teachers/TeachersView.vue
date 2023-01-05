<template>
  <div class="card">
    <div class="card-header">
      <h2>Teachers List</h2>
      <router-link class="btn btn-primary btn-sm" to="/teacher/create">New Teacher</router-link>
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
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="teacher in results">
              <td align="center">{{ teacher.id }}</td>
              <td align="center">{{ teacher.tch_dni }}</td>
              <td>{{ teacher.tch_name }}</td>
              <td>{{ teacher.tch_lastname }}</td>
              <td align="center">{{ teacher.tch_phone }}</td>
              <td>{{ teacher.tch_email }}</td>
              <td>{{ teacher.tch_address }}</td>
              <td align="center">{{ teacher.tch_city }}</td>
              <td align="center">
                <div class="btn-group btn-group-sm" role="group">
                  <router-link type="button" class="btn btn-warning" :to="{path:`/teacher/edit/${teacher.id}`}">Editar</router-link>
                  <button type="button" class="btn btn-danger" @click="remove(teacher.id)">Eliminar</button>
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
  name: 'TeachersView',
  data() {
    return {
      results: {

      }
    }
  },
  created() {
    this.teachersList();
  },
  methods: {
    teachersList() {
      var url = 'http://localhost:8000/api/teacher/list';
      axios.get(url).then(
        ({ data }) => {
          console.log(data);
          this.results = data;
        }
      )
    },
    remove(id) {
      const url = `http://localhost:8000/api/teacher/delete/${id}`;
      axios.delete(url).then(() => {
        this.teachersList();
      });
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
