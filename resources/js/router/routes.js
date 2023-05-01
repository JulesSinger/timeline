import TimeLine from '../components/TimeLine.vue'
import MeanCalculator from '../components/MeanCalculator.vue'
import Todolist from '../components/Todolist.vue'
import Todolists from '../components/Todolists.vue'
import Login from '../components/Login.vue'
import Register from '../components/Register.vue'
import Home from '../components/Home.vue'

export const routes = [
  {
    path: '/login',
    name: 'Login',
    component: Login,
    meta: {
      title: 'Login',
      middleware: "guest"
    }
  },
  {
    path: '/register',
    name: 'Register',
    component: Register,
    meta: {
      title: 'Inscription',
      middleware: "guest"
    }
  },
  {
    path: '/',
    name: 'Home',
    component: Home,
    meta: {
      title: 'Accueil',
      middleware: "auth"
    }
  },
  {
    path: '/timeline',
    name: 'TimeLine',
    component: TimeLine,
    meta: { 
      title: 'TimeLine',
      middleware: "auth"
    }
  },
  {
    path: '/mean',
    name: 'Calculateur de moyenne',
    component: MeanCalculator,
    meta: { 
      title: 'Calculateur de moyenne',
      middleware: "auth"
    }
  },
  {
    path: '/todolists',
    name: 'Todolists',
    component: Todolists,
    meta: {
      title: 'Todolists',
      middleware: "auth"
    }
  },
  {
    path: '/todolist/:id?',
    name: 'Todolist',
    component: Todolist,
    meta: {
      title: 'Todolist',
      middleware: "auth"
    }
  }
]