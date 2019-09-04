const localStorage = window.localStorage

const Cache = {
    set: function(key, value) {
        localStorage.setItem(key, value)
    },
    get: function(key) {
        return localStorage.getItem(key)
    },
    sets: function(data) {
        // data.forEach(item => this.set(item.key, item.value))
        Object.keys(data).forEach(key => this.set(key, data[key]))
    },
    gets: function(keys) {
        return keys.map(key => this.get(key))
    },
    setJson: function(key, obj) {
        localStorage.setItem(key, JSON.stringify(obj))
    },
    getJson: function(key) {
        return JSON.parse(this.get(key))
    },
    del: function(key) {
        return localStorage.removeItem(key)
    },
    key: function(index) {
        return localStorage.key(index)
    },
    has: function(key) {
        return this.get(key) !== null
    },
    len: function() {
        return localStorage.length
    },
    clear: function(keys) {
        if (keys) {
            keys.forEach(key => this.del(key))
        } else {
            localStorage.clear()
        }
    }
}

export default Cache;