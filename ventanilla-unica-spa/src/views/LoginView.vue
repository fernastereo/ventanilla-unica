<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const clientId = route.params.client_id;
const router = useRouter();

const apiUrl = import.meta.env.VITE_APP_API_URL;
axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

const form = ref({
  email: null,
  password: null
});

const onLogin = async () => {
  await axios.get(apiUrl + '/sanctum/csrf-cookie');

  const result = await axios.post(apiUrl + '/login', {
    email: form.value.email,
    password: form.value.password
  });

  router.push({name: "peticion"});
}

const onLogout = async () => {
  await axios.post(apiUrl + '/logout');
  user.value = null;
}
</script>

<template>
  <div>
    <main>
      <form @submit.prevent="onLogin">
        <div>
          <label for="email">Email</label>
          <input id="email" type="email" v-model="form.email" required />
        </div>

        <div>
          <label for="password">Password</label>
          <input id="password" type="password" v-model="form.password" required />
        </div>

        <button class="">Login</button>
      </form>
      <br/>
      <RouterLink :to="`/signup/${clientId}`" class="">Sign Up</RouterLink>
      
      <br/>
      <br/>
      <button class="" @click="onLogout">logout</button>
    </main>
  </div>
</template>

<style scoped>
</style>