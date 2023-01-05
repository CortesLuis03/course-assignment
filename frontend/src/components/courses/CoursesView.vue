<template>
  <div class="card">
    <div class="card-header">
      <h2>Courses List</h2>
      <router-link class="btn btn-primary btn-sm" to="/course/create">New Course</router-link>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Nro.</th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Credits</th>
              <th scope="col">Area</th>
              <th scope="col">Type</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="course in results">
              <td align="center">{{ course.id }}</td>
              <td>{{ course.crs_name }}</td>
              <td>{{ course.crs_description }}</td>
              <td>{{ course.crs_credits }}</td>
              <td>{{ course.crs_area }}</td>
              <td class="first-letter-uppercase">{{ course.crs_type }}</td>
              <td align="center">
                <div class="btn-group btn-group-sm" role="group">
                  <router-link type="button" class="btn btn-warning" :to="{path:`/course/edit/${course.id}`}">Editar</router-link>
                  <router-link type="button" class="btn btn-danger" to="/course/create">Eliminar</router-link>
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
  name: 'CoursesView',
  data() {
    return {
      results: {

      }
    }
  },
  created() {
    this.coursesList();
  },
  methods: {
    coursesList() {
      var url = 'http://localhost:8000/api/course/list';
      axios.get(url).then(
        ({ data }) => {
          console.log(data);
          this.results = data;
        }
      )
    }
  }
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
.first-letter-uppercase::first-letter {
  text-transform: uppercase;
}
</style>
