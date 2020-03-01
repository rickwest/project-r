<template>
    <div>
        <form action="/posts" method="POST">
            <div class="d-flex justify-content-between mb-4">
                <div class="d-flex">
                    <span class="avatar avatar-xl mr-5" style="background-image: url(&quot;demo/faces/male/21.jpg&quot;);">RW</span>
                    <span class="d-none d-md-block">
                        <p class="text-muted mb-2">Posting as...</p>
                        <p class="h4">Rick West</p>
                    </span>
                </div>
                <div class="btn-list">
                    <a class="btn btn-secondary" href="/dashboard" onclick="return confirm('Changes that you made may not be saved.')">Discard</a>
                    <button class="btn disabled btn-primary" disabled="">Publish</button>
                </div>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Add a title (optional)">
            </div>

            <div class="form-group">
                <textarea class="form-control" placeholder="What do you want to say?" rows="5" autofocus></textarea>
            </div>

            <div v-for="upload in uploads">
                <input type="hidden" name="images[]" :value="upload" />
            </div>
        </form>
        <vue-dropzone id="post-image-dropzone" :options="dropzoneOptions" v-on:vdropzone-success="onUploadSuccess"></vue-dropzone>
    </div>
</template>

<script>
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {
    components: {
        vueDropzone: vue2Dropzone
    },
    props: ['csrfToken'],
    data: function () {
        return {
            uploads: [],
            dropzoneOptions: {
                url: '/posts/images',
                thumbnailWidth: 150,
                maxFilesize: 2,
                headers: { "X-CSRF-TOKEN": this.csrfToken },
            },
        }
    },
    methods: {
        onUploadSuccess: function (file, response) {
            this.uploads.push(response);
        }
    }
}
</script>
