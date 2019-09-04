import Vue from 'vue'
import Vuex from 'vuex'
import Cache from "./libs/cache";

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        token: Cache.get('token') ? Cache.get('token') : '',
        dark: Cache.get('dark') === 'false' ? false : true,
        menus: Cache.get('menus') ? Cache.get('menus') : '{}',
        userInfo: Cache.get('userInfo') ? Cache.get('userInfo') : '{}',
    },
    mutations: {

        //set token
        setToken(state, token) {
            state.token = token
            Cache.set("token", token.token)
        },

        // delete token
        delToken(state) {
            state.token = ''
            state.menus = '{}'
            state.userInfo = '{}'
            Cache.clear(['token', 'menus', 'userInfo'])
        },

        setMenus(state, menus) {
            state.menus = JSON.stringify(menus)
            Cache.set("menus", state.menus)
        },

        setUserInfo(state, userInfo) {
            state.userInfo = JSON.stringify(userInfo)
            Cache.set("userInfo", state.userInfo)
        },

        changeTheme(state, style) {
            state.dark = style
            Cache.set('dark', style)
        },
    },
    getters: {
        menus: state => {
            return JSON.parse(state.menus)
        },
        userInfo: state => {
            return JSON.parse(state.userInfo)
        }
    }
})