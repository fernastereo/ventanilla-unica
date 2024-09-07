<script setup>
  import { useUserStore } from '../stores/users';
  import { ref, reactive } from 'vue';
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
  <div class="container">
    <h1>SignUp</h1>
    <form @submit.prevent="onSubmit">
      <div class="mb-3">
        <label for="exampleInputName" class="form-label">Nombre</label>
        <input type="text" class="form-control" v-model="userCredentials.name" id="exampleInputName" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" class="form-control" v-model="userCredentials.email" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" v-model="userCredentials.password" id="exampleInputPassword1">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword2" class="form-label">Confirmar Password</label>
        <input type="password" class="form-control" v-model="userCredentials.password_confirmation" id="exampleInputPassword2">
      </div>
      <div class="mb-3">
        <p v-if="errorMessage">{{errorMessage}}</p>
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>
</template>