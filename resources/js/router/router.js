import { createWebHistory, createRouter } from 'vue-router'
import { nextTick } from 'vue'
import { routes } from './routes.js'
const PROJECT_NAME = 'TimeLine Personelle'
import { useUser } from '../api/auth.js'
export const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    const { isLoggedIn } = useUser();

    // Si la page nécessite une authentification et que l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    if (to.meta.requiresAuth && !isLoggedIn.value) {
        router.push('/login');
        return;
    }
    document.title = to.meta.title
    next();
});

router.afterEach((to, from) => {
    nextTick(() => {
        document.title = PROJECT_NAME + ' - ' + to.meta.title || ''
    })
})

export default router