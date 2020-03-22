<template>
    <span>
        <a @click.prevent="showComments" class="icon d-inline-block ml-4">
            <i :class="`fa fa-comment-o mr-1`"></i> {{ commentsCount }}
        </a>
        <a @click.prevent="toggleLike" class="icon d-inline-block ml-4">
            <i :class="`fa ${isLikedByAuthUser ? 'fa fa-heart' : 'fa-heart-o'} mr-1`"></i> {{ likesCount }}
        </a>
    </span>
</template>

<script>
export default {
    props: ['postId', 'authUserId', 'initialLikes', 'initialComments'],
    data: function() {
        return {
            likes: this.initialLikes,
            comments: this.initialComments,
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
        commentsCount: function () {
            return this.comments.length;
        }
    },
    created: function() {
        const likeChannel = `post.${this.postId}.like`;
        const commentChannel = `post.${this.postId}.comment`;

        Echo.private(likeChannel)
            .listen("PostLiked", (e) => {
                this.likes = e.post.likes;
            });

        Echo.private(commentChannel)
            .listen("CommentPosted", (e) => {
                this.comments.push(e.comment);
            });
    },
    methods: {
        toggleLike: function() {
            axios.put(`/post/${this.postId}/like`);
        },
        showComments: function () {
            window.location = `/post/${this.postId}`
        }
    },
};
</script>
