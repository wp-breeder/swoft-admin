import Vue from 'vue';
import router from '../router/router';


let toLogin = () => {
    router.replace({
        path: '/login',
        query: {
            redirect: router.currentRoute.fullPath
        }
    });
}

let toNotFound = () => {
    router.replace({
        path: '/404',
        query: {
            redirect: router.currentRoute.fullPath
        }
    });
}


export const errDispatch = (status, data) => {
    // check status
    switch (status) {
        case 401:
            toLogin()
            break
        case 403:
            // Vue.prototype.$notify.warn('toekn expired')
            // TODO: fresh token when toeken expired
            toLogin()
            break
        case 404:
            toNotFound();
            break;
        default:
            Vue.prototype.$notify.warn(data.msg, { timeout: 6000 })
            break
    }
}

// import component
const _import = (component) =>
    () =>
    import ('../views/' + component + '.vue')



export const filterRouter = (menus) =>
    menus.filter(data => {
        if (data.path && data.router) {
            data.component = _import(data.router)
        } else if (data.menu_type !== 3) {
            // set parent router
            data.component = () =>
                import ('../views/Dashboard.vue')

            // set default router view 
            data.path = '/'
        } else {
            return false
        }
        if (data.children && data.children.length) {
            data.children = filterRouter(data.children)
        }
        return true
    })


const genMenus = (menu) => {
    switch (menu.menu_type) {
        case 0:
            // directory
            menu.icon = "keyboard_arrow_up"
            menu["icon-alt"] = "keyboard_arrow_down"
            break
        case 1:
            // menus
            break
        default:
            break
    }
    return menu
}

export const renderMenu = (menus) =>
    menus.filter((data, index) => {
        if (data.menu_type === 3) {
            return false
        }
        data = genMenus(data)
        if (index === 0) {
            data.model = true
            data.jump = data.path + data.children[0].path;
        }
        if (data.children && data.children.length) {
            data.children = filterRouter(data.children)
        }
        return true
    })


export const genTree = (arr, pid = 0) => {
    const tree = []
    for (const item of arr) {
        if (item.parent_id === pid) {
            let children = genTree(arr, item.menu_id)
            if (0 < children.length) {
                item.children = children
            }
            tree.push({...item })
        }

    }

    return tree.sort((a, b) => {
        return a.menu_name > b.menu_name ? 1 : -1
    });
}