<template>
  <form @submit.prevent="submit">
    <div>
      <label for="email">Email</label>
      <input id="email" v-model="form.email" type="email" required>
    </div>
    <div>
      <label for="password">Mot de passe</label>
      <input id="password" v-model="form.password" type="password" required>
    </div>
    <button type="submit">Login</button>
  </form>
</template>

<script setup>
import { ref } from 'vue';
import { useLogin } from '../api/auth';

const form = ref({
  email: '',
  password: '',
});

const { login } = useLogin();

const submit = async () => {
  await login(form.value);
};

</script>
