<template>
  <div>
    <nav class="navbar navbar-light bg-light">
      <div class="container">
        <a type="button" class="navbar-brand" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button">
          <span class="navbar-toggler-icon"></span>
        </a>
      </div>
    </nav>
    <div class="offcanvas offcanvas-start border-bottom" tabindex="-1" id="offcanvasExample"
      aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header shadow p-3 mb-1 bg-dark">
        <h5 class="offcanvas-title text-center">
          <img class="img-responsive" src="../assets/logo.png" />
        </h5>
      </div>
      <div class="offcanvas-body">
        <ul class="nav flex-column">
          <li class="nav-item">
            <router-link class="nav-link" to="/" data-bs-dismiss="offcanvas">Inicio</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/students" data-bs-dismiss="offcanvas">Students</router-link>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "NavBar",
  created() { },
  data() {
    return {};
  },
  props: {},
  methods: {},
};
</script>

<style scoped>
.offcanvas-body {
  padding: 0px;
}

.offcanvas-start {
  width: 250px;
  background-color: #313a46;
  color: white;
}

.nav-item a {
  color: white;
}

.nav-item a:hover {
  color: rgba(255, 255, 255, 0.247);
}

.offcanvas-title img {
  width: 100px;
  align-items: center;
}

.offcanvas-header {
  justify-content: center;
}
</style>