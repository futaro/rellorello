<template>
    <transition name="fade">
        <div class="task">
            <div class="subject">{{ task.subject }}</div>
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
        }

    }

</script>
