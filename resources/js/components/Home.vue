<template>
  <div id="home-page">
    <h1>Student Helper !</h1>
    <p>Student Helper est une application web qui permet aux étudiants de gérer leurs tâches quotidiennes, programmer les deadlines importantes, ou encore calculer leur moyenne</p>

    <div id="home-nav">
      <router-link to="/todolists">Mes TodoLists</router-link>
      <router-link to="/timeline">Ma timeline</router-link>
      <router-link to="/mean">Calculateur de moyenne</router-link>
    </div>
  </div>
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
