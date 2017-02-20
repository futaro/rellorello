<template xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div id="card-form">
        <input
                type="text"
                placeholder="add new"
                v-model="subject"
                v-on:keypress="onKeyPress">
    </div>
</template>

<script>

    export default {

        data() {
            return {
                subject: ''
            }
        },

        methods: {
            onKeyPress: function (e) {
                if (e.code != 'Enter') {
                    return
                }

                this.$emit('add-new-task', this.subject)
                this.new_task = ''
            }
        },

        mounted() {
//            console.log('add-card-form mounted.')
        }

    }

</script>
