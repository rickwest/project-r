<template>
<span>
    <a  @click.prevent="toggleLike" class="icon d-inline-block ml-4">
        <i :class="`fa ${isLikedByAuthUser? 'fa fa-heart' : 'fa-heart-o'} mr-1`"></i> {{ likesCount }}
    </a>
</span>
</template>

<script>
export default {
    props: ['commentId', 'authUserId', 'initialLikes'],
    data: function() {
        return {
            likes: this.initialLikes,
        };
    },
    computed: {
        isLikedByAuthUser: function () {
            const likeUserIds = this.likes.map(like => like.user_id);

            return likeUserIds.includes(this.authUserId);
        },
        likesCount: function () {
            return this.likes.length;
        },
    },
    created: function() {
        const likeChannel = `comment.${this.commentId}.like`;

        Echo.private(likeChannel)
            .listen("CommentLiked", (e) => {
                this.likes = e.comment.likes;
            });
    },
    methods: {
        toggleLike: function() {
            axios.put(`/comment/${this.commentId}/like`);
        },
    },
};
</script>
