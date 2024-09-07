<script setup>
  import axios from 'axios';

  const apiUrl = import.meta.env.VITE_APP_API_URL;
  const onLogout = async () => {
    await axios.post(apiUrl + '/logout');
  }

  const form = {
    nombre: '',
    email: '',
    telefono: '',
    tipoPeticionId: '',
    mensaje: '',
    archivo: null
  }

  const onStore = async () => {
    let {data} = await axios.post(apiUrl + '/api/peticions', form);
    user.value = data;
  }
</script>

<template>
  <div>
    <h1>Dashboard view</h1>
    <br/>
      <button class="" @click="onStore">Store</button>
    <br/>
      <button class="" @click="onLogout">logout</button>
  </div>
</template>

<style scoped>

</style>