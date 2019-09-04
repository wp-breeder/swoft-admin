import Vue from 'vue'
import Routes from './route'
import Router from 'vue-router'
import store from '../store';
import Cache from '../libs/cache'
import { filterRouter } from "@/libs/util"
import NProgress from 'nprogress/nprogress'

Vue.use(Router)

const router = new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    scrollBehavior: () => ({ y: 0 }),
    routes: Routes
})

let isAddedRoutes = 0

router.beforeEach((to, from, next) => {
    if (to.path === '/login') {
        next()
    } else {
        let token = Cache.get('token')
        if (token) {
            if (isAddedRoutes == 0) {
                router.addRoutes(filterRouter(store.getters.menus))
                isAddedRoutes++
                next({...to, replace: true })
            }
            // Start the route progress bar.
            NProgress.start()
            next()
        } else {
            next('/login')
        }
    }

})
router.afterEach(() => {
    NProgress.done()
})

export default router