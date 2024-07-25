import { ref, computed } from 'vue';
import { defineStore } from 'pinia';

export const useUserStore = defineStore('users', () => {
  const user = ref(null);

  const handleLogin = () => {};

  const handleSignUp = (credentials) => {
    const { email, password, userName } = credentials;
  };

  const handleLogout = () => {};

  const getUser = () => {};

  return {
    user,
    handleLogin,
    handleSignUp,
    handleLogout,
    getUser,
  };
});
