<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const sender = route.query.sender;
const router = useRouter();

const apiUrl = import.meta.env.VITE_APP_API_URL;
axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

const form = ref({
  email: null,
  password: null
});

const user = ref();
const testResult = ref();

const onLogin = async () => {
  await axios.get(apiUrl + '/sanctum/csrf-cookie');

  const result = await axios.post(apiUrl + '/login', {
    email: form.value.email,
    password: form.value.password
  });
  router.push({name: "peticion"});
  
  // let {data} = await axios.get(apiUrl + '/api/user');
  //if user is logged in then redirect to dashboard route
  // user.value = data;
}

const onLogout = async () => {
  await axios.post(apiUrl + '/logout');
  user.value = null;
}

const runTest = async () => {
  let {data} = await axios.get(apiUrl + '/api/test');
  testResult.value = data;
}

function getCookie(name) {
  const cookie = document.cookie.split('; ').find(item => item.startsWith(name + '='));
  return cookie ? decodeURIComponent(cookie.split('=')[1]) : null;
}

const onIndex = async () => {
  let {data} = await axios.get(apiUrl + '/api/tipopeticions');
  user.value = data;
}
const onStore = async () => {
  let {data} = await axios.post(apiUrl + '/api/peticions');
  user.value = data;
}
const onShow = async () => {
  let {data} = await axios.get(apiUrl + '/api/peticions/1');
  user.value = data;
}
const onUpdate = async () => {
  let {data} = await axios.put(apiUrl + '/api/peticions/1');
  user.value = data;
}
const onDestroy = async () => {
  let {data} = await axios.delete(apiUrl + '/api/peticions/1');
  user.value = data;
}
</script>

<template>
  <div>
    <main>
      {{ user }}
      <form @submit.prevent="onLogin">
        <div>
          <label for="email">Email</label>
          <input id="email" type="email" v-model="form.email" required />
        </div>

        <div>
          <label for="password">Password</label>
          <input id="password" type="password" v-model="form.password" required />
        </div>

        <button class="btn btn-primary">Login</button>
      </form>
      <br/>
      <RouterLink to="/signup" class="btn btn-primary">Sign Up</RouterLink>
      
      <br/>
      <br/>
      <button class="btn btn-primary" @click="onLogout">logout</button>
      <br/>
      <button class="btn btn-primary" @click="onIndex">index</button>
      <br/>
      <button class="btn btn-primary" @click="onStore">store</button>
      <br/>
      <button class="btn btn-primary" @click="onShow">show</button>
      <br/>
      <button class="btn btn-primary" @click="onUpdate">update</button>
      <br/>
      <button class="btn btn-primary" @click="onDestroy">destroy</button>
    </main>
  </div>
</template>

<style scoped>
</style>