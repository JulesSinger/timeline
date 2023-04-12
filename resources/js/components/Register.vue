<template>
  <div id="register-page">
    <h1 id="title" class="text-center">Student Helper</h1>

    <div id="subtitle">
      <h2>Créer un compte</h2>
      <router-link to="/login" id="createaccount-link">déjà inscrit ?</router-link>
    </div>

    <form @submit.prevent="submit">
      <div class="input-container">
        <label for="email">Email</label>
        <input id="email" v-model="form.email" type="email" required placeholder="xyz@abc.com">
      </div>
      <div class="input-container">
        <label for="password">Mot de passe</label>
        <input id="password" v-model="form.password" type="password" required placeholder="*******">
      </div>

      <div class="input-container">
        <label for="password_confirmation">Confirmez le mot de passe</label>
        <input id="password_confirmation" v-model="form.password_confirmation" type="password" required placeholder="*******">
      </div>

      <div class="input-container">
        <label for="name">Nom</label>
        <input id="name" v-model="form.name" type="text" required placeholder="Toto">
      </div>

      <button type="submit" id="register-submit">CREER UN COMPTE</button>
    </form>
  </div>

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
