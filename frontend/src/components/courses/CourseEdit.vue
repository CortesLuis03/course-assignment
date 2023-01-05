<template>
  <div class="p-5">
    <div class="card">
      <div class="card-header">
        <h2>Edit Course</h2>
        <router-link class="btn btn-danger btn-sm" to="/courses">Discard</router-link>
      </div>
      <div class="card-body">
        <div class="container">
          <form @submit.prevent="saveChanges">
            <div class="form-group row mb-3 g-2">
              <div class="col-6">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" placeholder="Name" id="name" v-model="course.crs_name">
              </div>
            </div>
            <div class="form-group row mb-3 g-2">
              <div class="col">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" placeholder="Description" id="description" rows="6"
                  v-model="course.crs_description" style="resize: none;"/>
              </div>
            </div>
            <div class="form-group row mb-3 g-2">
              <div class="col-4">
                <label for="credits" class="form-label">Credits:</label>
                <input type="number" class="form-control" placeholder="Credits" id="credits"
                  v-model="course.crs_credits" min="0" max="5">
              </div>
              <div class="col-4">
                <label for="area" class="form-label">Area:</label>
                <select class="form-control" id="area" v-model="course.crs_area">
                  <option :value="area" v-for="area in areasList">{{ area }}</option>
                </select>
              </div>
              <div class="col-4">
                <label for="type" class="form-label">Type:</label>
                <select class="form-control" id="type" v-model="course.crs_type">
                  <option :value="typeCourse" v-for="typeCourse in typeCourseList">{{ typeCourse }}</option>
                </select>
              </div>
            </div>
            <div class="form-group row mb-3 g-2 submit-button">
              <div class="col">
                <div class="alert alert-dismissible fade show" v-bind:class="[alertProps.type]" role="alert"
                  v-if="alertProps.state === true">
                  {{ alertProps.message }}
                  <button type="button" class="btn-close" @click="alertProps.state = false"></button>
                </div>
              </div>
              <div class="col-1">
                <button class="btn btn-success btn-sm" type="submit">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import axios from 'axios';
export default {
  name: "CourseEdit",
  created() { },
  data() {
    return {
      typeCourseList: ['elective', 'obligatory'],
      areasList: ['Electrical Engineering', 'Computer Science', 'Software Engineering', 'Health Care Management', 'Economics'],
      course: {},
      alertProps:{
        state: false,
        type: '',
        message: ''
      }
    };
  },
  created() {
    this.courseInfo();
  },
  methods: {
    toggleAlert(state, type, msg) {
      this.alertProps.state = state
      this.alertProps.type = `alert-${type}`
      this.alertProps.message = msg
    },
    saveChanges() {
      axios.put(`http://localhost:8000/api/course/update/${this.course.id}`, this.course)
        .then(
          ({ data }) => {
            console.log(data)
            this.toggleAlert(true, 'success', data)
            setTimeout(() => {
              this.$router.push('/courses')
            }, 2000);
          }
        ).catch(({ response }) => {
          console.log(response)
          this.toggleAlert(true, 'warning', response.data.msg)
        })
    },
    courseInfo() {
      const url = `http://localhost:8000/api/course/${this.$route.params.id}`;
      axios.get(url).then(
        ({ data }) => {
          // console.log(data);
          this.course = data;
        }
      )
    }
  },
};
</script>

<style scoped>
  .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #d3d3d3;
  }
  
  .card-body {
    background-color: #e2e2e2;
  }
  
  .submit-button {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 90px;
  }
  .alert {
    margin-bottom: 0px;
  }
</style>