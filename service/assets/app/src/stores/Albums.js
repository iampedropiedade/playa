import { defineStore } from 'pinia'
import axios from 'axios'
import { useSettingsStore } from './Settings'

export const useAlbumsStore = defineStore({
    id: 'albums',
    state: () => ({
        settingsStore: useSettingsStore(),
        localStorageKey: 'albums',
        currentAlbum: {},
        albums: {},
    }),
    actions: {
        async getAlbum(albumId) {
            if(this.albums[albumId] === undefined) {
                this.getAlbumFromApi(albumId)
            }
            this.currentAlbum = this.albums[albumId]
            return this.albums[albumId]
        },
        async getAlbumFromApi(albumId) {
            return new Promise((resolve, reject) => {
                this.loading = true
                axios
                    .get(this.settingsStore.endpoints.spotify.albums + '/' + albumId)
                    .then(response => {
                        this.albums[albumId] = response.data
                        this.currentAlbum = this.albums[albumId]
                        resolve()
                    })
                    .catch(errors => {
                        reject(errors)
                    })
                    .finally(() => {
                        this.loading = false
                    })
            })
        },
    },
})
