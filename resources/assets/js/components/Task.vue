<template>
    <transition name="fade">
        <div class="task">
            <div class="subject" v-on:click="onOpenModal(task)">{{ task.subject }}</div>
            <div class="info">{{ task.created_at_display }}</div>
        </div>
    </transition>
</template>

<script>

    export default {

        props: {
            index: null,
            task: null
        },

        mounted() {
//            console.log('card mounted.')
        },

        methods: {
            onOpenModal: function (task) {
                this.$emit('task-modal', task);
            }
        }

    }

</script>
