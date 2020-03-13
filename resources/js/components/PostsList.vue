<template>
    <div>
        <div class="card" v-for="item in list">
            <a href="#"><img class="card-img-top" src="https://www.tegiwaimports.com/blog/wp-content/uploads/2020/02/EP3-OultonPark-TypeRTrophy-3-640x427.jpg" alt="And this isn't my nose. This is a false one."></a>
            <div class="card-body d-flex flex-column">
                <h4><a href="#">{{ item.title }}</a></h4>
                <div class="text-muted">{{ item.body }}</div>
                <div class="d-flex align-items-center pt-5 mt-auto">
                    <div class="avatar avatar-md mr-3" style="background-image: url(./demo/faces/female/18.jpg)"></div>
                    <div>
                        <a href="./profile.html" class="text-default">Rose Bradley</a>
                        <small class="d-block text-muted">3 days ago</small>
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
