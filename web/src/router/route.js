import Login from '@/views/Login.vue'

export default [{
    path: '/login',
    component: Login
}, {
    path: '/',
    component: () =>
        import ('@/views/Dashboard.vue')
}, {
    path: "/404",
    component: () =>
        import ("@/views/error/NotFound.vue")
}, {
    path: "*",
    component: () =>
        import ("@/views/error/NotFound.vue")
}, ]