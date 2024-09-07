<script setup>
  import { useUserStore } from '../stores/users';
  import { reactive } from 'vue';
  import { storeToRefs } from 'pinia';
  import { useRoute } from 'vue-router';

  const route = useRoute();
  const clientId = route.params.client_id;

  const userStore = useUserStore();
  const { errorMessage } = storeToRefs(userStore);

  const userCredentials = reactive({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    role_id: "",
    client_id: ""
  });

  const onSubmit = async () => {
    userStore.handleSignUp(userCredentials);
  }
</script>

<template>
  <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
    <div class="flex-1">
    <h1>SignUp</h1>
    <form @submit.prevent="onSubmit">
      <div class="">
        <label for="exampleInputName" class="">Nombre</label>
        <input type="text" class="" v-model="userCredentials.name" id="exampleInputName" aria-describedby="emailHelp">
      </div>
      <div class="">
        <label for="exampleInputEmail1" class="">Email</label>
        <input type="email" class="" v-model="userCredentials.email" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>
      <div class="">
        <label for="exampleInputPassword1" class="">Password</label>
        <input type="password" class="" v-model="userCredentials.password" id="exampleInputPassword1">
      </div>
      <div class="">
        <label for="exampleInputPassword2" class="">Confirmar Password</label>
        <input type="password" class="" v-model="userCredentials.password_confirmation" id="exampleInputPassword2">
      </div>
      <div class="">
        <p v-if="errorMessage">{{errorMessage}}</p>
      </div>
      <button type="submit" class="">Enviar</button>
    </form>

    <p class="mt-6 text-sm text-center text-gray-400">Ya tiene una cuenta?
      <RouterLink :to="`/login/${clientId}`" class="text-blue-500 focus:outline-none focus:underline hover:underline">Inicie Sesión Aqui</RouterLink>.
    </p>
    </div>
  </div>
</template>