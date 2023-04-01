import { createWebHistory, createRouter } from 'vue-router'
import { nextTick } from 'vue'
import { routes } from './routes.js'
const PROJECT_NAME = 'TimeLine Personelle'
export const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title
    next();
});

router.afterEach((to, from) => {
    nextTick(() => {
        document.title = PROJECT_NAME + ' - ' + to.meta.title || ''
    })
})

export default router