import TimeLine from '../components/TimeLine.vue'

export const routes = [
  {
    path: '/:id?',
    name: 'TimeLine',
    component: TimeLine,
    meta: { 
      title: 'TimeLine' ,
    }

  },
]