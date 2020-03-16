<template>
    <div>
        <div class="card" v-for="item in list">
            <a :href="item.url" v-if="item.images.length">
                <img class="card-img-top" :src="item.images[0]" :alt="item.title">
            </a>
            <div class="card-body">
                <h4><a :href="item.url">{{ item.title }}</a></h4>
                <div class="text-muted">{{ item.body }}</div>
                <div class="d-flex align-items-center pt-5 mt-auto">
                    <div class="avatar avatar-md mr-3" :style="`background-image: url(${item.user.profile.avatar})`" v-if="item.user.profile.avatar"></div>
                    <div>
                        <a :href="`/${item.user.name}`" class="text-default">{{ item.user.name }}</a>
                        <small class="d-block text-muted">{{ item.fromNow }}</small>
                    </div>
                    <div class="ml-auto text-muted">
                        <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <infinite-loading @infinite="infiniteHandler">
            <span slot="no-more">
                You're all caught up!
            </span>
        </infinite-loading>
    </div>
</template>

<script>
import InfiniteLoading from 'vue-infinite-loading';

export default {
    data() {
        return {
            list: [],
            page: 1,
        };
    },
    methods: {
        infiniteHandler($state) {
            axios.get('/posts', {
                params: {
                    page: this.page,
                },
            }).then(({ data }) => {
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
    },
    components: {
        InfiniteLoading,
    },
};
</script>
