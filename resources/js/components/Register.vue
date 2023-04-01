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

    <div>
      <label for="password_confirmation">Confirmez le mot de passe</label>
      <input id="password_confirmation" v-model="form.password_confirmation" type="password" required>
    </div>

    <div>
      <label for="name">Nom</label>
      <input id="name" v-model="form.name" type="text" required>
    </div>

    <button type="submit">Register</button>
  </form>
</template>

<script setup>
import { ref } from 'vue';
import { useRegister } from '../api/auth';

const form = ref({
  email: '',
  password: '',
  password_confirmation: '',
  name: '',
});

const { register } = useRegister();

const submit = async () => {
  await register(form.value);
};

</script>
