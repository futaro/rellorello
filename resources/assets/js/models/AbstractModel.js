import moment from 'moment'

export class AbstractModel {

    constructor() {
        this.props = {}
    }

    save(success, failed) {

        let api_url = `/api${this.resource_url}`

        axios
            .post(api_url, this.props)
            .then(success)
            .catch(failed)
    }

    static fetch(success, failed, params = {}) {

        let api_url = `/api${((new this).resource_url)}`

        axios
            .get(api_url, params)
            .then((response) => {
                if (response.status) {
                    let datas = response.data
                    datas = datas.map((data) => {
                        return new this(data)
                    })
                    success(datas)
                } else {
                    failed(response.error)
                }
            })
            .catch(failed)
    }

    _setProperties(obj) {
        Object.keys(obj).forEach(function (key) {
            if (this.props.hasOwnProperty(key)) {
                let value = obj[key]
                this[key] = value
            }
        }, this)
    }

    _set(prop, value) {
        // console.info(`set ${prop} : ${value}`)
        if (this.props.hasOwnProperty(prop)) {
            this.props[prop] = value
        } else {
            throw new Error(`undefined property '${prop}'`)
        }
    }

    _get(prop) {
        if (this.props.hasOwnProperty(prop)) {
            return this.props[prop]
        } else {
            throw new Error(`undefined property '${prop}'`)
        }
    }

    set created_at(value) {
        this._set('created_at', moment(value))
    }

    get created_at() {
        return this._get('created_at')
    }

    set updated_at(value) {
        this._set('updated_at', moment(value))
    }

    get updated_at() {
        return this._get('updated_at')
    }
}

