
export default class Store {

    static init(key) {
        try {
            if(!Store.isset(key)) {
                Store.set(key, []);
            }

        } catch(err) {
            if(err === QUOTA_EXCEEEDED_ERR) {
                console.error("Local Storage is exceeded")
            }

        } 
        return Store.get(key);
    }

    static get(key) {
        let value = localStorage.getItem(key);
        return value === null ? null: JSON.parse(value);
    }

    static set(key, value) {
        return localStorage.setItem(key, JSON.stringify(value))
    }

    static unset(key) {
        if (this.isset(key)) {
            return localStorage.removeItem(key);
        }
        return null;
    }

    static isset(key) {
        return this.get(key) !== null;
    }

    static clear() {
        return localStorage.clear();
    }
}