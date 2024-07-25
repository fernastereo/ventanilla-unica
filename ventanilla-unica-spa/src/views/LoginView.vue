<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router';

const router = useRouter();

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

const form = ref({
  email: null,
  password: null
});

const user = ref();
const testResult = ref();

const onLogin = async () => {
  await axios.get('http://localhost:5000/sanctum/csrf-cookie');

  const result = await axios.post('http://localhost:5000/login', {
    email: form.value.email,
    password: form.value.password
  });
  router.push({name: "dashboard"});
  
  // let {data} = await axios.get('http://localhost:5000/api/user');
  // //if user is logged in then redirect to dashboard route
  // user.value = data;
}

const onLogout = async () => {
  await axios.post('http://localhost:5000/logout');
  user.value = null;
}

const runTest = async () => {
  let {data} = await axios.get('http://localhost:5000/api/test');
  testResult.value = data;
}

function getCookie(name) {
  const cookie = document.cookie.split('; ').find(item => item.startsWith(name + '='));
  return cookie ? decodeURIComponent(cookie.split('=')[1]) : null;
}

const onIndex = async () => {
  let {data} = await axios.get('http://localhost:5000/api/tipopeticions');
  user.value = data;
}
const onStore = async () => {
  let {data} = await axios.post('http://localhost:5000/api/peticions');
  user.value = data;
}
const onShow = async () => {
  let {data} = await axios.get('http://localhost:5000/api/peticions/1');
  user.value = data;
}
const onUpdate = async () => {
  let {data} = await axios.put('http://localhost:5000/api/peticions/1');
  user.value = data;
}
const onDestroy = async () => {
  let {data} = await axios.delete('http://localhost:5000/api/peticions/1');
  user.value = data;
}
</script>

<template>
  <div>
    <header>
      <div class="wrapper">
        <HelloWorld msg="You did it!!" />
      </div>
    </header>

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

        <button>Login</button>
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
header {
  line-height: 1.5;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }
}

</style>