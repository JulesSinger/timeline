import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import axiosClient from '../axios'

const user = ref(null);

export function useLogin() {
  const router = useRouter();

  const login = async (credentials, onSuccess = null) => {
    try {
      const response = await axiosClient.post('/api/login', credentials);

      
      if (response.status === 200) {
        onSuccess(response)
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
      const response = await axiosClient.post('/api/register', credentials);

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

  const logout = async (onSuccess) => {
    try {
      const response = await axiosClient.post('/api/logout');

      if (response.status === 200) {
        onSuccess(response)
        await router.push('/login');
      }
    } catch (error) {
      console.log(error);
    }
  };

  return { logout };
}