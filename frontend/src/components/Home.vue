<template>
  <div class="container">
    <div class="row">
      <div class="col text-center">
        <div>
          <h1>{{ title }}</h1>
          <span>{{ subtitle }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Home',
  data() {
    return {
      title: 'Welcome to Course Assignment',
      subtitle: 'Please open the menu and select an action to assign courses.'
    }
  }
}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.container {
  height: 500px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.container>div {
  text-align: center;
}
</style>
