<script setup>
  import axios from 'axios';

  const apiUrl = import.meta.env.VITE_APP_API_URL;
  const onLogout = async () => {
    await axios.post(apiUrl + '/logout');
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