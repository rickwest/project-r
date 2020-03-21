<template>
<div class="posts">
    <div v-for="post in list" class="card">
        <img :href="post.url" v-if="post.images.length === 1" class="card-img-top" :src="post.images[0]" :alt="post.title">
        <div v-else-if="post.images.length > 1" :id="`post-carousel-${post.id}`" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <ol class="carousel-indicators">
                    <li v-for="(image, index) in post.images" :data-target="`#post-carousel-${post.id}`" :data-slide-to="index" :class="`${index === 0 ? 'active' : ''}`"></li>
                </ol>
                <div v-for="(image, index) in post.images" :class="`carousel-item ${index === 0 ? 'active' : ''}`">
                    <img class="d-block w-100 card-img-top" alt="" :src="image" data-holder-rendered="true">
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
            <h4><a :href="post.url">{{ post.title }}</a></h4>
            <div class="text-muted">{{ getExcerpt(post.body) }} <a :href="`/post/${post.id}`">more</a></div>
            <div class="d-flex align-items-center pt-5 mt-auto">
                <div v-if="post.user.profile.avatar" class="avatar avatar-md mr-3" :style="`background-image: url(${post.user.profile.avatar})`"></div>
                <div v-else-if="post.user.profile.initials" class="avatar avatar-md mr-3">{{ post.user.profile.initials }}</div>
                <div>
                    <a :href="`/${post.user.name}`" class="text-default">{{ post.user.name }}</a>
                    <small class="d-block text-muted">{{ post.from_now }}</small>
                </div>
                <div class="ml-auto text-muted">
                    <post-like v-bind:post="post"></post-like>
                </div>
            </div>
        </div>
    </div>
    <infinite-loading @infinite="infiniteHandler">
        <span class="text-muted" slot="no-more">You're all caught up! 😀</span>
        <span class="text-muted" slot="no-results">Nothing to see here! 🙈</span>
    </infinite-loading>
</div>
</template>

<script>
import InfiniteLoading from 'vue-infinite-loading';

export default {
    props: ['user_id'],
    data() {
        return {
            list: [],
            page: 1,
        };
    },
    methods: {
        infiniteHandler: function($state) {
            const params = {
                page: this.page,
            };
            if (this.user_id) {
                params['user_id'] = this.user_id;
            }

            axios.get('/posts', {params})
            .then(({ data }) => {
                if (data.data.length) {
                    this.page += 1;
                    this.list.push(...data.data);
                    $state.loaded();
                    if (data.current_page === data.last_page) {
                        $state.complete();
                    }
                } else {
                    $state.complete();
                }
            });
        },
        getExcerpt: function(text, length = 140) {
            if (text.length > length) {
                text = text.slice(0, length);
            }
            return `${text}...`;
        },
    },
    components: {
        InfiniteLoading,
    },
};
</script>
