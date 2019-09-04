import Vue from "vue";
import axios from 'axios'
import Cache from './cache'
import { errDispatch } from './util'


const config = window.api

// set base Url
axios.defaults.baseURL = config.serverHost + ':' + config.serverPort + config.baseUri

export const ajax = axios.create({
    timeout: 3000,
    params: {
        _time: Date.parse(new Date()) / 1000
    }
})

// Add a request interceptor
ajax.interceptors.request.use((config) => {
    /* eslint-disable */
    console.log('load ...')

    // token
    const ACCESS_TOKEN = Cache.get('token')
    if (ACCESS_TOKEN) {
        config.headers['Authorization'] = `Bearer ${ACCESS_TOKEN}`
    }
    return config
}, (error) => {
    return Promise.reject(error)
})

// Add a response interceptor
ajax.interceptors.response.use(
    response => {
        if (response.status === 200) {
            return Promise.resolve(response.data)
        } else {
            errDispatch(response.status, respone.data)
        }
        return Promise.reject(response)
    },
    error => {
        /* eslint-disable */
        console.log('load fail')
        const { response } = error
        if (response) {
            errDispatch(response.status, response.data)
        } else {
            Vue.prototype.$notify.err("The Network error or Api not request!!!")
        }
        return Promise.reject(error)
    })