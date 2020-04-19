<template>
    <div>
        <span class="text-muted">{{ postDate }}</span>
        <div class="media">
            <a :href="user.url" class="pr-2">
                <img width="40" src="https://ramcotubular.com/wp-content/uploads/default-avatar.jpg" >
            </a>
            <div class="media-body mt-1">
                <a :href="user.url" class="">{{ user.name }}</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['model', 'label'],

    computed: {
        postDate () {
            return this.label + " " + this.model.created_date;
        }
    },

    data () {
        return {
            user: this.model.user
        }
    }
}
</script>