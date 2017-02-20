<template>
    <div class="task new-form">
        <span class="add_btn"
              v-show="!display_form_flag"
              v-on:click="onClickAddNew">+ Add New</span>
        <div class="new_task_form"
             v-show="display_form_flag">
            <textarea ref='new_task_field'
                      placeholder="new task"
                      v-model="new_task_subject"
                      v-on:keydown="onKeyDown"></textarea>
            <button v-on:click="onClickCancel">cancel</button>
            <button v-on:click="onClickSubmit" class="primary">submit</button>
        </div>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                new_task_subject: '',
                display_form_flag: false
            }
        },

        props: {
            status_id: null
        },

        mounted() {
        },

        methods: {
            onClickAddNew: function () {
                this.display_form_flag = !this.display_form_flag
                if (this.display_form_flag) {
                    this.$refs['new_task_field'].focus()
                }
            },
            onClickCancel: function () {
                this.display_form_flag = false
            },
            onClickSubmit: function () {

                this.$emit('add-new-task', {
                    subject: this.new_task_subject,
                    status_id: this.status_id
                })
                this.display_form_flag = false
            },
            onKeyDown: function (e) {

                if (e.ctrlKey && e.code == 'Enter') {
                    this.onClickSubmit()
                } else if (e.metaKey && e.code == 'Enter') {
                    this.onClickSubmit()
                }

//                if (e.code == 'Enter') {
//                    return
//                }
//
//                this.$emit('add-new-task', this.subject)
//                this.new_task = ''
            }
        }

    }

</script>
