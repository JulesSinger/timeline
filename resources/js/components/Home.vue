<template>
  <div id="home-page">
    <h1>Student Helper !</h1>
    <p>Student Helper est une application web qui permet aux étudiants de gérer leurs tâches quotidiennes, programmer les deadlines importantes, ou encore calculer leur moyenne</p>
    <button @click="submit_logout()">logout</button>
    <div id="home-nav">
      <router-link to="/todolists">Mes TodoLists</router-link>
      <router-link to="/timeline">Ma timeline</router-link>
      <router-link to="/mean">Calculateur de moyenne</router-link>
    </div>
  </div>
</template>

<script setup>
import { useLogout } from '../api/auth';
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'


const store = useStore()
const router = useRouter()

const { logout } = useLogout();

const submit_logout = async () => {
  await logout(() => store.dispatch('auth/logout_store'));
  router.push({ name: 'Home' })
};
</script>
