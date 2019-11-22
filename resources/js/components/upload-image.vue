<template>
    <div class="form">
        <div class="form-group">
            <label for="image">Изображение</label>
            <img v-if="imageData" class="preview-img" :src="imageData" alt="">
            <div class="input-group mb-3">
                <div class="custom-file">
                    <input name="src" type="file"
                           @change="onFileChanged"
                           class="custom-file-input"
                           :class="{'is-invalid' : errors.src}"
                           id="image"
                           aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="image">Выберите изображение</label>
                </div>
            </div>
            <div v-if="errors.src" class="alert alert-danger">{{ errors.src[0] }}</div>
        </div>
        <div class="form-group">
            <label for="title">Название</label>
            <input name="title" type="text"
                   v-model="title"
                   class="form-control mb-3"
                   :class="{'is-invalid' : errors.title}"
                   id="title"
                   placeholder="Название">
            <div v-if="errors.src" class="alert alert-danger">{{ errors.title[0] }}</div>
        </div>
        <div class="form-group">
            <label for="des">Описание</label>
            <textarea name="des" class="form-control mb-3"
                      :class="{'is-invalid' : errors.des}"
                      v-model="des"
                      id="des"
                      placeholder="Описание"></textarea>
            <div v-if="errors.src" class="alert alert-danger">{{ errors.des[0] }}</div>
        </div>
        <button type="button" @click="submit" class="btn btn-primary">Сохранить</button>
    </div>
</template>

<script>
    export default {
        name: "upload-image",

        data () {
            return {
                title: '',
                des: '',
                src: '',
                imageData: '',
                errors: {}
            }
        },

        methods: {
            submit () {
                let formData = new FormData
                formData.set('title', this.title)
                formData.set('des', this.des)
                formData.set('src', this.src)
                formData.set('type', 'ajax')

                axios.post('upload-image', formData)
                    .then( ({data}) => {
                        this.$store.commit('setImages', data.images)
                    })
                    .catch( error  => {
                        let errors = Object.values(error)
                        this.errors = errors[2].data.errors
                    })
                    .finally( () => {
                        this.title = ''
                        this.des = ''
                        this.src = ''
                        this.imageData = ''
                    })
            },

            onFileChanged (event) {
                this.src = event.target.files[0]
                let files = event.target.files
                if (files && files[0]) {
                    const reader = new FileReader
                    reader.onload = e => {
                        this.imageData = e.target.result
                    }
                    reader.readAsDataURL(files[0])
                }
            }
        }
    }
</script>

<style>
    .preview-img {
        width: 100px;
        display: block;
        margin: 10px 0 1rem 0;
    }
</style>
