<template>
    <div class="status add-status">
        <div v-if="!addSubject" v-on:click="addSubject=true">+ Add</div>
        <div v-if="addSubject">
            <input
                    v-if="addSubject"
                    type="text"
                    v-model="addStatusSubject"
                    v-on:keydown="onKeyDown"
            >
            <button v-on:click="onClickCancel">cancel</button>
            <button v-on:click="onClickSubmit" class="primary">submit</button>
        </div>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                addSubject: false,
                addStatusSubject: ''
            }
        },

        methods: {
            onClickCancel: function () {
                this.addSubject = false
            },
            onClickSubmit: function () {
                this.$emit('add-new-status', {
                    subject: this.addStatusSubject,
                    project_id: 1
                });
                this.addStatusSubject = '';
                this.onClickCancel()
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
