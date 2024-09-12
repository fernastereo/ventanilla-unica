<script setup>
  import { ref } from 'vue'
  import { useRoute, useRouter } from 'vue-router';
  import { useUserStore } from '../stores/users';
  import { storeToRefs } from 'pinia';
  import Spinner from '../components/Spinner.vue';
  
  const route = useRoute();
  const clientId = route.params.client_id;
  localStorage.setItem('clientId', clientId);
  const router = useRouter();

  const userStore = useUserStore();
  const { user, errorMessage, loading } = storeToRefs(userStore);

  const form = ref({
    email: null,
    password: null
  });

  const onLogin = async () => {
    await userStore.handleLogin(form.value);

    if(user)
      router.push({name: "peticion"});
  }
</script>

<template>
  <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
    <div class="flex-1">
      <div class="text-center">
        <h2 class="text-4xl font-bold text-center text-gray-700 dark:text-white">Inicie Sesión</h2>                        
        <p class="mt-3 text-gray-500 dark:text-gray-300">Acceso a su cuenta en la Ventanilla Unica</p>
      </div>

      <div class="mt-8">
        <form @submit.prevent="onLogin">
          <div>
            <label for="email" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Email</label>
            <input type="email" required v-model="form.email" name="email" id="email" placeholder="example@example.com" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
          </div>

          <div class="mt-6">
            <div class="flex justify-between mb-2">
              <label for="password" class="text-sm text-gray-600 dark:text-gray-200">Password</label>
              <a href="#" class="text-sm text-gray-400 focus:text-blue-500 hover:text-blue-500 hover:underline">Olvidó su password?</a>
            </div>

            <input type="password" required v-model="form.password" name="password" id="password" placeholder="Su Password" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
          </div>
          <div class="mt-3">
            <p class="text-xs text-red-600" v-if="errorMessage">{{errorMessage}}</p>
          </div>
          <Spinner :show="loading" /> 
          <div class="mt-6">
            <button
                class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-400 focus:outline-none focus:bg-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                Iniciar
            </button>
          </div>
        </form>

        <p class="mt-6 text-sm text-center text-gray-400">Aun no tiene una cuenta?
          <RouterLink :to="`/signup/${clientId}`" class="text-blue-500 focus:outline-none focus:underline hover:underline">Registrese</RouterLink>.
        </p>
      </div>

    </div>
  </div>
</template>

<style scoped>
</style>