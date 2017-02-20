<template>
    <div id="application">
        <div id="status-container">
            <status v-for="status in statuses"
                    v-bind:status="status"
                    v-on:add-new-task="onAddNewTask">
            </status>
        </div>
    </div>
</template>

<script>

    import Status from 'components/Status.vue'
    import TaskModel from 'models/TaskModel'
    import StatusModel from 'models/StatusModel'

    import moment from 'moment'

    export default {

        data() {
            return {
                statuses: []
            }
        },

        mounted() {
            let params = {}
            StatusModel.fetch(
                (data) => {
                    this.statuses = data
                },
                (error) => {
                    console.log(error)
                },
                params
            )
        },

        methods: {
            onAddNewTask: function (new_task) {

                let task = new TaskModel({
                    subject: new_task.subject,
                    description: null,
                    created_user_id: 1,
                    assignee_user_id: null,
                    status_id: new_task.status_id
                })

                task.save(
                    (response) => {

                        if (response.data.status) {

                            let task = response.data.task

                            this.statuses.map((status, index) => {
                                if (status.id == task.status_id) {
                                    status.addTask(new TaskModel(task))
                                }
                            })

                        } else {
                            console.log(response.data.errors)
                        }

                    },
                    (error) => {
                        console.log(error)
                    }
                )
            }
        },

        components: {
            Status
        }

    }

</script>

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s
    }

    .fade-enter, .fade-leave-to {
        opacity: 0
    }
</style>