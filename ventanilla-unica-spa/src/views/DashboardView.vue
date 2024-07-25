<script setup>
  import axios from 'axios';

  const onLogout = async () => {
    await axios.post('http://localhost:5000/logout');
  }
</script>

<template>
  <div>
    <h1>Dashboard view</h1>
    <br/>
      <button class="btn btn-primary" @click="onLogout">logout</button>
  </div>
</template>

<style scoped>

</style>