import {AbstractModel} from './AbstractModel'

import TaskModel from './TaskModel'

export default class StatusModel extends AbstractModel {

    constructor(obj = {}) {

        super()

        this.resource_url = '/statuses'

        this.props = {
            id: null,
            subject: null,
            project_id: null,
            order_num: null,
            tasks: null,
            created_at: null,
            updated_at: null
        }
        this._setProperties(obj)

    }

    addTask(task) {

        this.tasks.push(task)

    }

    // getter / setter

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

    set project_id(value) {
        this._set('project_id', value)
    }

    get project_id() {
        return this._get('project_id')
    }

    set order_num(value) {
        this._set('order_num', value)
    }

    get order_num() {
        return this._get('order_num')
    }

    set tasks(value) {

        value = value.map((val)=>{
            return new TaskModel(val)
        })

        this._set('tasks', value)
    }

    get tasks() {
        return this._get('tasks')
    }

    sort(statuses, success, failed) {
        let api_url = `/api${this.resource_url}/sort`;

        axios
            .post(api_url, {statuses: statuses})
            .then(success)
            .catch(failed)
    }
}

