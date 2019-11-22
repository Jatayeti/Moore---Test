import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        images: []
    },

    mutations: {
        setImages (state, payload) {
            state.images = payload
        }
    },

    getters: {
        getImages (state) {
            return state.images
        }
    }
})


