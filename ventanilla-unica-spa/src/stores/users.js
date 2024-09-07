import { ref } from 'vue';
import { defineStore } from 'pinia';
import axios from 'axios';

export const useUserStore = defineStore('users', () => {
  const user = ref(null);
  const errorMessage = ref('');
  const apiUrl = import.meta.env.VITE_APP_API_URL;
  axios.defaults.withCredentials = true;
  axios.defaults.withXSRFToken = true;

  const handleLogin = () => {};

  const handleSignUp = async (credentials) => {
    const { email, password, name, role_id, client_id } = credentials;

    if (password.length < 8) {
      return (errorMessage.value =
        'Password must be at least 8 characters long');
    }

    if (name.length < 8) {
      return (errorMessage.value = 'Name must be at least 8 characters long');
    }

    //validate email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      return (errorMessage.value = 'Invalid email');
    }

    errorMessage.value = '';

    //validate if user already exists

    //create user
    await axios.get(apiUrl + '/sanctum/csrf-cookie');
    const result = await axios.post(apiUrl + '/register', {
      name: credentials.name,
      email: credentials.email,
      password: credentials.password,
      password_confirmation: credentials.password_confirmation,
    });

    console.log(result);
  };

  const handleLogout = () => {};

  const getUser = () => {};

  return {
    user,
    errorMessage,
    handleLogin,
    handleSignUp,
    handleLogout,
    getUser,
  };
});
