import { createWebHistory, createRouter } from 'vue-router'
import { nextTick } from 'vue'
import { routes } from './routes.js'
import store from '../store'

const PROJECT_NAME = 'TimeLine Personelle'
export const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title
    if (to.meta.middleware == "guest") {
        if (store.state.auth.authenticated) {
            next({ name: "Home" })
        } else {
            next()
        }
    } else if(to.meta.middleware == "auth") {
        console.log(store.state.auth.authenticated)
        if (store.state.auth.authenticated) {
            next()
        } else {
            next({ name: "Login" })
        }
    } else {
        next()
    }
});

router.afterEach((to, from) => {
    nextTick(() => {
        document.title = PROJECT_NAME + ' - ' + to.meta.title || ''
    })
})

export default router