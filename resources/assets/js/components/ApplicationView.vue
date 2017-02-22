<template>
    <div id="application">
        <div id="status-container">
            <status v-for="status in statuses"
                    v-bind:status="status"
                    v-on:add-new-task="onAddNewTask"
                    v-on:task-modal-open="onTaskModalOpen"
            >
            </status>
        </div>
        <task-modal
                v-bind:modal_open_flag='modal_open_flag'
                v-bind:task='task'
                v-on:add-update-task="onUpdateTask"
                v-on:task-modal-close="onTaskModalClose"
        ></task-modal>
    </div>
</template>

<script>


    import Status from 'components/Status.vue'
    import TaskModel from 'models/TaskModel'
    import StatusModel from 'models/StatusModel'
    import TaskModal from 'components/TaskModal.vue'

    import moment from 'moment'

    export default {

        data() {
            return {
                statuses: [],
                modal_open_flag: false,
                task: {}
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
            onTaskModalOpen: function (task) {
                this.task = task
                this.modal_open_flag = true
            },
            onTaskModalClose: function () {
                this.modal_open_flag = false
            },
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
            },
            onUpdateTask: function (task) {
                console.log(task);
            }
        },

        components: {
            Status,
            TaskModal
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