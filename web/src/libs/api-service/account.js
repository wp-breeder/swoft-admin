import { ajax } from '../http'

export default {
    // login 
    getToken: (identity, credential) => ajax.post('/account/token', { identity, credential }),
    // refresh token
    refreshToken: () => ajax.post('/account/refresh'),
    // login out
    logout: () => ajax.get('/account/logout'),
    // get account information
    getInfo: () => ajax.get('/account/info'),
    // edit account information
    editInfo: (accountInfo) => ajax.put('/account/info', accountInfo),
    // edit password
    editPwd: (newPwd) => ajax.put('/account/password', { credential: newPwd }),
    // get account menus
    getMenus: () => ajax.get('/account/menu'),
}