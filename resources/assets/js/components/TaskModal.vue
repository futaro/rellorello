<template>
    <transition name="fade">
        <div id="task-modal" v-show="modal_open_flag">
            <button class="close-btn btn-default" v-on:click="onClose">☓</button>

            <div class="header">
                <div
                        class="subject edit-box"
                        v-if="!editSubject"
                        v-text="task.subject"
                        v-on:click="editSubject=true">
                </div>
                <input
                        v-if="editSubject"
                        type="text"
                        v-model="task.subject"
                        v-on:blur="editSubject=false"
                >
            </div>
            <div class="content">
                <div class="date">{{ task.created_at_display }}</div>
            </div>

            <div class="footer">
                <button class="btn-delete" v-on:click="onDelete(task)">DELETE</button>
                <button class="btn-info" v-on:click="onUpdate(task)">UPDATE</button>
            </div>
    </transition>
</template>

<script>
    export default {

        data() {
            return {
                editSubject: false
            }
        },

        props: {
            modal_open_flag: false,
            task: {}
        },

        methods: {
            onClose: function () {
                this.editSubject = false;
                this.$emit('task-modal-close');
            },

            onUpdate: function (task) {
                this.$emit('add-update-task', task);
            },

            onDelete: function (task) {
                if (confirm('Do you want to delete it?')) {
                    this.$emit('delete-task', task);
                }
            }
        }
    }
</script>
