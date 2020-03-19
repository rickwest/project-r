<template>
<a @click.prevent="toggleLike" class="icon d-none d-md-inline-block ml-3">
    <i :class="`fa ${this.liked ? 'fa fa-heart' : 'fa-heart-o'} mr-1`"></i> {{this.likesCount}}
</a>
</template>

<script>
export default {
    props: ['post'],
    data() {
        return {
            liked: false,
            likesCount: 0,
        };
    },
    mounted: function() {
        this.liked = this.post.liked;
        this.likesCount = this.post.likes_count;
    },
    methods: {
        toggleLike: function() {
            axios.put(`/post/${this.post.id}/like`)
                .then(({ data }) => {
                    this.liked = data.liked;
                    this.likesCount = data.likes_count
                });
        },
    },
};
</script>
