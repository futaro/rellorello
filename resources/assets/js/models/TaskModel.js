import {AbstractModel} from './AbstractModel'
import moment from 'moment'

export default class TaskModel extends AbstractModel {

    constructor(obj = {}) {

        super()

        this.resource_url = '/tasks'

        this.props = {
            id: null,
            subject: null,
            description: null,
            created_user_id: null,
            assignee_user_id: null,
            status_id: null,
            created: null
        }
        this._setProperties(obj)

    }

    // getter / setter

    get created_at_display() {
        return this.props.created.fromNow(true)
    }

    set id(value) {
        this._set('id', value)
    }

    get id() {
        return this._get('id')
    }

    set subject(value) {
        this._set('subject', value)
    }

    get subject() {
        return this._get('subject')
    }

    set description(value) {
        this._set('description', value)
    }

    get description() {
        return this._get('description')
    }

    set created_user_id(value) {
        this._set('created_user_id', value)
    }

    get created_user_id() {
        return this._get('created_user_id')
    }

    set assignee_user_id(value) {
        this._set('assignee_user_id', value)
    }

    get assignee_user_id() {
        return this._get('assignee_user_id')
    }

    set status_id(value) {
        this._set('status_id', value)
    }

    get status_id() {
        return this._get('status_id')
    }

    set created(value) {
        this._set('created', moment(value))
    }

    get created() {
        return this._get('created')
    }
}

