<template>
    <div class="status" draggable="true">
        <div
                v-show="!editStatusSubject"
                v-on:click="onEditSubject(status)"
                class="status_subject"
        >
            {{ status.subject }}
        </div>
        <div v-show="editStatusSubject" class="status_subject">
            <div class="right-box">
                <button v-on:click="onClickCancel" class="close-btn">☓</button>
            </div>

            <input
                    v-if="editStatusSubject"
                    type="text"
                    v-model="editStatus.subject"
                    v-on:keydown="onKeyDown"
            >

            <div class="right-box">
                <button v-on:click="onClickDelete(status)" class="btn-delete">DELETE</button>
                <button v-on:click="onClickSubmit" class="btn-info">UPDATE</button>
            </div>
        </div>

        <task v-for="(task, index) in status.tasks"
              v-bind:task="task"
              v-bind:index="index"
              v-on:task-modal="onTaskModal"
              draggable="true">
        </task>
        <new-task-form v-bind:status_id="status.id"
                       v-on:add-new-task="onAddNewTask">
        </new-task-form>
    </div>
</template>

<script>

    import Task from './Task.vue'
    import NewTaskForm from './NewTaskForm.vue'
    import StatusModel from 'models/StatusModel'

    export default {

        data() {
            return {
                editStatusSubject: false,
                editStatus: ""
            }
        },

        props: {
            status: null
        },

        components: {
            Task,
            NewTaskForm
        },

        methods: {
            onAddNewTask: function (obj) {
                this.$emit('add-new-task', obj)
            },
            onTaskModal: function (obj) {
                this.$emit('task-modal-open', obj);
            },
            onEditSubject: function (status) {
                this.editStatus = new StatusModel(status.props);
                this.editStatusSubject = true;
            },
            onClickCancel: function () {
                this.editStatusSubject = false
            },
            onClickSubmit: function () {
                this.$emit('update-status', this.editStatus);
                this.onClickCancel()
            },
            onClickDelete: function (task) {
                if (confirm('Do you want to delete it?')) {
                    this.$emit('delete-status', task);
                    this.onClickCancel()
                }
            },
            onKeyDown: function (e) {
                if (e.ctrlKey && e.code == 'Enter') {
                    this.onClickSubmit()
                } else if (e.metaKey && e.code == 'Enter') {
                    this.onClickSubmit()
                } else if (e.code == 'Escape') {
                    this.onClickCancel()
                }
            }
        }

    }

</script>
