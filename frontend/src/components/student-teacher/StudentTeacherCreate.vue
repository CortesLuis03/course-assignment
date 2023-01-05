<template>
  <div class="p-5">
    <div class="card">
      <div class="card-header">
        <h2>New Registration</h2>
        <button class="btn btn-danger btn-sm" :disabled="disabledDiscard"
          @click="() => this.$router.push('/student-teacher')">{{ buttonText }}</button>
      </div>
      <div class="card-body">
        <div class="container">
          <form @submit.prevent="save">
            <div class="form-group row mb-3 g-2">
              <div class="col">
                <label for="credits" class="form-label">Student:</label>
                <select class="form-control" id="area" v-model="register.std_id" :disabled="disabledStudent">
                  <option :value="student.id" v-for="student in dataForm.students">{{ student.std_dni }} - {{
                    student.std_name
                  }} {{ student.std_lastname }}</option>
                </select>
              </div>
              <div class="col">
                <label for="type" class="form-label">Teacher:</label>
                <select class="form-control" id="type" v-model="register.tch_id">
                  <option :value="teacher.id" v-for="teacher in dataForm.teachers">{{ teacher.tch_name }} {{
                    teacher.tch_lastname
                  }}</option>
                </select>
              </div>
              <div class="col">
                <label for="area" class="form-label">Area:</label>
                <select class="form-control" id="area" v-model="area" @change="register.crs_id = null"
                  :disabled="disabledStudent">
                  <option :value="area" v-for="area in dataForm.areas">{{ area }}</option>
                </select>
              </div>
              <div class="col">
                <label for="type" class="form-label">Course:</label>
                <select class="form-control" id="type" v-model="register.crs_id" @change="updateCredits()">
                  <option :value="course.id" v-for="course in dataForm.courses" v-if="area === course.crs_area">{{
                    course.crs_name
                  }} / Credits: {{ course.crs_credits }}</option>
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
                <button class="btn btn-primary btn-sm" type="submit" :disabled="register.credits === 0">Add</button>
              </div>
            </div>
          </form>
          <div class="row">
            <table class="table table-hover">
              <thead>
                <tr>
                  <td align="center" scope="col"><strong>Course</strong></td>
                  <td align="center" scope="col"><strong>Teacher</strong></td>
                  <td align="center" scope="col"><strong>Credits</strong></td>
                  <td align="center" scope="col"><strong>Actions</strong></td>
                </tr>
              </thead>
              <tbody>
                <tr v-for="course in infoCourses.courses">
                  <td align="center">
                    <div class="align-middle">
                      {{ course['course'].crs_name }} - {{ course['course'].crs_type }}
                    </div>
                  </td>
                  <td align="center">
                    <div class="align-middle">
                      {{ course['teacher'].tch_name }} {{ course['teacher'].tch_lastname }}
                    </div>
                  </td>
                  <td align="center">
                    <div class="align-middle">
                      {{ course['credits'] }}
                    </div>
                  </td>
                  <td align="center">
                    <div class="btn-group btn-group-sm" role="group">
                      <button type="button" class="btn btn-danger" @click="remove(course)">X</button>
                    </div>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td></td>
                  <td align="center"><strong>Total credits:</strong></td>
                  <td align="center">{{ totalCredits }}</td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "CourseCreate",
  created() { },
  data() {
    return {
      register: {
        credits: 0
      },
      area: null,
      alertProps: {
        state: false,
        type: '',
        message: ''
      },
      dataForm: {},
      disabledStudent: false,
      disabledDiscard: false,
      infoCourses: {},
      totalCredits: 0,
      buttonText: 'Discard'
    };
  },
  created() {
    this.getInfo();
  },
  methods: {
    getInfo() {
      const url = 'http://localhost:8000/api/relationship/info';
      axios.get(url).then(
        ({ data }) => {
          console.log(data);
          this.dataForm = data;
        }
      )
    },
    getInfoStudent() {
      const url = `http://localhost:8000/api/relationship/infoStudent/${this.register.std_id}`;
      axios.get(url).then(
        ({ data }) => {
          console.log(data);
          this.infoCourses = data;
          this.totalCredits += this.register.credits;
          this.register.tch_id = null;
          this.register.crs_id = null;
          this.register.credits = 0;
          this.disabledStudent = true;
          this.buttonText = 'Finish';
          if (this.totalCredits > 7) {
            this.disabledDiscard = false;
          } else {
            this.disabledDiscard = true;
          }
        }
      )
    },
    save() {
      this.saveData();
    },
    toggleAlert(state, type, msg) {
      this.alertProps.state = state
      this.alertProps.type = `alert-${type}`
      this.alertProps.message = msg
    },
    saveData() {
      axios.post("http://localhost:8000/api/relationship/save", this.register)
        .then(
          ({ data }) => {
            console.log(data)
            this.toggleAlert(true, 'success', data)
            this.getInfoStudent();
          }
        ).catch(({ response }) => {
          console.log(response)
          this.toggleAlert(true, 'warning', response.data.msg)
        })

    },
    updateCredits() {
      if (this.register.crs_id != null) {
        this.register.credits = this.dataForm.courses.filter(course => course.id === this.register.crs_id)[0].crs_credits;
      } else {
        this.register.credits = 0;
      }
    },
    remove(course) {
      console.log(course)
      const url = `http://localhost:8000/api/relationship/delete/${course.id}`;
      console.log(url)
      axios.delete(url).then(({ data }) => {
        this.totalCredits -= course.credits;
        this.toggleAlert(true, 'warning', data)
        this.getInfoStudent();
      });
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