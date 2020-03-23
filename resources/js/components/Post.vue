<template>
<div class="card">
    <div class="card-header" v-if="isOwnedByAuthUser">
        <div class="card-options">
            <a @click.prevent="deletePost" class="card-options-remove" ><i class="fe fe-x"></i></a>
        </div>
    </div>
    <img :href="post.url" v-if="post.images.length === 1" :class="{'card-img-top': !isOwnedByAuthUser}"  :src="post.images[0]" :alt="post.title">
    <div v-else-if="post.images.length > 1" :id="`post-carousel-${post.id}`" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <ol class="carousel-indicators">
                <li v-for="(image, index) in post.images" :data-target="`#post-carousel-${post.id}`" :data-slide-to="index" :class="`${index === 0 ? 'active' : ''}`"></li>
            </ol>
            <div v-for="(image, index) in post.images" :class="`carousel-item ${index === 0 ? 'active' : ''}`">
                <img class="d-block w-100" :class="{'card-img-top': !isOwnedByAuthUser}"  alt="" :src="image" data-holder-rendered="true">
            </div>
        </div>
        <a class="carousel-control-prev" :href="`#post-carousel-${post.id}`" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" :href="`#post-carousel-${post.id}`" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="card-body d-flex flex-column">
        <h4 v-if="post.title"><a :href="post.url">{{ post.title | capitalize }}</a></h4>
        <div class="text-muted">{{ (fullBody ? post.body : excerpt) | capitalize }} <a v-if="!fullBody" :href="`/post/${post.id}`">more</a></div>
        <div class="d-flex align-items-center pt-5 mt-auto">
            <div v-if="post.user.profile.avatar" class="avatar avatar-md mr-3" :style="`background-image: url(${post.user.profile.avatar})`"></div>
            <div v-else-if="post.user.profile.initials" class="avatar avatar-md mr-3">{{ post.user.profile.initials }}</div>
            <div>
                <a :href="`/${post.user.name}`" class="text-default">{{ post.user.name }}</a>
                <small class="d-block text-muted">{{ post.created_at | moment('from') }}</small>
            </div>
            <div class="ml-auto text-muted">
                <post-actions
                    :post-id="post.id"
                    :auth-user-id="authUserId"
                    :initial-likes="post.likes"
                    :initial-comments="post.comments"
                >
                </post-actions>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['post', 'fullBody', 'authUserId'],
    computed: {
        excerpt: function () {
            const length = 140; // Length of excerpt

            let text = this.post.body;

            if (text.length > length) {
                text = text.slice(0, length);
            }

            return `${text}...`;
        },
        isOwnedByAuthUser: function () {
            return this.post.user.id === this.authUserId;
        }
    },
    methods: {
        deletePost: function () {
            if (!confirm('Are you sure you want to delete this post?')) {
                return false;
            }

            axios
                .delete(`/post/${this.post.id}`)
                .then(() => {
                window.location = '/dashboard';
            })
        }
    }
};
</script>
