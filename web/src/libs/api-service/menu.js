import { ajax } from '../http'

export default {
    // get menus
    get: () => ajax.get('/menu'),
    setState: (menuId, status) => ajax.put('/menu/' + menuId + '/status?status=' + status),
    del: (menuId) => ajax.delete('/menu/' + menuId),
    updateMenuById: (menuId, menu) => ajax.put('/menu/' + menuId, menu),
    create: (menu) => ajax.post('/menu', menu),
}