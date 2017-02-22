<template>
    <div class="status" draggable="true">
        <div class="status_subject">{{ status.subject }}</div>
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

    export default {

        props: {
            status: null
        },

        components: {
            Task,
            NewTaskForm
        },

        mounted() {
//            console.log('card-list mounted.')
        },

        methods: {
            onAddNewTask: function (obj) {
                this.$emit('add-new-task', obj)
            },
            onTaskModal: function (obj) {
                this.$emit('task-modal-open', obj);
            }
        }

    }

</script>
