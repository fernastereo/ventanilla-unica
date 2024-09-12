<script setup>
  import { useUserStore } from '../stores/users';
  import { reactive } from 'vue';
  import { storeToRefs } from 'pinia';
  import { useRoute, useRouter } from 'vue-router';
  import Spinner from '../components/Spinner.vue';

  const router = useRouter();
  const route = useRoute();
  const clientId = route.params.client_id;

  const userStore = useUserStore();
  const { user, errorMessage, loading } = storeToRefs(userStore);

  const userCredentials = reactive({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    role_id: "2",
    client_id: clientId
  });

  const onSubmit = async () => {
    await userStore.handleSignUp(userCredentials);

    if (!errorMessage.value) {
      router.push({name: "peticion"});
    }
  }
</script>

<template>
  <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
    <div class="flex-1">
      <div class="text-center">
        <h2 class="text-4xl font-bold text-center text-gray-700 dark:text-white">Registro</h2>                        
        <p class="mt-3 text-gray-500 dark:text-gray-300">Para registrarse en Ventanilla Unica por
          favor diligencie los siguientes datos</p>
      </div>

      <div class="mt-8">
        <form @submit.prevent="onSubmit">
          <div class="">
            <label for="inputName" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Nombre</label>
            <input type="text" v-model="userCredentials.name" id="inputName" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40">
          </div>
          <div class="mt-6">
            <label for="inputEmail1" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Email</label>
            <input type="email" v-model="userCredentials.email" id="inputEmail1" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40">
          </div>
          <div class="mt-6">
            <label for="inputPassword1" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Password</label>
            <input type="password" v-model="userCredentials.password" id="inputPassword1" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40">
          </div>
          <div class="mt-6">
            <label for="inputPassword2" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Confirmar Password</label>
            <input type="password" v-model="userCredentials.password_confirmation" id="inputPassword2" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40">
          </div>
          <div class="mt-3">
            <p class="text-xs text-red-600" v-if="errorMessage">{{errorMessage}}</p>
          </div>
          <Spinner :show="loading" /> 
          <div class="mt-12">
            <button
                class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-400 focus:outline-none focus:bg-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                Crear Usuario
            </button>
          </div>
        </form>

        <p class="mt-6 text-sm text-center text-gray-400">Ya tiene una cuenta?
          <RouterLink :to="`/login/${clientId}`" class="text-blue-500 focus:outline-none focus:underline hover:underline">Inicie Sesión Aqui</RouterLink>.
        </p>
      </div>
    </div>
  </div>
</template>