import { ajax } from '../http'

export default {
    // get all role
    get: () => ajax.get('/role'),

    update: (roleId, roleInfo) => ajax.put('/role/' + roleId, roleInfo),

    create: (roleInfo) => ajax.post('/role', roleInfo),

    del: (roleId) => ajax.delete('/role/' + roleId),

    updateRoleMenu: (roleId, menus) => ajax.put('/role/' + roleId + '/menus', menus),
}