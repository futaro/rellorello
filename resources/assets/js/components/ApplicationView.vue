<template>
    <div id="application">
        <div id="status-container">
            <status v-for="status in statuses"
                    v-bind:status="status"
                    v-on:add-new-task="onAddNewTask"
                    v-on:task-modal-open="onTaskModalOpen"
                    v-on:update-status="onUpdateStatus"
                    v-on:delete-status="onDeleteStatus"
            >
            </status>
            <new-status
                    v-on:add-new-status="onAddNewStatus"
            ></new-status>
        </div>
        <task-modal
                v-bind:modal_open_flag='modal_open_flag'
                v-bind:task='task'
                v-on:add-update-task="onUpdateTask"
                v-on:delete-task="onDeleteTask"
                v-on:task-modal-close="onTaskModalClose"
        ></task-modal>
    </div>
</template>

<script>


    import Status from 'components/Status.vue'
    import TaskModal from 'components/TaskModal.vue'
    import NewStatus from 'components/NewStatus.vue'
    import TaskModel from 'models/TaskModel'
    import StatusModel from 'models/StatusModel'


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
                this.task = new TaskModel(task.props);
                this.modal_open_flag = true
            },
            onTaskModalClose: function () {
                this.modal_open_flag = false
            },
            onAddNewStatus: function (new_status) {
                let status = new StatusModel(new_status);

                status.save(
                        (response) => {
                            if (response.data.status) {
                                location.reload();
                            } else {
                                console.log(response.data.errors)
                            }

                        },
                        (error) => {
                            console.log(error)
                        }
                )

            },
            onUpdateStatus: function (status) {
                let me = this;

                status.save(
                        (response) => {
                            if (response.data.status) {
                                me.statuses.map((item) => {
                                    if (item.id == status.id) {
                                        item.subject = response.data.model.subject;
                                    }
                                });
                            } else {
                                console.log(response.data.errors)
                            }
                        },
                        (error) => {
                            console.log(error)
                        }
                )
            },
            onDeleteStatus: function (status) {
                let me = this;

                status.destroy(
                        (response) => {
                            if (response.data.status) {
                                me.statuses.map((item, index) => {
                                    if (item.id == status.id) {
                                        me.statuses.splice(index, 1);
                                    }
                                });
                            } else {
                                console.log(response.data.errors)
                            }
                        },
                        (error) => {
                            console.log(error)
                        }
                )
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
                let me = this;

                task.save(
                        (response) => {
                            if (response.data.status) {

                                let statuses = me.statuses.find((status) => {
                                    return status.id == task.status_id;
                                });

                                if (statuses === undefined) {
                                    return;
                                }

                                statuses.tasks.map((item, index) => {
                                    if (item.id == response.data.task.id) {
                                        statuses.tasks.splice(index, 1, new TaskModel(response.data.task));
                                    }
                                });

                                me.onTaskModalClose();
                            } else {
                                console.log(response.data.errors)
                            }
                        },
                        (error) => {
                            console.log(error)
                        }
                )
            },
            onDeleteTask: function (delete_task) {
                let me = this;

                delete_task.destroy(
                        (response) => {
                            if (response.data.status) {
                                let statuses = me.statuses.find((status) => {
                                    return status.id == delete_task.status_id;
                                });

                                if (statuses === undefined) {
                                    return;
                                }

                                statuses.tasks.map((task, index) => {
                                    if (task.id == delete_task.id) {
                                        statuses.tasks.splice(index, 1);
                                    }
                                });

                                me.onTaskModalClose();
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
            Status,
            TaskModal,
            NewStatus
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