<template>
<div class="card">
    <form class="card-header" @submit.prevent="submit">
        <div class="input-group">
            <input
                type="text"
                class="form-control"
                placeholder="Add a comment..."
                v-bind:class="{'is-invalid': errors && errors.body}"
                v-model="fields.body"
            >
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit" :disabled="!submittable">Post</button>
            </div>
            <span class="invalid-feedback" role="alert" v-if="errors && errors.body">
                <strong>{{ errors.body[0] }}</strong>
            </span>
        </div>
    </form>
    <ul class="list-group card-list-group">
        <li class="list-group-item" v-for="comment in comments">
            <div class="media">
                <div v-if="comment.user.profile.avatar" class="media-object avatar mr-4" :style="`background-image: url(${comment.user.profile.avatar})`"></div>
                <div v-else-if="comment.user.profile.initials" class="media-object avatar mr-4">{{ comment.user.profile.initials }}</div>
                <div class="media-body text-muted">
                    <a class="text-default" :href="`/${comment.user.name}`">{{ comment.user.name }}</a> {{ comment.body }}
                </div>
            </div>
        </li>
    </ul>
</div>
</template>

<script>
    export default {
        props: ['postId'],
        data() {
            return {
                comments: [],
                fields: {
                    body: '',
                },
                errors: {},
            };
        },
        created() {
            this.fetchComments();

            const channel = `post.${this.postId}.comment`;

            Echo.private(channel)
                .listen("CommentPosted", (e) => {
                   this.comments.push(e.comment);
                });
        },
        computed: {
            submittable: function () {
                return this.fields.body.trim().length > 0;
            }
        },
        methods: {
            fetchComments: function() {
                axios
                    .get(`/post/${this.postId}/comments`)
                    .then(({ data }) => {
                        this.comments = data;
                    });
            },
            submit: function () {
                this.errors = {};

                axios
                    .post(`/post/${this.postId}/comment`, {
                        body: this.fields.body,
                    })
                    .then(res => {
                        this.fields = {
                            body: '',
                        };
                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors || {};
                        }
                    });
            },
        },

    };
</script>
