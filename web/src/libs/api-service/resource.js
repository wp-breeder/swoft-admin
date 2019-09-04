import { ajax } from '../http'

export default {
    // get resource
    get: () => ajax.get('/resource'),
    fresh: () => ajax.put('/resource')
}