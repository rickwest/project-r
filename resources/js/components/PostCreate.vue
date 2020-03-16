<template>
<div class="card">
    <div class="card-body">
        <form @submit.prevent="submit">
            <div class="d-flex justify-content-between mb-4">
                <div class="d-flex">
                    <span class="avatar avatar-xl mr-5" style="background-image: url(&quot;demo/faces/male/21.jpg&quot;);">RW</span>
                    <span class="d-none d-md-block">
                        <p class="text-muted mb-2">Posting as...</p>
                        <p class="h4">{{ user.name }}</p>
                    </span>
                </div>
                <div class="btn-list">
                    <a class="btn btn-secondary" href="/dashboard" onclick="if (!confirm('Leave site? Changes that you made may not be saved.')) return false">Discard</a>
                    <button class="btn btn-primary" :disabled="!submittable">Publish</button>
                </div>
            </div>
            <div class="form-group">
                <input class="form-control" v-bind:class="{'is-invalid': errors && errors.title}" type="text" placeholder="Add a title (optional)" v-model="fields.title">
                <span class="invalid-feedback" role="alert" v-if="errors && errors.title">
                    <strong>{{ errors.title[0] }}</strong>
                </span>
            </div>
            <div class="form-group">
                <textarea class="form-control" v-bind:class="{'is-invalid': errors && errors.body}" placeholder="What do you want to say?" rows="5" autofocus v-model="fields.body"></textarea>
                <span class="invalid-feedback" role="alert" v-if="errors && errors.body">
                    <strong>{{ errors.body[0] }}</strong>
                </span>
            </div>
        </form>
        <vue-dropzone
            id="post-image-dropzone"
            :options="dropzoneOptions"
            v-on:vdropzone-success="onUploadSuccess"
            v-on:vdropzone-removed-file="onRemovedFile"
        >
        </vue-dropzone>
    </div>
</div>
</template>

<script>
import vue2Dropzone from 'vue2-dropzone'

export default {
    components: {
        vueDropzone: vue2Dropzone
    },
    props: ['user', 'csrfToken'],
    data: function () {
        return {
            fields: {
                title: '',
                body: '',
                media: {},
            },
            errors: {},
            dropzoneOptions: {
                url: '/media',
                thumbnailWidth: 150,
                maxFilesize: 2,
                maxFiles: 5,
                addRemoveLinks: true,
                duplicateCheck: true,
                headers: { "X-CSRF-TOKEN": this.csrfToken },
                dictDefaultMessage: "<i class='fe fe-camera'></i> Drag and drop photos or click to upload"
            },
        }
    },
    computed: {
        submittable: function () {
            return this.fields.body.trim().length > 0;
        }
    },
    methods: {
        submit: function () {
            this.errors = {};

            axios.post('/post', {
                title: this.fields.title,
                body: this.fields.body,
                media: Object.values(this.fields.media),
            })
            .then(response => {
                this.fields = {
                    title: '',
                    body: '',
                    media: {},
                };
                window.location = response.data.url;
            })
            .catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                }
            });
        },
        onUploadSuccess: function (file, response) {
            Vue.set(this.fields.media, file.upload.uuid, response);

        },
        onRemovedFile: function (file, error, xhr) {
            axios.delete('/media', { data: { path: this.fields.media[file.upload.uuid] } });
            Vue.delete(this.fields.media, file.upload.uuid);
        },
    }
}
</script>

<style>
.dropzone {
    min-height: 150px;
    border: 1px dashed rgba(0, 40, 100, 0.12);
    border-radius: 3px;
    background: white;
    padding: 20px 20px;
}
.dz-message {
    color: #9aa0ac;
}
</style>
