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
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      return (errorMessage.value = 'Invalid email');
    }

    //validate if user already exists
    // const response =  await axios.get(apiUrl + '/api/user');

    //create user
    try {
      await axios.get(apiUrl + '/sanctum/csrf-cookie');
      const response = await axios.post(apiUrl + '/register', {
        name: name,
        email: email,
        password: password,
        password_confirmation: password_confirmation,
        role_id: role_id,
        client_id: client_id,
      });
      return (errorMessage.value = '');
      // console.log(response);
    } catch (error) {
      if (error.response) {
        // The request was made and the server responded with a status code
        // that falls out of the range of 2xx

        if (error.response.status === 422) {
          // Handle validation error (422 Unprocessable Entity)
          return (errorMessage.value = error.response.data.message);
          // You can display these errors to the user in your UI
        } else {
          // Handle other errors (e.g., 500 Internal Server Error)
          return (errorMessage.value = error.response.data.message);
        }
      } else if (error.request) {
        // The request was made but no response was received
        return (errorMessage.value = 'No response received:'); //, error.request);
      } else {
        // Something else happened while setting up the request
        return (errorMessage.value = error.message);
      }
    }

    errorMessage.value = '';
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
