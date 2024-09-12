import { ref } from 'vue';
import { defineStore } from 'pinia';
import axios from 'axios';

export const useUserStore = defineStore('users', () => {
  const user = ref(null);
  const errorMessage = ref('');
  const loading = ref(false);

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const apiUrl = import.meta.env.VITE_APP_API_URL;
  axios.defaults.withCredentials = true;
  axios.defaults.withXSRFToken = true;

  const handleLogin = async (credentials) => {
    const { email, password } = credentials;
    //validate email
    if (!emailRegex.test(email)) {
      return (errorMessage.value = 'Invalid email');
    }

    if (!password.length) {
      return (errorMessage.value = 'Password cannot be empty');
    }

    try {
      loading.value = true;

      await axios.get(apiUrl + '/sanctum/csrf-cookie');
      await axios.post(apiUrl + '/login', {
        email: email,
        password: password,
      });

      const response = await axios.get(apiUrl + '/api/user');
      loading.value = false;

      return (user.value = response.data);
    } catch (error) {
      loading.value = false;
      return (errorMessage.value = error.message);
    } finally {
      loading.value = false;
      errorMessage.value = '';
    }
  };

  const handleSignUp = async (credentials) => {
    const { email, password, password_confirmation, name, role_id, client_id } =
      credentials;

    if (password.length < 8) {
      return (errorMessage.value =
        'Password must be at least 8 characters long');
    }

    if (name.length < 8) {
      return (errorMessage.value = 'Name must be at least 8 characters long');
    }

    //validate email
    if (!emailRegex.test(email)) {
      return (errorMessage.value = 'Invalid email');
    }

    //create user
    try {
      loading.value = true;
      await axios.get(apiUrl + '/sanctum/csrf-cookie');
      await axios.post(apiUrl + '/register', {
        name: name,
        email: email,
        password: password,
        password_confirmation: password_confirmation,
        role_id: role_id,
        client_id: client_id,
      });
      loading.value = false;
      return (errorMessage.value = '');
    } catch (error) {
      loading.value = false;
      if (error.response) {
        if (error.response.status === 422) {
          return (errorMessage.value = error.response.data.message);
        } else {
          return (errorMessage.value = error.response.data.message);
        }
      } else if (error.request) {
        return (errorMessage.value = 'No response received:'); //, error.request);
      } else {
        return (errorMessage.value = error.message);
      }
    } finally {
      loading.value = false;
      errorMessage.value = '';
    }
  };

  const handleLogout = (credentials) => {};

  const getUser = () => {};

  return {
    user,
    errorMessage,
    loading,
    handleLogin,
    handleSignUp,
    handleLogout,
    getUser,
  };
});
