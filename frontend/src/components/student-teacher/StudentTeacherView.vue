<template>
  <div class="card">
    <div class="card-header">
      <h2>Student per Teacher List</h2>
      <router-link class="btn btn-primary btn-sm" to="/student-teacher/create">New Registration</router-link>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <td align="center" scope="col"><strong>Student</strong></td>
              <td align="center" scope="col"><strong>Courses Information</strong></td>
              <td align="center" scope="col"><strong>Actions</strong></td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="student, dni in results">
              <td align="center">
                <div class="align-middle">{{ dni }} - {{ student[0]['student'].std_name }} {{
                  student[0]['student'].std_lastname
                }}</div>
              </td>
              <td align="center">
                <div v-for="infoStudent in student">
                  <label>{{ infoStudent['teacher'].tch_name }} {{ infoStudent['teacher'].tch_lastname }} /
                    <strong>{{ infoStudent['course'].crs_name }}</strong></label>
                </div>
              </td>
              <td align="center">
                <div class="btn-group btn-group-sm" role="group">
                  <button type="button" class="btn btn-danger" @click="remove(student[0]['student'].id)">X</button>
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
  name: 'StudentTeacherView',
  data() {
    return {
      results: {

      }
    }
  },
  created() {
    this.studentPerTeacherList();
  },
  methods: {
    studentPerTeacherList() {
      const url = 'http://localhost:8000/api/relationship/list';
      axios.get(url).then(
        ({ data }) => {
          console.log(data);
          this.results = data;
        }
      )
    },
    remove(id) {
      console.log(id)
      const url = `http://localhost:8000/api/relationship/deleteAll/${id}`;
      console.log(url)
      axios.delete(url).then(() => {
        this.studentPerTeacherList();
      });
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

.align-middle {
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
