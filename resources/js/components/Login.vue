<template>
  <div id="login-page">
    <h1 id="title" class="text-center">Student Helper</h1>

    <div id="subtitle">
      <h2>Connexion</h2>
      <router-link to="/register" id="createaccount-link">Créer un compte</router-link>
    </div>
    
    <form @submit.prevent="submit">
      <div class="input-container">
        <label for="email">Email</label>
        <input id="email" v-model="form.email" type="email" required placeholder="xyz@abc.com">
      </div>
      <div class="input-container">
        <label for="password">Mot de passe</label>
        <input id="password" v-model="form.password" type="password" required placeholder="******">
      </div>
      <button type="submit" id="login-submit">CONNEXION</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useLogin } from '../api/auth';
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'

const store = useStore()
const router = useRouter()

const form = ref({
  email: '',
  password: '',
});

const { login } = useLogin();

const submit = async () => {
  await login(form.value, (response) => {
    store.dispatch('auth/login', response.data.data.token)
    store.dispatch('auth/authenticate')
    router.push({ name: 'Home' })
  });
};

</script>
