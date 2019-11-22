<template>
    <div class="images">
        <div class="info" v-if="!images.length">
            <h1>Загрузите изображения</h1>
        </div>
        <div v-if="!showAllImages && images.length" class="cart cart__trigger" @click="() => {this.showAllImages = true}">
            <h5>Показать <br> все <br> изображения</h5>
        </div>
        <div v-if="showAllImages && images.length" class="cart cart__trigger" @click="() => {this.showAllImages = false}">
            <h5>Скрыть <br> изображения</h5>
        </div>
        <div class="images__cart cart animated fadeIn" v-for="image in images">
            <div class="cart__head">
                <img :src="storage_url + image.src"
                     alt="">
            </div>

            <div class="cart__body">
                <h1>{{image.title}}</h1>
                <p>{{image.des}}</p>
            </div>

            <img class="delete-btn animated bounceIn"
                 @click="deleteImage(image.id)"
                 src="https://png.pngtree.com/svg/20170509/6d1242cc9c.png" alt="">
        </div>
    </div>
</template>

<script>
    import {store} from "../store";

    export default {
        name: "Images",

        data () {
            return {
                storage_url: process.env.MIX_APP_STORAGE,
                showAllImages: false
            }
        },

        computed: {
            images () {
                if (!this.showAllImages) {
                    return this.$store.getters.getImages.slice(0, 3)
                }
                return this.$store.getters.getImages
            }
        },

        methods: {
            deleteImage(id) {
                axios.delete('delete-image/' + id).then( ({data}) => {
                    this.$store.commit('setImages', data.images)
                })
            },

            fetchImages () {
                axios.get('/images').then( ({data}) => {
                    this.$store.commit('setImages', data.images)
                });
            },
        },

        mounted() {
            this.fetchImages()
        }
    }
</script>

<style lang="scss">
    .images {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        padding: 1rem 0;

        .info {
            width: 100%;
            text-align: center;

            h1 {
                font-size: 1.5rem;
                color: #ccc;
                margin: 0;
            }
        }
    }

    .cart {
        position: relative;
        background: #fff;
        margin: 0 1rem 1rem 0;
        width: 269px;

        &:nth-child(4n) {
            padding-right: 0;
        }

        &__head {
            width: 100%;
            img {
                width: 100%;
            }
        }

        &__body {
            padding: 1rem;
            h1 {
                font-size: 1rem;
            }

            p {
                font-size: .8rem;
                margin: 0;
            }
        }

        .delete-btn {
            display: none;
            width: 40px;
            position: absolute;
            top: -10px;
            right: -10px;
            z-index: 10;
        }

        &:hover {
            .delete-btn {
                display: block;
            }
        }
    }

    .cart__trigger {
        background: #eee;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #ccc;
        cursor: pointer;
        border-radius: .25rem;
        transition: .3s;

        h5 {
            font-size: 1rem;
            text-align: center;
            color: #ccc;
            transition: .3s;
        }

        &:hover {
            background: #ccc;

            h5 {
                color: #eee;
            }
        }
    }
</style>
