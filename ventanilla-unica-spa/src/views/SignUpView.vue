<script setup>
  import { useUserStore } from '../stores/users';
  import { reactive } from 'vue';
  import { storeToRefs } from 'pinia';

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
  <div class="">
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
  </div>
</template>