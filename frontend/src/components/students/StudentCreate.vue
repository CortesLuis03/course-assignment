<template>
  <div class="p-5">
    <div class="card">
      <div class="card-header">
        <h2>New Student</h2>
        <router-link class="btn btn-danger btn-sm" to="/students">Discard</router-link>
      </div>
      <div class="card-body">
        <div class="container">
          <form @submit.prevent="save">
            <div class="form-group row mb-3 g-2">
              <div class="col">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" placeholder="Name" id="name" v-model="student.std_name">
              </div>
              <div class="col">
                <label for="lastname" class="form-label">Lastname:</label>
                <input type="text" class="form-control" placeholder="Lastname" id="lastname"
                  v-model="student.std_lastname">
              </div>
            </div>
            <div class="form-group row mb-3 g-2">
              <div class="col-3">
                <label for="dni" class="form-label">Identification Number:</label>
                <input type="text" class="form-control" placeholder="Identification Number" id="dni"
                  v-model="student.std_dni">
              </div>
              <div class="col-3">
                <label for="phone" class="form-label">Phone number:</label>
                <input type="text" class="form-control" placeholder="000 000 0000" id="phone"
                  v-model="student.std_phone">
              </div>
              <div class="col">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" placeholder="test@test.com" id="email"
                  v-model="student.std_email">
              </div>
            </div>
            <div class="form-group row mb-3 g-2">
              <div class="col-2">
                <label for="semester" class="form-label">Semester:</label>
                <select class="form-control" id="semester" v-model="student.std_semester">
                  <option :value="semester" v-for="semester in semesterList">{{ semester }}</option>
                </select>
              </div>
              <div class="col">
                <label for="address" class="form-label">Address:</label>
                <input type="text" class="form-control" placeholder="1234 Avenue" id="address"
                  v-model="student.std_address">
              </div>
              <div class="col-3">
                <label for="city" class="form-label">City:</label>
                <input type="text" class="form-control" placeholder="City" id="city" v-model="student.std_city">
              </div>
            </div>
            <div class="form-group row mb-3 g-2 submit-button">
              <div class="col">
                <div class="alert alert-dismissible fade show" v-bind:class="[alertProps.type]" role="alert" v-if="alertProps.state === true">
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
  name: "StudentCreate",
  created() { },
  data() {
    return {
      semesterList: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
      student: {},
      alertProps:{
        state: false,
        type: '',
        message: ''
      }
    };
  },
  props: {},
  methods: {
    save() {
      this.saveData();
    },
    toggleAlert(state, type, msg) {
      this.alertProps.state = state
      this.alertProps.type = `alert-${type}`
      this.alertProps.message = msg
    },
    saveData() {
      axios.post("http://localhost:8000/api/student/save", this.student)
        .then(
          ({ data }) => {
            console.log(data)
            this.toggleAlert(true, 'success', data)
            setTimeout(() => {
              this.$router.push('/students')
            }, 2000);
          }
        ).catch(({ response }) => {
          console.log(response)
          this.toggleAlert(true, 'warning', response.data.msg)
        })

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