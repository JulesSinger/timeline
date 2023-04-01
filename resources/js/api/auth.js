import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const user = ref(null);

export function useLogin() {
  const router = useRouter();

  const login = async (credentials) => {
    try {
      const response = await axios.post('/api/login', credentials);

      if (response.status === 200) {
        await router.push('/');
      }
    } catch (error) {
      console.log(error)
    }
  };

  return { login };
}

export function useRegister() {
  const router = useRouter();

  const register = async (credentials) => {
    try {
      const response = await axios.post('/api/register', credentials);

      if (response.status === 200) {
        await router.push('/');
      }
    } catch (error) {
      console.log(error)
    }
  };

  return { register };
}

export function useLogout() {
  const router = useRouter();

  const logout = async () => {
    try {
      const response = await axios.post('/api/logout');

      if (response.status === 200) {
        await router.push('/login');
      }
    } catch (error) {
      console.log(error);
    }
  };

  return { logout };
}

export function useUser() {
  const fetchUser = async () => {
    try {
      const response = await axios.get('/api/user');

      if (response.status === 200) {
        user.value = response.data;
      }
    } catch (error) {
      console.log(error);
    }
  };

  // Appeler fetchUser() lorsqu'un composant qui utilise useUser() est monté
  fetchUser();

  // Renvoyer une propriété calculée qui indique si l'utilisateur est connecté
  const isLoggedIn = computed(() => !!user.value);

  return { user, isLoggedIn };
}