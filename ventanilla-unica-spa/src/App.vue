<script setup>
import HelloWorld from './components/HelloWorld.vue'
import TheWelcome from './components/TheWelcome.vue'
import { ref } from 'vue'
import axios from 'axios'

const form = ref({
  email: null,
  password: null
});

const user = ref();

const onLogin = async () => {
  console.log(form.value);
  await axios.get('http://localhost:5000/sanctum/csrf-cookie');
  await axios.post('http://localhost:5000/login', {
    email: form.value.email,
    password: form.value.password
  },
  {
    headers: {
      accept: 'application/json',
      'X-XSRF-TOKEN': getCookie('XSRF-TOKEN')
    },
    withCredentials: true
  });

  let {data} = await axios.get('http://localhost:5000/api/user');
  user.value = data;
}



function getCookie(name) {
  let cookieValue = null;
  if (document.cookie && document.cookie !== '') {
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
      const cookie = cookies[i].trim();
      if (cookie.substring(0, name.length + 1) === (name + '=')) {
        cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
        break;
      }
    }
  }
  return cookieValue;
}
</script>

<template>
  <div>
    <header>
      <img alt="Vue logo" class="logo" src="./assets/logo.svg" width="125" height="125" />

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
