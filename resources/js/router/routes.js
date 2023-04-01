import TimeLine from '../components/TimeLine.vue'
import MeanCalculator from '../components/MeanCalculator.vue'
import Todolist from '../components/Todolist.vue'
import Todolists from '../components/Todolists.vue'
export const routes = [
  {
    path: '/:id?',
    name: 'TimeLine',
    component: TimeLine,
    meta: { 
      title: 'TimeLine' ,
    }
  },
  {
    path: '/mean/:id?',
    name: 'Calculateur de moyenne',
    component: MeanCalculator,
    meta: { 
      title: 'MeanCalculator' ,
    }
  },
  {
    path: '/todolists',
    name: 'Todolists',
    component: Todolists,
    meta: {
      title: 'Todolists',
    }
  },
  {
    path: '/todolist/:id?',
    name: 'Todolist',
    component: Todolist,
    meta: {
      title: 'Todolist',
    }
  }
]