import NotifyComponment from './Notify.vue';

let notifyType = {
    success: {
        sentiment: 'sentiment_very_satisfied',
        color: 'green lighten-1'
    },
    info: {
        sentiment: 'sentiment_satisfied',
        color: 'light-blue lighten-1'
    },
    warn: {
        sentiment: 'sentiment_dissatisfied',
        color: 'orange darken-2'
    },
    error: {
        sentiment: 'sentiment_very_dissatisfied',
        color: 'red lighten-1'
    },
}


class Notify {
    constructor(Vue) {
        this.Vue = Vue;
        this.mounted = false;
        this.$root = {};
    }

    // check whether or not  mounted
    mountIfNotMounted() {
        if (this.mounted === true) {
            return;
        }
        this.$root = (() => {
            let NotifyConstructor = this.Vue.extend(NotifyComponment);
            let node = document.createElement("div");
            document.querySelector('body').appendChild(node);
            return (new NotifyConstructor()).$mount(node);
        })();
        this.mounted = true;
    }

    destroy() {
        if (this.mounted) {
            let el = this.$root.$el;
            this.$root.$destroy();
            this.$root.$off();
            el.remove();
            this.mounted = false;
        }
    }

    /**
     * global notify
     *
     * @param {*} msg message
     * @param {string} [msgType='info']
     * @param {*} [options={}]
     */
    open(msg, msgType = 'info', options = {}) {
        if (typeof(msgType) !== 'string' || !notifyType.hasOwnProperty(msgType)) {
            /* eslint-disable */
            console.warn('notify type is error');
            return;
        }
        this.mountIfNotMounted();
        let localOptions = {};
        localOptions.msgType = notifyType[msgType];
        localOptions.msg = msg;
        localOptions.snackbar = true;
        this.$root.commit(Object.assign({}, localOptions, options));
    }

    success(msg, options) {
        this.open(msg, 'success', options);
    }

    warn(msg, options) {
        this.open(msg, 'warn', options);
    }

    info(msg, options) {
        this.open(msg, 'info', options);
    }

    err(msg, options) {
        this.open(msg, 'error', options);
    }

    static install(Vue, options) {
        Vue.component('Notify', NotifyComponment);
        Vue.vuetifyNotify = new Notify(Vue, options);
        Object.defineProperties(Vue.prototype, {
            $notify: {
                get() {
                    return Vue.vuetifyNotify;
                }
            }
        });
    }
}

export default Notify