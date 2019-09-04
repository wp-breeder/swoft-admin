import Vue from 'vue'
import './plugins/axios'
import './plugins/api'
import './plugins/antd'
import './plugins/notify'
import './plugins/vuetify'
import App from './App.vue'
import store from './store'
import router from './router/router'
import VueI18n from 'vue-i18n'
import Cache from './libs/cache'
import messages from './locale/index'

Vue.config.productionTip = false

Vue.use(VueI18n)

const i18n = new VueI18n({
    locale: Cache.get('lang') ? Cache.get('lang') : 'zh', // set default language
    messages
})

new Vue({
    store,
    router,
    i18n,
    render: h => h(App)
}).$mount('#app')