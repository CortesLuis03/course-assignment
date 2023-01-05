<template>
  <div class="container-fluid" id="app">
    <div class="row pb-2 mb-1 bg-body">
      <div class="col-2">
        <NavBar />
      </div>
    </div>
    <div class="row">
      <div class="col mt-2">
        <div class="container-app shadow bg-light shadow-lg rounded">
          <router-view />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import NavBar from '@/components/NavBar'
export default {
  name: 'App',
  components: {
    NavBar
  }
}
</script>

<style>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}

body {
  background-color: #dfdfdf;
}

.container-app {
  min-height: 200px;
  margin-left: 5%;
  margin-right: 5%;
}

.btn {
  background-blend-mode: multiply;
  background: transparent;
  color: black;
  font-weight: 600;
}

.btn-success {
  border: 2px #198754 solid;
  min-width: 70px;
}

.btn-primary {
  border: 2px #0d6efd solid;
  min-width: 70px;
}

.btn-warning {
  border: 2px #ffc107 solid;
  min-width: 70px;
}

.btn-danger {
  border: 2px #dc3545 solid;
  min-width: 70px;
}

table{
  font-size: 10pt;
}
</style>
