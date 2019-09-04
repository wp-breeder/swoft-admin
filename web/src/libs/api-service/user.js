import { ajax } from '../http'

export default {
    // get all user info
    get: () => ajax.get('/user'),
    setState: (uid, status) => ajax.put('/user/' + uid + '/status?status=' + status),
    editPwd: (uid, userInfo) => ajax.put('/user/' + uid, userInfo),
    resetPwd: (uid) => ajax.put('/user/' + uid + '/password'),
    // get user info by user id
    getUserById: (uid) => ajax.get('/user/' + uid),
    editUser: (uid, userInfo) => ajax.put('/user/' + uid, userInfo),
    createUser: (userInfo) => ajax.post('/user', userInfo),
}