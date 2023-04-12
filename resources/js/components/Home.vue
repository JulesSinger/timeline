<template>
  <div id="home-page">
    <h1 class="text-center">Student Helper</h1>
    <p class="text-center">Student Helper est une application web qui permet aux étudiants de gérer leurs tâches quotidiennes, programmer les deadlines importantes, ou encore calculer leur moyenne</p>
    <button @click="submit_logout()">logout</button>
    
    <div id="programs">
      <div id="card1" class="card">
        <router-link to="/todolists">Mes TodoLists</router-link>
      </div>

      <div id="card2" class="card">
        <router-link to="/timeline">Ma timeline</router-link>
      </div>
      <div id="card3" class="card">
        <router-link to="/mean">Calculateur de moyenne</router-link>
      </div>  
    </div>
    <div id="home-nav">
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
