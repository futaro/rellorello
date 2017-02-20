import {AbstractModel} from './AbstractModel'

export default class TaskModel extends AbstractModel {

    constructor(obj = {}) {

        super()

        this.resource_url = '/tasks'

        this.props = {
            subject: null,
            description: null,
            created_user_id: null,
            assignee_user_id: null,
            status_id: null,
            created_at: null,
            updated_at: null
        }
        this._setProperties(obj)

    }

    // getter / setter

    get created_at_display() {
        return this.props.created_at.fromNow(true)
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

}

