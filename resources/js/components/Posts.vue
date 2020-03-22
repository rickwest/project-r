<template>
<div class="posts">
    <div v-if="hasNewPosts" class="text-center mb-3">
        <a href="#" @click.prevent="refresh" class="btn btn-pill btn-primary"><i class="fe fe-refresh-cw mr-2"></i> Show new posts!</a>
    </div>
    <div v-for="post in posts">
        <post :post="post" :full-body="false" :auth-user-id="authUserId"></post>
    </div>
    <infinite-loading @infinite="infiniteHandler" :identifier="infiniteId">
        <span class="text-muted" slot="no-more">You're all caught up! 😀</span>
        <span class="text-muted" slot="no-results">Nothing to see here! 🙈</span>
    </infinite-loading>
</div>
</template>

<script>
import InfiniteLoading from 'vue-infinite-loading';

export default {
    props: ['userId', 'authUserId'],
    data() {
        return {
            posts: [],
            page: 1,
            hasNewPosts: false,
            infiniteId: +new Date(),
        };
    },
    created() {
        if (! this.userId) {
            Echo.private('posts')
                .listen("PostPosted", (e) => {
                    this.hasNewPosts = true;
                });
        }
    },
    methods: {
        infiniteHandler: function($state) {
            const params = {
                page: this.page,
            };
            if (this.userId) {
                params['user_id'] = this.userId;
            }

            axios.get('/posts', {params})
            .then(({ data }) => {
                if (data.data.length) {
                    this.page += 1;
                    this.posts.push(...data.data);
                    $state.loaded();
                    if (data.current_page === data.last_page) {
                        $state.complete();
                    }
                } else {
                    $state.complete();
                }
            });
        },
        refresh: function() {
            this.page = 1;
            this.posts = [];
            this.infiniteId += 1;

            this.hasNewPosts = false;
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
